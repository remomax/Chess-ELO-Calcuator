<?php
declare(strict_types=1);

namespace Praktikant\Praktikum\classes;

use PHPMailer\PHPMailer\PHPMailer;
use Praktikant\Praktikum\classes\Html;

class Email
{
    public function getEmail(): void
    {
        
        // Konfiguration
        $mail_class['Mail'] = ''; //Hier die Email eintragen von sich selbst
        $mail_class['Password'] = ''; //Hier das Email Password
        $mail_class['isSMTP'] = ''; //Leer Lassen am besten
        $mail_class['Host'] = ''; //Hier denn Host angeben
        $mail_class['SMTPAuth'] = true; //Hier die SMTPAuth auf 'true' order 'false' setzen
        $mail_class['Username'] = $mail_class['Mail'];
        $mail_class['SMTPSecure'] ''; //
        $mail_class['Port'] = ; //Port anbegen
        // Empfänger
        $mail_class['setFrom'] = $mail_class['Mail'], '' //Beim Zweiten einfach denn Namen angeben der angezeigt werden soll wie zb. Reiner Fischer

        // Inhalt
        $mail_class[isHTML] = true; //Das ambesten auf 'true' lassen das die Email in HTML Geschriben werden kann

        return new Email($mail_class);
    }

}
