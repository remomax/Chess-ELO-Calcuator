<?php
declare(strict_types=1);
require '../app/classes/Connection.php';
$connection = new Connection();
?>
<form method="post">

    <p><input minlength="3" maxlength="20" name="username"> Username:</p>
    <p><input type="password" id="password" minlength="8" maxlength="100" name="password"> Password (8 characters minimum):</p>
    <p><input type="submit"></p>

</form>



<?php


// Speichern des Passwort-Hashes
//password_hash($_POST["password"], PASSWORD_DEFAULT);
//var_dump($_POST["password"]);
//$query  = sprintf("INSERT INTO users(username, password) VALUES('%s','%s');",
//    pg_escape_string($_POST["username"]),
//
//$result = pg_query($connection, $query);
//
//// Abfragen, ob der User das richtige Passwort übermittelt hat
//$query = sprintf("SELECT password FROM person WHERE name='%s';",
//    pg_escape_string($_POST["username"]));
//$row = pg_fetch_assoc(pg_query($connection, $query));
//
//if ($row && password_verify($_POST["password"], $row['password'])) {
//    echo 'Willkommen, ' . htmlspecialchars($_POST["username"]) . '!';
//} else {
//    echo 'Authentifizierung für ' . htmlspecialchars($_POST["username"]) . 'fehlgeschlagen.';
//}
//
//
$plaintext_password = "UAWIF9U87Z832788kriuh9iwe--!!!!";

// The hash of the password that
// can be stored in the database
$hash = password_hash($plaintext_password,
    PASSWORD_DEFAULT);

// Print the generated hash
echo "Generated hash: ".$hash;
echo "<br>";
var_dump($plaintext_password);
echo "<br>";
var_dump($hash);
?>
