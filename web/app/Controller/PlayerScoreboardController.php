<?php
declare(strict_types=1);
namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Logedin;
use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\classes\Html;
use Praktikant\Praktikum\classes\Person;
use Praktikant\Praktikum\Repository\PersonRepository;

class PlayerScoreboardController
{
    public function Index(): void
    {
        $logedin2 = new Logedin();
        $logedin2->Logedin();
        $connection = new Connection();
        $personRepo = new PersonRepository();
        $persons = $personRepo->getAll();

        $sql = "SELECT * FROM person";
        $result = $connection->getConnection()->query($sql);

        /* @var Person[] $list */
        $list = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $person = new Person();
                $person->setElo((int)$row["elo"]);
                $person->setEloTop((int)$row["elo_top"]);
                $person->setGames((int)$row["games"]);
                $person->setUsername((string)$row["username"]);
                $person->setTime((string)$row["time"]);
                $person->setAge((int)$row["age"]);

                $list[] = $person;
            }
        }

        $lines = [];
        foreach ($list as $value) {
            $username_display = '<td style="padding: 10px">' . $value->getUsername() . '</td>';
            $elo_display = '<td style="padding: 10px">' . $value->getElo() . '</td>';
            $elo_top_display = '<td style="padding: 10px">' . $value->getEloTop() . '</td>';
            $games_display = '<td style="padding: 10px">' . $value->getGames() . '</td>';
            $time_display = '<td style="padding: 10px">' . $value->getTime() . '</td>';
            $age_display = '<td style="padding: 10px">' . $value->getAge() . '</td>';

            $lines[] = '<tr>' .
                $username_display .
                $elo_display .
                $elo_top_display .
                $games_display .
                $time_display .
                $age_display .
                '</tr>';
        }

        $html = new Html();
        $html->setTitle('Player Scoreboard');
        $content = '<br><h1 class="h3 mb-3 font-weight-normal">Spieler Scoreboard:</h1><br>
<main class="">
<table border="1" class="table-centered">
 <tr><th style="padding: 15px">Username:</th><th style="padding: 15px">ELO:</th><th style="padding: 15px">Höchste ELO:</th><th style="padding: 15px">Spiele:</th><th style="padding: 15px">Account Erstellt:</th><th style="padding: 15px">Alter:</th></tr>
' . implode('', $lines) . '
</table>
</main>';
        $html->render(['content' => $content, 'body_class' => 'text-center']);
    }
}
