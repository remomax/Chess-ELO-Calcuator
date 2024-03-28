<?php

namespace Praktikant\Praktikum\Controller;
use Praktikant\Praktikum\classes\Logedin;
use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\classes\Html;
class VerifyController
{
public function Index(): void
{
    $connection = new Connection;
    $logedin = new Logedin();
    $logedin->Logedin();


    $html = new Html();
    $html->setTitle('Verify');
    $content = '<br><h1 class="h3 mb-3 font-weight-normal">Ergebnisse:</h1>
    <body class="text-center">
    <main class="form-signin">
    <form method="post">

        <p><input placeholder="E-Mail" type="email" class="form-control" minlength="3" name="username3" required></p>
        <p><input placeholder="Verification ID" type="password" class="form-control" minlength="1" maxlength="20" name="verify_id3" required></p>
        <p><input class="btn btn-lg btn-primary btn-block" type="submit"></p>

    </form>
    </main> </body>';
    $html->render(['content' => $content, 'body_class' => 'text-center']);




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