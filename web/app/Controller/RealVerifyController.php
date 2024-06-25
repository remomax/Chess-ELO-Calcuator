<?php
declare(strict_types=1);
namespace Praktikant\Praktikum\Controller;
use Praktikant\Praktikum\classes\Connection;
class RealVerifyController
{
public function Index(): void
{


    $username3 = $_POST["username3"];
    $verify_id3 = $_POST["verify_id3"];
    $connection = new Connection();
    $sql = 'SELECT verify_id FROM person WHERE username="' . $username3 . '" LIMIT 1';
    $result = $connection->getConnection()->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $hash = $row["verify_id"];
        }
    } else {

    }

// Ergebnis der Abfrage holen
    $username = $result->fetch_assoc();

    // Überprüfe das verschlüsselte eingegebene Passwort mit dem verschlüsselten Passwort aus der Datenbank
    if (password_verify($verify_id3, $hash)) {
        // Anmeldung erfolgreich
        $_SESSION['verifyed'] = true;



        $sql = ('UPDATE person SET is_verifyed = "' . 1 . '" WHERE username = "' . $username3 . '"');
        
        $result = $connection->getConnection()->query($sql);
            redirect(url('login', Null, ['Status'=>'VerifyDone'])->getAbsoluteUrl()); exit();
        
    }   else {
        // Falsche Anmeldeinformationen
        $error = "Falsche Daten";
    }
}
}
