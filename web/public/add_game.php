<?php
declare(strict_types=1);
$u = "<br>";
require '../app/classes/Connection.php';
require "../app/classes/game.php";
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