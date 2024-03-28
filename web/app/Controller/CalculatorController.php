<?php

namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Html;
use Praktikant\Praktikum\Repository\PersonRepository;
use Praktikant\Praktikum\classes\Logedin;
class CalculatorController
{
public function index():void
{
    $logedin = new Logedin();
    $logedin->Logedin();
    $personRepo = new PersonRepository();
    $persons = $personRepo->getAll();
    $personoptions = '';
    foreach ($persons as $person) {
        $personoptions .= '<option value="' .  $person->getId() . '">' .  $person->getUsername() . '</option>';
    }

    $html = new Html();
    $html->setTitle('Calculator');
    $content = '
<body class="text-center"
<form class="form-signin" method="post" action="add_game.php">
<h1 class="h3 mb-3 font-weight-normal">Calculator</h1>
    <h6></h6>

    <label for="id_a">Player White</label>

    <select class="form-control" name="player_white">
            ' . $personoptions . '
    </select>
    <br>
    <label  for="id_b">Player Black</label>
    <select class="form-control" name="player_black">
            ' . $personoptions .  '
    </select>
    <br>

    <label for="winner">Who won the game?</label>
    <select class="form-control" name="winner">
        <option value="white">White</option>
        <option value="black">Black</option>
        <option value="remis">Remis</option>
    </select>

    <p><input type="submit"></p>
</form>';
    $html->render(['content' => $content, 'body_class' => 'text-center']);
}
}

