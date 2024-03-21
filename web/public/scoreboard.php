<?php
declare(strict_types=1);
echo "<h1><a href='index.php'>Zurück</a></h1>";
use Praktikant\Praktikum\Repository\PersonRepository;

$u = "<br>";
require '../app/classes/Connection.php';
require "../app/classes/Game.php";
require "../app/Repository/PersonRepository.php";
require "../app/classes/Person.php";
$connection = new Connection();
$games = new \Praktikant\Praktikum\Classes\Game();
$personRepo = new PersonRepository();
$persons = $personRepo->getAll();
?>

<h1>Games Scoreboard: </h1>



<?php
$sql = "SELECT * FROM person";



$result = $connection->getConnection()->query($sql);
/* @var Person[] $list */
$list = [];

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $person = new Person();
        $person->setAge((int)$row["age"]);
        $person->setlName((string)$row["lastname"]);
        $person->setfName((string)$row["firstname"]);
        $person->setELO((int)$row["elo"]);
        $person->setplz((string)$row["plz"]);
        $person->sethausnummer((string)$row["hausnummer"]);
        $person->setstreet((string)$row["street"]);
        $person->setemail((string)$row["email"]);
        $person->setGames((int)$row["games"]);
        $person->setUsername((string)$row["username"]);
        $person->setPassword((string)$row["password"]);

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
    while($row = $result->fetch_assoc()) {
        $games = new \Praktikant\Praktikum\Classes\Game();
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
    $sql = "SELECT (username) FROM person WHERE id = $ID_white";
    $result = $connection->getConnection()->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username_white = $row["username"];

    } else {
        $username_white = "ERROR Reload Page";
    }


// Select Username and top_elo Black
    $ID_black = $value->getID_black();
    $sql = "SELECT (username) FROM person WHERE id = $ID_black";
    $result = $connection->getConnection()->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username_black = $row["username"];
    } else {
        $username_black = "ERROR Reload Page";
    }

}









echo "<table border=´1´>";
    echo "<tr><th style='padding: 10px'>Game-ID:</th><th style='padding: 15px'>Weiß:</th><th style='padding: 15px'>Schwarz:</th><th style='padding: 10px'>Winner:</th><th style='padding: 10px'>ELO White before</th><th style='padding: 10px'>ELO White after</th><th style='padding: 10px'>ELO Black before</th><th style='padding: 10px'>ELO Black after</th><th style='padding: 10px'>K-Wert</th><th style='padding: 10px'>Time</th></tr>";

foreach ($list as $key => $value) {

        echo "<tr>"
            ."<td style='padding: 10px'>".$value->getGameID()."</td>"
            ."<td style='padding: 15px'>".$username_white. "</td>"
            ."<td style='padding: 15px'>".$username_black. "</td>"
            ."<td style='padding: 10px'>".$value->getGameoutcome()."</td>"
            ."<td style='padding: 10px'>".$value->getEloWhiteBefore()."</td>"
            ."<td style='padding: 10px'>".$value->getEloWhiteAfter()."</td>"
            ."<td style='padding: 10px'>".$value->getEloBlackBefore()."</td>"
            ."<td style='padding: 10px'>".$value->getEloBlackAfter()."</td>"
            ."<td style='padding: 10px'>".$value->getK()."</td>"
            ."<td style='padding: 10px'>".$value->getEloBlackAfter()."</td>"
            ."</tr>";



    }

echo "</table>";




