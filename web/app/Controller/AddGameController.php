<?php

namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\classes\Html;
use Praktikant\Praktikum\Repository\PersonRepository;


class AddGameController
{
    public function index(): void
    {


        $personRepository = new PersonRepository();

        $whitePlayer = $personRepository->getOne($_POST['player_white']);
        $blackPlayer = $personRepository->getOne($_POST['player_black']);
        // Set Variables
        $RA = $whitePlayer->getELO(); //Old ELO of White Player
        $RB = $blackPlayer->getELO(); //Old ELO of Black Player
        $K = 40;

        [$SA, $SB] = $this->getScore($_POST['winner']);
        $gameoutcome = ucfirst($_POST['winner']);

        // PLayer White
        $connection = new Connection();
        $differenzBA = $RB - $RA;
        $differenzBA400 = $differenzBA / 400;
        $hoch10BA = pow(10, $differenzBA400);
        $nennerBA = $hoch10BA + 1;
        $EA = 1 / $nennerBA;
        $ELOA_round = $RA + $K * ($SA - $EA);
        $ELOA = floor($ELOA_round); // $ELOA = New ELO of Player White


        // Player Black
        $differenzAB = $RA - $RB;
        $differenzAB400 = $differenzAB / 400;
        $hoch10AB = pow(10, $differenzAB400);
        $nennerAB = $hoch10AB + 1;
        $EB = 1 / $nennerAB;
        $ELOB_round = $RB + $K * ($SB - $EB);
        $ELOB = floor($ELOB_round); // $ELOB = New ELO of Player Black


        if ($ELOA < 0) {
            $ELOA = 0;
        }
        if ($ELOB < 0) {
            $ELOB = 0;
        }



        // Stroing Variable
        $elo_white_before = $whitePlayer->getELO();
        $elo_black_before = $blackPlayer->getELO();
        $elo_white_after = $ELOA;
        $elo_black_after = $ELOB;
        //----------------------------------
        $id_white = $_POST["player_white"];
        $id_black = $_POST["player_black"];
        if ($id_black == $id_white) {
            redirect(url('calculator', Null, ['Status'=>'GleicherSpieler'])->getAbsoluteUrl());
        }
        $sql = "SELECT username FROM person WHERE id = '$id_black' LIMIT 1";
        $result = $connection->getConnection()->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

                $username_black = $row["username"];
            }
        } else {
            echo '0 results';
        }
        $sql = "SELECT username FROM person WHERE id = '$id_white' LIMIT 1";
        $result = $connection->getConnection()->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

                $username_white = $row["username"];
            }
        } else {
            echo '0 results';
        }
        $username = $_SESSION['username'];
        if ($username !== $username_white) {
            if ($username !== $username_black) {
                redirect(url('calculator', Null, ['Status'=>'EigenerSpieler'])->getAbsoluteUrl());
            }
        }
        elseif ($username !== $username_black) {
            if ($username !== $username_white) {
                redirect(url('calculator', Null, ['Status'=>'EigenerSpieler'])->getAbsoluteUrl());
            }
        }



        $connection = $connection->getConnection();

        $statement = $connection->prepare('INSERT INTO games (id_white, id_black, gameoutcome, elo_white_before, elo_white_after, elo_black_before, elo_black_after, K_Wert)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param(
            'ddsddddd',
            $id_white,
            $id_black,
            $gameoutcome,
            $elo_white_before,
            $elo_white_after,
            $elo_black_before,
            $elo_black_after,
            $K,
        );

        $statement->execute();
        $statement = $connection->prepare('UPDATE person SET elo = ? WHERE id = ?');
        $statement->bind_param(
            'dd',
            $elo_black_after,
            $id_black,
        );
        $statement->execute();


        $statement = $connection->prepare('UPDATE person SET elo = ? WHERE id = ?');
        $statement->bind_param(
            'dd',
            $elo_white_after,
            $id_white,
        );
        $statement->execute();

        $html = new Html();
        $html->setTitle('Results');
        $content = '<br><h1 class="h3 mb-3 font-weight-normal">Ergebnisse:</h1>
<body class="text-center"
<main class="form-signin">
<form class="form-signin" method="post">

    <h1 class="form-control">Neue ELO Weiß: ' . $elo_white_after .'   </h1>
    <h1 class="form-control">Neue ELO Schwarz: ' . $elo_black_after .' </h1>  
    <button class="btn btn-lg btn-primary btn-block" type="button" onclick="history.back();">Back</button>
</form>
</main> </body>';
        $html->render(['content' => $content, 'body_class' => 'text-center']);

    }


    private function getScore(string $winner): array
    {
        return match ($winner) {
            'white' => [1, 0],
            'black' => [0, 1],
            'remis' => [0.5, 0.5],
        };
    }


}

