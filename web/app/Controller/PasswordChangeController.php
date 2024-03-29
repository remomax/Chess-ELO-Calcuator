<?php

namespace Praktikant\Praktikum\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\classes\mailpassword;

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

    if (password_verify($password_old, $password_hash) == true) {
        $password_new_hash = password_hash($password_new, PASSWORD_DEFAULT);
        $sql = "UPDATE person SET password = '$password_new_hash' WHERE username = '$username'";
        $result = $connection->getConnection()->query($sql);
        // Konfiguration
        $mail = new mailpassword();
        $mail->GetEmail();

// Empfänger
        $mail->setFrom('maximilian.schwarz@igs-edigheim.de', 'Maximilian Schwarz'); // Sender
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
}
}