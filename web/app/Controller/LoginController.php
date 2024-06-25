<?php
declare(strict_types=1);

namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\classes\Html;

class LoginController
{
    public function index(): void
    {
        $Status = $_GET["Status"] ?? '';
        if ($Status == 'BadLogin')
        {
            $error = '<h2 class="h3 mb-3 font-weight-normal" style="color: red">Falsche Anmelde Informationen</h2>';
        } elseif ($Status == 'Logout'){
            $error = '<h2 class="h3 mb-3 font-weight-normal" style="color: red">Erfolgreich Ausgeloggt</h2>';
        } elseif ($Status == 'Verify'){
            $error = '<h2 class="h3 mb-3 font-weight-normal" style="color: red">Du bist noch nicht Verifizirt, Falls du keine Email bekommen hast wenne dich an <a href=mailto:"chesscalculatorhelp@outlook.de">chesscalculatorhelp@outlook.de</a> </h2>';
            } elseif ($Status == 'VerifyDone'){
            $error = '<h2 class="h3 mb-3 font-weight-normal" style="color: green">Du hasst dich Erforlgreich Verifizirt! Melde dich nun an!</h2>';
            }
        else {
            $error = '';
        }
        $html = new Html();
        $html->setTitle('Loggen Sie sich ein');
        $content = '<br><h2 class="h3 mb-3 font-weight-normal">Login</h2>' . $error . '
<body class="text-center"
<main class="form-signin">
<form class="form-signin" method="post">

    <input minlength="3" maxlength="20" type="text" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus>
    <br>
    
    <input minlength="8" maxlength="100" class="form-control" type="password" name="password" id="password" placeholder="Password" required><br><br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Anmelden">Anmelden</button>
</form>
</main> </body>';
        $html->render(['content' => $content, 'body_class' => 'text-center']);
    }

    public function login(): void
    {
        // Datenbankverbindung herstellen
        $connection = new Connection();

// Überprüfe, ob das Formular abgesendet wurde
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Benutzername aus dem Formular lesen
            $username = $_POST['username'];
            $password = $_POST["password"];


            // SQL-Abfrage, um Benutzerdaten abzurufen
            $sql = 'SELECT password, is_verifyed FROM person WHERE username="' . $username . '" LIMIT 1';
            $result = $connection->getConnection()->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $hash = $row["password"];
                    if ($row["is_verifyed"] === '') {$verify_id_login = 0;} else {
                    $verify_id_login = $row["is_verifyed"];
                }
                }
            } else {
                $error = "Falsche Anmeldeinformationen";
                redirect(url('login', Null, ['Status'=>'BadLogin'])->getAbsoluteUrl());
                exit;
            }

            // Ergebnis der Abfrage holen
            $user = $result->fetch_assoc();
            
            if  ($verify_id_login !== '') {
                if ($verify_id_login !== 0) {
                    if ($verify_id_login == 1) {
            // Überprüfe das verschlüsselte eingegebene Passwort mit dem verschlüsselten Passwort aus der Datenbank
            if (password_verify($password, $hash)) {
                // Anmeldung erfolgreich
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['verifyed'] = true;
                redirect(url('/')->getAbsoluteUrl());
                exit();
            } else {
                // Falsche Anmeldeinformationen
                $error = "Falsche Anmeldeinformationen";
                redirect(url('login', Null, ['Status'=>'BadLogin'])->getAbsoluteUrl());
                exit();
            }
        } else {redirect(url('login', Null, ['Status'=>'Verify'])->getAbsoluteUrl()); exit();}
        } else {redirect(url('login', Null, ['Status'=>'Verify'])->getAbsoluteUrl()); exit();}
        } else {redirect(url('login', Null, ['Status'=>'Verify'])->getAbsoluteUrl()); exit();}
            }
        }
    }

