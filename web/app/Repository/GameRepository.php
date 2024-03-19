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
        }
        elseif ($post["winner"] == 'black') {
            $SA = 0;
            $SB = 1;
        }
        elseif ($post["winner"] == 'remis') {
            $SA = 0.5;
            $SB = 0.5;
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

        return true;
    }
}