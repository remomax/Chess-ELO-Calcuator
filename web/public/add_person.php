<?php
declare(strict_types=1);
require '../app/classes/Connection.php';
$_POST["elo"] = 0;
$_POST["games"] = 0;
$connection = new Connection();
$redirect = function () {
    header('Location: http://localhost:8000/index.php', true, 301);
    exit();
};
$die = function () {
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
};




//Checken ob der Username schon Vergeben ist
$username = $_POST["username"];
$sql = "SELECT * FROM person WHERE username='$username'";
$result = $connection->getConnection()->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Benutzername Schon vergeben</h1>";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}
if ($_POST["username"] == '') {
    echo "<h1>Du must ein Username haben</h1>";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}

if ($_POST["password"] == '') {
    echo "<h1>Du must ein Password haben</h1>";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}

//Checken ob Alt Genug
$age = $_POST["age"];
if ($age <= 12) {
    echo "<h1>Du must 13 Jahre alt sein</h1>";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}


if ($_POST["lname"] == '') {
    echo "Du must einen Nachnamen haben";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}
if ($_POST["fname"] == '') {
    echo "Du must einen Vornamen haben";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}
if ($_POST["plz"] == '') {
    echo "Du must eine PLZ haben";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}

if ($_POST["hausnummer"] == '') {
    echo "Du must eine Hausnummer haben";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}
if ($_POST["street"] == '') {
    echo "Du must eine Straße haben";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}



//Email setzten
$email = $_POST["email"];

//Checken ob Email vergeben ist
$sql = "SELECT * FROM person WHERE email='$email'";
$result = $connection->getConnection()->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Email Schon vergeben</h1>";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}

//Checken ob email @ hat
if (strpos($email, "@") !== false) {

} else {
    echo "<h1>In einer Email muss ein @ Sein!</h1>";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}

// Checken ob Email exestirt
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

} else {
    echo "<h1>Die Email muss exstiren</h1>";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}
//Checken ob Domain Exestirt
if (filter_var($email, FILTER_VALIDATE_DOMAIN)) {

} else {
    echo "<h1>Die Email Domain muss exstiren</h1>";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}
//Checken ob Domain Exestirt über DNS
$domain = substr(strrchr($email, "@"), 1);
if (checkdnsrr($domain, "MX")) {

} else {
    echo "Die Domain existiert nicht.";
    echo "<h1><a href='register.php'>Zurück</a></h1>";
    die();
}



// Password Verschlüsseln
$_password = $_POST["password"];
$_hash = password_hash($_password, PASSWORD_DEFAULT);
$verify = password_verify($_password, $_hash);
// Verifyen ob das Password richtig gespeichert wurde

if ($verify = true) {
    // Benutzer Abspeichern
    $connection = $connection->getConnection();
    $statement = $connection->prepare('INSERT INTO person (age, lastname, firstname, elo, plz, hausnummer, street, email, games, username, password)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $statement->bind_param(
        'dssdssssdss',
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
        $_hash
    );
    $statement->execute();
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