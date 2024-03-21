<?php

// Include PHPMailer
require '../vendor/autoload.php'; // Pfad zur autoload.php entsprechend deiner Installation
require '../app/classes/Person.php';
$_mail = new Person;
$redirect = function () {
    header('Location: http://localhost:8000/index.php', true, 301);
    exit();
};
$lname = $_mail->getLName();
$fname = $_mail->getFName();
$email = $_mail->getMail();
$username = $_mail->getUsername();




// Funktion, um einen zufälligen String zu generieren
function generateRandomString($length = 10)
{
    // Zeichen, die im zufälligen String enthalten sein sollen
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_+=';
    $randomString = '';
    // Generiere den zufälligen String
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Aufruf der Funktion, um den zufälligen String zu generieren
$verify_id = generateRandomString();





// Konfiguration
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP(); // SMTP verwenden
$mail->Host = 'smtp.office365.com'; // SMTP-Server für Microsoft 365
$mail->SMTPAuth = true; // SMTP-Authentifizierung aktivieren
$mail->Username = 'maximilian.schwarz@igs-edigheim.de'; // SMTP-Benutzername (deine Microsoft 365 E-Mail-Adresse)
$mail->Password = 'Max2010!'; // SMTP-Passwort (dein Microsoft 365 Passwort)
$mail->SMTPSecure = 'tls'; // TLS-Verschlüsselung verwenden
$mail->Port = 587; // Port des SMTP-Servers für Microsoft 365

// Empfänger
$mail->setFrom('maximilian.schwarz@igs-edigheim.de', 'Maximilian Schwarz'); // Sender
$mail->addAddress($email, $lname . ", " . $fname); // Empfänger

// Inhalt
$mail->isHTML(true); // E-Mail als HTML formatieren
$mail->Subject = 'Chess Calculator Verification';
$mail->Body = 'Gehen sie auf: <a href="verify.php">Hier</a> und verifiziren sie sich mit ihrem Verifikations Code: ' . $verify_id .
                'Wenn sie sich nicht Regestirt haben wennen sie sich bitte an <a href=mailto:"chesscalculatorhelp@outlook.de"></a>' .
                '(Link: http://localhost:8000/verify.php)';

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
