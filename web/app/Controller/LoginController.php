<?php

namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Connection;

class LoginController
{
    public function index(): void
    {
        echo '<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>

<form method="post">
    <label for="username">Username:</label>
    <input name="username" required>
    <br>
    <label for="password">Passwort:</label>
    <input type="password" name="password" id="password" required><br><br>
    <input type="submit" value="Anmelden">
</form>
</body>
</html>';
    }

    public function login(): void {
        // Datenbankverbindung herstellen
        $connection = new Connection();

// Überprüfe, ob das Formular abgesendet wurde
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Benutzername aus dem Formular lesen
            $username = $_POST['username'];
            $password = $_POST["password"];


            // SQL-Abfrage, um Benutzerdaten abzurufen
            $sql = 'SELECT password FROM person WHERE username="'.$username.'" LIMIT 1';
            $result = $connection->getConnection()->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $hash = $row["password"];
                }
            } else {
                echo "0 results";
                exit;
            }

            // Ergebnis der Abfrage holen
            $user = $result->fetch_assoc();

            // Überprüfe das verschlüsselte eingegebene Passwort mit dem verschlüsselten Passwort aus der Datenbank
            if (password_verify($password, $hash)) {
                // Anmeldung erfolgreich
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;

                redirect(url('/'));
            } else {
                // Falsche Anmeldeinformationen
                $error = "Falsche Anmeldeinformationen";
                echo $error;
            }

        }
    }
}