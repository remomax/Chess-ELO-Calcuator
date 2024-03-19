<?php

namespace Praktikant\Praktikum\Repository;

use Connection;

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
        if ($post["winner"] == 'white') {
            $SA = 1;
            $SB = 0;
            $gameoutcome = "White";
        }
        elseif ($post["winner"] == 'black') {
            $SA = 0;
            $SB = 1;
            $gameoutcome = "Black";
        }
        elseif ($post["winner"] == 'remis') {
            $SA = 0.5;
            $SB = 0.5;
            $gameoutcome = "Remie";
        }

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


        $connection = $connection->getConnection();

        $statement = $connection->prepare('INSERT INTO games (id_white, id_black, gameoutcome, elo_white_before, elo_white_after, elo_black_before, elo_black_after)
    VALUES (?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param(
            'ddsdddd',
            $id_white,
            $id_black,
            $gameoutcome,
            $elo_white_before,
            $elo_white_after,
            $elo_black_before,
            $elo_black_after,
        );
        $statement->execute();
        return true;
    }
}