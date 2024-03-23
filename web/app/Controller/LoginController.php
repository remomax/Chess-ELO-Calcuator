<?php
declare(strict_types=1);

namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\classes\Html;

class LoginController
{
    public function index(): void
    {
        $html = new Html();
        $html->setTitle('Loggen Sie sich ein');
        $content = '<h2>Login</h2>
<main class="form-signin">
<form class="form-signin" method="post">
    <label for="username">Username:</label>
    <input name="username" class="form-control" required>
    <br>
    <label for="password">Passwort:</label>
    <input type="password" name="password" id="password" required><br><br>
    <input type="submit" value="Anmelden">
</form>
</main>';
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
            $sql = 'SELECT password FROM person WHERE username="' . $username . '" LIMIT 1';
            $result = $connection->getConnection()->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $hash = $row["password"];
                }
            } else {
                $error = "Falsche Anmeldeinformationen";
                echo $error;
                exit;
            }

            // Ergebnis der Abfrage holen
            $user = $result->fetch_assoc();

            // Überprüfe das verschlüsselte eingegebene Passwort mit dem verschlüsselten Passwort aus der Datenbank
            if (password_verify($password, $hash)) {
                // Anmeldung erfolgreich
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header('Location: http://localhost:8000/', true, 301);
                exit();
            } else {
                // Falsche Anmeldeinformationen
                $error = "Falsche Anmeldeinformationen";
                echo $error;
            }

        }
    }
}