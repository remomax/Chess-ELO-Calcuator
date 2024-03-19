<?php
declare(strict_types=1);
global $ELOB;
global $ELOA;
$u = "<br>";
require "calculator.php";
var_dump($ELOB);


$connection = new Connection();



$connection = $connection->getConnection();



$statement = $connection->prepare('INSERT INTO games (id_white, id_black, gameoutcome, elo_white_before, elo_white_after, elo_black_before, elo_black_after, gametype)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$statement->bind_param(
    'ddsdddds',
    $id_white,
    $id_black,
    $gameoutcome,
    $elo_white_before,
    $elo_white_after,
    $elo_black_before,
    $elo_black_after,
    $gametype,
);
$statement->execute();