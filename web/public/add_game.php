<?php
declare(strict_types=1);
global $ELOA, $ELOB;


use Praktikant\Praktikum\Repository\GameRepository;
$u = "<br>";
require "../app/Repository/GameRepository.php";
require "../app/Repository/PersonRepository.php";
require '../app/classes/Connection.php';
require '../app/classes/Person.php';



$redirect = function () {
    header('Location: http://localhost:8000/calculator.php', true, 301);
    exit();
};




//$connection = new Connection();
//$id_white = $_POST["id_a"];
//$id_black = $_POST["id_b"];
//echo $id_white . $id_black;
//
//if ($id_white == $id_black) {
//    $redirect;
//}


//$connection = $connection->getConnection();
//
//$statement = $connection->prepare('INSERT INTO games (id_white, id_black, gameoutcome, elo_white_before, elo_white_after, elo_black_before, elo_black_after)
//    VALUES (?, ?, ?, ?, ?, ?, ?)');
//$statement->bind_param(
//    'ddsdddd',
//    $id_white,
//    $id_black,
//    $gameoutcome,
//    $elo_white_before,
//    $elo_white_after,
//    $elo_black_before,
//    $elo_black_after,
//);
//$statement->execute();