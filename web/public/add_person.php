<?php
declare(strict_types=1);
require '../app/classes/Connection.php';

$connection = new Connection();
$redirect = function () {
    header('Location: http://localhost:8000/index.php', true, 301);
    exit();
};

$_password = $_POST["password"];
$_hash = password_hash($_password, PASSWORD_DEFAULT);
$verify = password_verify($_password, $_hash);
if ($verify = true) {

    $sql = sprintf("INSERT INTO person (age, lastname, firstname, elo, plz, hausnummer, street, email, games, username, password) 
            VALUES (%d, '%s', '%s', %d, '%s', '%s', '%s', '%s', %d, '%s', '%s')",
                $_POST["age"],
                $_POST["lname"],
                $_POST["fname"],
                $_POST["elo"],
                $_POST["plz"],
                $_POST["hausnummer"],
                $_POST["street"],
                $_POST["email"],
                $_POST["games"],
                $_POST["username"],
                $_hash,
    );

}
elseif ($verify = false) {
    echo "ERROR, Reload Page ";
}


//$sql = sprintf("INSERT INTO person (age, lastname, firstname, elo, plz, hausnummer, street, email, games, username, password)
//VALUES (%d, '%s', '%s', %d, '%s', '%s', '%s', '%s', %d, '%s', '%s')",
//    $_POST["age"],
//    $_POST["lname"],
//    $_POST["fname"],
//    $_POST["elo"],
//    $_POST["plz"],
//    $_POST["hausnummer"],
//    $_POST["street"],
//    $_POST["email"],
//    $_POST["games"],
//    $_POST["username"],
//    $_hash,
//);



$redirect();