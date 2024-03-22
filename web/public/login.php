<?php
declare(strict_types=1);
session_start(); // Starte eine Session
require '../app/classes/Connection.php';
require "../app/Repository/PersonRepository.php";
require '../app/classes/Person.php';
use Praktikant\Praktikum\Repository\PersonRepository;
use Praktikant\Praktikum\classes\Connection;
$personRepo = new PersonRepository();
$persons = $personRepo->getAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>

<form method="post">
    <label for="username">Username:</label>
    <select name="username" required>
        <?php foreach ($persons as $person): ?>
            <option value="<?= $person->getId() ?>"><?= $person->getUsername() ?></option>
        <?php endforeach ?>
    </select>
    <br>
    <!--    <label for="username">Benutzername:</label>-->
    <!--    <input type="text" name="username" id="username" required><br><br>-->
    <label for="password">Passwort:</label>
    <input type="password" name="password" id="password" required><br><br>
    <input type="submit" value="Anmelden">


</form>
</body>
</html>



<?php

// Datenbankverbindung herstellen
$connection = new Connection();

// Überprüfe, ob das Formular abgesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Benutzername aus dem Formular lesen
    $user = $_POST['username'];
    $password = $_POST["password"];


    // SQL-Abfrage, um Benutzerdaten abzurufen
    $sql = "SELECT password FROM person WHERE id='$user' LIMIT 1";
    $result = $connection->getConnection()->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
           $hash = $row["password"];
        }
    } else {
        echo "0 results";
    }

    // Ergebnis der Abfrage holen
        $username = $result->fetch_assoc();

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

