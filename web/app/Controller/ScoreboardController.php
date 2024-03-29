<?php

namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Logedin;
use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\Classes\Game;
use Praktikant\Praktikum\classes\Html;
use Praktikant\Praktikum\classes\Person;
use Praktikant\Praktikum\Repository\PersonRepository;

class ScoreboardController
{
    public function Index(): void
    {


        $logedin2 = new Logedin();
        $logedin2->Logedin();
        $connection = new Connection();
        $games = new Game();
        $personRepo = new PersonRepository();
        $person = new Person();
        $persons = $personRepo->getAll();

        $sql = "SELECT * FROM person";


        $result = $connection->getConnection()->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {

                $person->setGames((int)$row["games"]);
                $person->setUsername((string)$row["username"]);


                $list[] = $person;
            }
        } else {
            echo '0 results';
        }

        $sql = "SELECT * FROM games";
        $result = $connection->getConnection()->query($sql);
        /* @var Games[] $list */
        $list = [];

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $games = new Game();
                $games->setGameID((int)$row["game_id"]);
                $games->setID_white((int)$row["id_white"]);
                $games->setID_black((int)$row["id_black"]);
                $games->setELO_White_After((int)$row["elo_white_after"]);
                $games->setELO_Black_After((int)$row["elo_black_after"]);
                $games->setELO_White_Before((int)$row["elo_white_before"]);
                $games->setELO_Black_Before((int)$row["elo_black_before"]);
                $games->setGameoutcome((string)$row["gameoutcome"]);
                $games->setTime((string)$row["time"]);
                $games->setK((int)$row["K_Wert"]);

                $list[] = $games;
            }
        } else {
            echo '0 results';
        }

        foreach ($list as $key => $value) {
// Select Username and top_elo White
            $ID_white = $value->getID_white();
            $sql = "SELECT username FROM person WHERE id = '$ID_white' LIMIT 1";
            $result = $connection->getConnection()->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $username_white = $row["username"];

            } else {
                $username_white = "ERROR Reload Page";
            }


// Select Username and top_elo Black
            $ID_black = $value->getID_black();
            $sql = "SELECT username FROM person WHERE id = '$ID_black' LIMIT 1";
            $result = $connection->getConnection()->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $username_black = $row["username"];
            } else {
                $username_black = "ERROR Reload Page";
            }

        }

        $lines = [];
        foreach ($list as $key => $value) {
            $gameid_display = '<td style="padding: 10px"> ' . $value->getGameID() . '</td>';
            $username_white_display = '<td style="padding: 10px">' . $username_white . '</td>';
            $username_black_display = '<td style="padding: 15px">' . $username_black . '</td>';
            $gameoutcome_display = '<td style="padding: 10px">' . $value->getGameoutcome() . '</td>';
            $EloWhiteBefore_display = '<td style="padding: 10px">' . $value->getEloWhiteBefore() . '</td>';
            $EloWhiteAfter_display = '<td style="padding: 10px">' . $value->getEloWhiteAfter() . '</td>';
            $EloBlackBefore_display = '<td style="padding: 10px">' . $value->getEloBlackBefore() . '</td>';
            $EloBlackAfter_display = '<td style="padding: 10px">' . $value->getEloBlackAfter() . '</td>';
            $K_display = '<td style="padding: 10px">' . $value->getK() . '</td>';
            $Time_display = '<td style="padding: 10px">' . $value->getTime() . '</td>';

            $lines[] = '<tr>' . $gameid_display .
                $username_white_display .
                $username_black_display .
                $gameoutcome_display .
                $EloWhiteBefore_display .
                $EloWhiteAfter_display .
                $EloBlackBefore_display .
                $EloBlackAfter_display .
                $K_display .
                $Time_display
                . '</tr>';
        }

        $html = new Html();
        $html->setTitle('Results');
        $content = '<br><h1 class="h3 mb-3 font-weight-normal">Ergebnisse:</h1><br>
<main class="">
<table border=´1´>
 <tr><th style="padding: 10px">Game-ID:</th><th style="Fpadding: 15px">Weiß:</th><th style="padding: 15px">Schwarz:</th><th style="padding: 10px">Gewinner:</th><th style="padding: 10px">ELO Weiß bevor</th><th style="padding: 10px">ELO Weiß dannach</th><th style="padding: 10px">ELO Schwarz bevor</th><th style="padding: 10px">ELO Schwarz dannach</th><th style="padding: 10px">K-Wert</th><th style="padding: 10px">Datum-Zeit</th></tr>
'.implode('', $lines).'
</table>
</main>';
        $html->render(['content' => $content, 'body_class' => 'text-center']);

    }

}