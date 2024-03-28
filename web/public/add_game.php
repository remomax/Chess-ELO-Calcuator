<?php
declare(strict_types=1);


use Praktikant\Praktikum\Repository\GameRepository;
$u = "<br>";
require "../app/Repository/GameRepository.php";
require "../app/Repository/PersonRepository.php";
require '../app/classes/Connection.php';
require '../app/classes/Person.php';

$gameRepository = new GameRepository();
$gameRepository->storeGame($_POST);
