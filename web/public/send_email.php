<?php

// Include PHPMailer
require '../vendor/autoload.php'; // Pfad zur autoload.php entsprechend deiner Installation

// Konfiguration
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP(); // SMTP verwenden
$mail->Host = 'smtp.office365.com'; // SMTP-Server für Microsoft 365
$mail->SMTPAuth = true; // SMTP-Authentifizierung aktivieren
$mail->Username = ''; // SMTP-Benutzername (deine Microsoft 365 E-Mail-Adresse)
$mail->Password = ''; // SMTP-Passwort (dein Microsoft 365 Passwort)
$mail->SMTPSecure = 'tls'; // TLS-Verschlüsselung verwenden
$mail->Port = 587; // Port des SMTP-Servers für Microsoft 365

// Empfänger
$mail->setFrom('', ''); // Sender
$mail->addAddress('', ''); // Empfänger

// Inhalt
$mail->isHTML(true); // E-Mail als HTML formatieren
$mail->Subject = 'Test-E-Mail über Microsoft 365';
$mail->Body = 'Dies ist ein Test-E-Mail, das über den SMTP-Server von Microsoft 365 gesendet wurde.';

// E-Mail senden
if (!$mail->send()) {
    echo 'E-Mail konnte nicht gesendet werden.';
    echo 'Fehler: ' . $mail->ErrorInfo;
} else {
    echo 'E-Mail wurde gesendet.';
}

?>
