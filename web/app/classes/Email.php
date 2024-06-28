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
        $mail_class['Mail'] = ' '; //Hier die Email eintragen von sich selbst (string)
        $mail_class['Password'] = ' '; //Hier das Email Password (string)
        $mail_class['isSMTP'] = ''; //Leer Lassen am besten (string)
        $mail_class['Host'] = ' '; //Hier denn Host angeben (string)
        $mail_class['SMTPAuth'] = true; //Hier die SMTPAuth auf 'true' order 'false' setzen (bool)
        $mail_class['Username'] = $mail_class['Mail']; (string)
        $mail_class['SMTPSecure'] ' '; //Leer Lassen am besten (string)
        $mail_class['Port'] = ; //Port anbegen (Int)
        // Empfänger
        $mail_class['setFrom'] = $mail_class['Mail'], 'Hier Namen Von absender eintragen' //Beim Zweiten einfach denn Namen angeben der angezeigt werden soll wie zb. Reiner Fischer (string) (string)

        // Inhalt
        $mail_class[isHTML] = true; //Das ambesten auf 'true' lassen das die Email in HTML Geschriben werden kann (bool)

        return new Email($mail_class);
    }

}
