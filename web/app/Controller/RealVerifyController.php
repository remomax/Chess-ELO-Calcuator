<?php

namespace Praktikant\Praktikum\Controller;

class RealVerifyController
{
public function Index(): void
{


    $username3 = $_POST["username3"];
    $verify_id3 = $_POST["verify_id3"];

    $sql = "SELECT verify_id FROM person WHERE username='$username3' LIMIT 1";
    $result = $connection->getConnection()->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $hash = $row["verify_id3"];
        }
    } else {
        echo "0 results";
    }

// Ergebnis der Abfrage holen
    $username = $result->fetch_assoc();

    // Überprüfe das verschlüsselte eingegebene Passwort mit dem verschlüsselten Passwort aus der Datenbank
    if (password_verify($verify_id3, $hash)) {
        // Anmeldung erfolgreich
        $_SESSION['verifyed'] = true;
        echo "<br>";
        echo "SUCCSESFUL!";
        echo "<br>";


        $statement = $connection->prepare('UPDATE person SET verify_id = ?, is_verifyed = ? WHERE username = ? ');
        $statement->bind_param(
            'sss',
            0,
            "true",
            $username,
        );
        $statement->execute();
    }


    else {
        // Falsche Anmeldeinformationen
        $error = "Falsche Daten";
        echo $error;
    }
}
}