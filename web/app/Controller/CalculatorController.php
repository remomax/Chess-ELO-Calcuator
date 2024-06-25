<?php
declare(strict_types=1);
namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Html;
use Praktikant\Praktikum\Repository\PersonRepository;
use Praktikant\Praktikum\classes\Logedin;
use Praktikant\Praktikum\Controller\AddGameController;
class CalculatorController
{
public function index():void
{
    $Status = $_GET["Status"] ?? '';
    if ($Status == 'GleicherSpieler')
    {
        $error = '<h2 class="h3 mb-3 font-weight-normal" style="color: red">Der Gleiche Spieler kann nicht gegen sich selbst spielen</h2>';
    } elseif ($Status == 'EigenerSpieler') {
        $error = '<h2 class="h3 mb-3 font-weight-normal" style="color: red">Du kannst nur für dich Selbst Spiele Eintragen</h2>';
} else {
        $error = '';
    }
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
    $content = '<h1 class="h3 mb-3 font-weight-normal">Calculator</h1>' . $error . '
<body class="text-center">

<form class="form-signin" method="post" action="/AddGameController">

    <h6></h6>

    <label for="id_a">Spieler Weiß</label>

    <select class="form-control" name="player_white">
            ' . $personoptions . '
    </select>
    <br>
    <label  for="id_b">Spieler Schwarz</label>
    <select class="form-control" name="player_black">
            ' . $personoptions .  '
    </select>
    <br>

    <label for="winner">Wer hat gewonnen?</label>
    <select class="form-control" name="winner">
        <option value="white">Weiß</option>
        <option value="black">Schwarz</option>
        <option value="remis">Unendschieden/Remis</option>
    </select>
    <label for="Gamemodie"><br>Welcher Gamemodie?</label>
    <select class="form-control" name="Gamemodie">
        <option value="RAPID">Schnell-Schach</option>
        <option value="BLITZ">Blitz-Schach</option>
    </select>

    <br><button class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">Abschicken</button>
</form></body>';
    $html->render(['content' => $content, 'body_class' => 'text-center']);
}
}

