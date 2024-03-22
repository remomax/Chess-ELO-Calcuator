<?php

// Include PHPMailer
require '../vendor/autoload.php'; // Pfad zur autoload.php entsprechend deiner Installation
require '../app/classes/Person.php';
require '../app/classes/Connection.php';
use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\classes\Person;
//include 'add_person.php';
$_mail = new Person();
$connection = new Connection;
$redirect = function () {
    header('Location: http://localhost:8000/index.php', true, 301);
    exit();
};
//var_dump($_mail);
//$lname = $_mail->getLName();
//$fname = $_mail->getFName();
//$email = $_mail->getMail();
//$username = $_mail->getUsername();
//$verify_id = $_mail->getVerifyID();

$verify_id = $_POST["verify_id"];
$email = $_POST["email"];
$lname = $_POST["lname"];
$fname = $_POST["fname"];
//$username = $_POST["username"];





// Konfiguration
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP(); // SMTP verwenden
$mail->Host = 'smtp.office365.com'; // SMTP-Server für Microsoft 365
$mail->SMTPAuth = true; // SMTP-Authentifizierung aktivieren
$mail->Username = 'maximilian.schwarz@igs-edigheim.de'; // SMTP-Benutzername (deine Microsoft 365 E-Mail-Adresse)
$mail->Password = ''; // SMTP-Passwort (dein Microsoft 365 Passwort)
$mail->SMTPSecure = 'tls'; // TLS-Verschlüsselung verwenden
$mail->Port = 587; // Port des SMTP-Servers für Microsoft 365

// Empfänger
$mail->setFrom('maximilian.schwarz@igs-edigheim.de', 'Maximilian Schwarz'); // Sender
$mail->addAddress($email, $lname . ", " . $fname); // Empfänger

// Inhalt
$mail->isHTML(true); // E-Mail als HTML formatieren
$mail->Subject = 'Chess Calculator Verification';
$mail->Body = 'Guten Tag' . $fname . ", "  . $username  . '<br>Gehen sie auf: <a href="verify.php">Hier</a> und verifiziren sie sich mit ihrem Verifikations Code: ' . $verify_id .
                '<br>Wenn sie sich nicht Regestirt haben wennen sie sich bitte an <a href=mailto:"chesscalculatorhelp@outlook.de"></a>' .
                '<br>(Link: http://localhost:8000/verify.php)';

// E-Mail senden
if (!$mail->send()) {
    echo 'E-Mail konnte nicht gesendet werden.';
    echo 'Fehler: ' . $mail->ErrorInfo;
} else {
    echo 'E-Mail wurde gesendet.';
    echo '<br>';
    echo 'Du hast 1 Woche zeit deine Email zu verifiziren!';
    sleep(5);
    $redirect;
}

?>
