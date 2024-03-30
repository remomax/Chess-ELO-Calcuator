<?php

namespace Praktikant\Praktikum\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use Praktikant\Praktikum\classes\Connection;

class PasswordChangeController
{
public function Index(): void
{

    $connection = new Connection();
    $username = $_SESSION['username'];
    $sql = "SELECT password, email, lastname, firstname FROM `person` WHERE username='$username'";
    $result = $connection->getConnection()->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $email = $row["email"];
            $password_hash = $row["password"];
            $fname = $row["firstname"];
            $lname = $row["lastname"];
        }
    } else {
        echo '0 results';
    }
    $password_old = $_POST['password'];
    $password_new = $_POST['password2'];
    $password_new_2 = $_POST['password3'];
    if ($password_new_2 !== $password_new) {
        redirect(url('PasswordChange', Null, ['Status'=>'ERROR_E'])->getAbsoluteUrl());
    }


    if (password_verify($password_old, $password_hash) == true) {
        $password_new_hash = password_hash($password_new, PASSWORD_DEFAULT);
        if ($password_new == $password_old) {
            redirect(url('PasswordChange', Null, ['Status'=>'ERROR_EE'])->getAbsoluteUrl());
        }
        if ($password_new_2 == $password_old) {
            redirect(url('PasswordChange', Null, ['Status'=>'ERROR_EE'])->getAbsoluteUrl());
        }

        $sql = "UPDATE person SET password = '$password_new_hash' WHERE username = '$username'";
        $result = $connection->getConnection()->query($sql);
        // Konfiguration
        $mail = new PHPMailer();
        $mail->isSMTP(); // SMTP verwenden
        $mail->Host = 'smtp.office365.com'; // SMTP-Server für Microsoft 365
        $mail->SMTPAuth = true; // SMTP-Authentifizierung aktivieren
        $mail->Username = 'maximilian.schwarz@igs-edigheim.de'; // SMTP-Benutzername (deine Microsoft 365 E-Mail-Adresse)
        $mail->SMTPSecure = 'tls'; // TLS-Verschlüsselung verwenden
        $mail->Port = 587; // Port des SMTP-Servers für Microsoft 365
// Empfänger
        $mail->setFrom('maximilian.schwarz@igs-edigheim.de', 'Maximilian Schwarz');
        $mail->addAddress($email, $lname .  $fname); // Empfänger

// Inhalt
        $mail->isHTML(true); // E-Mail als HTML formatieren
        $mail->Subject = 'Chess Calculator Change Password';
        $mail->Body = 'Guten Tag ' . $fname . ", "  . $lname  . '<br>Ihr Password Wurde Erfolgreich Geaendert!';
        if ($mail->send()) {
            redirect(url('PasswordChange', Null, ['Status' => 'Succses'])->getAbsoluteUrl());

        }

    } else {
        redirect(url('PasswordChange', Null, ['Status'=>'ERROR'])->getAbsoluteUrl());
    }
    redirect(url('PasswordChange', Null, ['Status'=>'E_ERROR'])->getAbsoluteUrl());
}
}