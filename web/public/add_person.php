<?php
declare(strict_types=1);
require '../app/classes/Connection.php';

$connection = new Connection();
$redirect = function () {
    header('Location: http://localhost:8000/index.php', true, 301);
    exit();
};

if ($_POST["age"] === '') {
    $redirect();
}
if ($_POST["lname"] === '') {
    $redirect();
}
if ($_POST["fname"] === '') {
    $redirect();
}
if ($_POST["elo"] = '') {
    $redirect();
}
if ($_POST["plz"] === '') {
    $redirect();
}
if ($_POST["hausnummer"] === '') {
    $redirect();
}
if ($_POST["street"] === '') {
    $redirect();
}
if ($_POST["email"] === '') {
    $redirect();
}
if ($_POST["games"] === '') {
    $redirect();
}

$sql = sprintf("INSERT INTO person (age, lastname, firstname, elo, plz, hausnummer, street, email, games) 
VALUES (%d, '%s', '%s', %d, '%s', '%s', '%s', '%s', %d)",
    $_POST["age"],
    $_POST["lname"],
    $_POST["fname"],
    $_POST["elo"],
    $_POST["plz"],
    $_POST["hausnummer"],
    $_POST["street"],
    $_POST["email"],
    $_POST["games"],

);

$connection->getConnection()->query($sql);


$redirect();