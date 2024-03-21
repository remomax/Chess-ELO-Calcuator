<?php
declare(strict_types=1);
start_session();
require '../app/classes/Connection.php';
$connection = new Connection;
?>
    <form method="post">

        <p><input minlength="3" maxlength="20" name="username" required> Username:</p>
        <p><input minlength="1" maxlength="20" name="verify_id" required> Verification ID:</p>
        <p><input type="submit"></p>

    </form>
<?php
$username = $_POST["username"];
$verify_id = $_POST["verify_id"];

$sql = "SELECT verify_id FROM person WHERE username='$username' LIMIT 1";
$result = $connection->getConnection()->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $hash = $row["verify_id"];
    }
} else {
    echo "0 results";
}

// Ergebnis der Abfrage holen
    $username = $result->fetch_assoc();

    // Überprüfe das verschlüsselte eingegebene Passwort mit dem verschlüsselten Passwort aus der Datenbank
    if (password_verify($verify_id, $hash)) {
        // Anmeldung erfolgreich
        $_SESSION['verifyed'] = true;
        echo "<br>";
        echo "SUCCSESFUL!";
        echo "<br>";


        $statement = $connection->prepare('INSERT INTO person (verify_id, is_verify) WHERE username = '$username' LIMIT 1
    VALUES (?, ?)');
    $statement->bind_param(
        'ss',
        0,
        "true",
    );
    $statement->execute();
}

    
     else {
        // Falsche Anmeldeinformationen
        $error = "Falsche Anmeldeinformationen";
        echo $error;
    }


