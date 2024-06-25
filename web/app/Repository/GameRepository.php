<?php
declare(strict_types=1);
namespace Praktikant\Praktikum\Repository;

use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\classes\Html;
use Praktikant\Praktikum\Controller\AddGameController;

class GameRepository
{
    public function storeGame(array $post): bool
    {
        $personRepository = new PersonRepository();

        $whitePlayer = $personRepository->getOne($post['player_white']);
        $blackPlayer = $personRepository->getOne($post['player_black']);
        // Set Variables
        $RA = $whitePlayer->getELO(); //Old ELO of White Player
        $RB = $blackPlayer->getELO(); //Old ELO of Black Player
        $K = 40;

        [$SA, $SB] = $this->getScore($post['winner']);
        $gameoutcome = ucfirst($post['winner']);

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
        $id_white = $post["player_white"];
        $id_black = $post["player_black"];
        if ($id_black == $id_white) {
            die();
        }
        if ($id_white == $_SESSION['username']) {
            $_SESSION['Gegner'] = $id_black;
        }
        if ($id_black == $_SESSION['username']){
            $_SESSION['Gegner'] = $id_white;
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
        $html->setTitle('Loggen Sie sich ein');
        $content = '<br><h2 class="h3 mb-3 font-weight-normal">Loggen Sie sich ein</h2>
<body class="text-center"
<main class="form-signin">
<form class="form-signin" method="post">

    <h1>Hallo</h1>
    
    <input minlength="8" maxlength="100" class="form-control" type="password" name="password" id="password" placeholder="Password" required><br><br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Anmelden">Anmelden</button>
</form>
</main> </body>';
        $html->render(['content' => $content, 'body_class' => 'text-center']);

        return true;
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

