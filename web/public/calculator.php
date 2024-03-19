<?php
declare(strict_types=1);

use Praktikant\Praktikum\Repository\PersonRepository;

$u = "<br>";
require '../app/classes/Connection.php';
require "../app/classes/Game.php";
require "../app/Repository/PersonRepository.php";
require "../app/classes/Person.php";

$connection = new Connection();
$connection = $connection->getConnection();
global $ELOB;
global $ELOA;

$personRepo = new PersonRepository();
$persons = $personRepo->getAll();
?>

<html>
<head></head>
<body>

<h1>Calculator</h1>

<form method="post" action="add_game.php">

    <h6></h6>

    <label for="id_a">Player White</label>

    <select name="player_white">
        <?php foreach ($persons as $person): ?>
            <option value="<?= $person->getId() ?>">--<?= $person->getUsername() ?>--</option>
        <?php endforeach ?>
    </select>
    <br>
    <label for="id_b">Player Black</label>
    <select name="player_black">
        <?php foreach ($persons as $person): ?>
            <option value="<?= $person->getId() ?>">--<?= $person->getUsername() ?>--</option>
        <?php endforeach ?>
    </select>
    <br>

    <label for="winner">Who won the game?</label>
    <select name="winner">
        <option value="white">White</option>
        <option value="black">Black</option>
        <option value="remis">Remis</option>
    </select>

    <p><input type="submit"></p>
</form>

<?php
//
//echo "Winner: ";
//var_dump($_POST["winner"]);
//echo $u;
//$winner = $_POST["winner"];
//
//
//if ($winner == 1) {
//    $SA = 1;
//    $SB = 0;
//}
//if ($winner == 0) {
//    $SA = 0;
//    $SB = 1;
//}
//
//if ($winner == 0.5) {
//    $SA = '0.5';
//    $SB = '0.5';
//}
//
//
//echo $u;
//echo "sa: ";
//var_dump($SA);
//echo "<br>";
//echo "sb: ";
//var_dump($SB);
//echo $u;
//
//
////$RA = $_POST["ra"];
////$RB = $_POST["rb"];
////$K  = $_POST["k"];
//
//$RA = 603;
//$RB = 661;
//$K = 40;
//echo $u;
//echo "ra + rb " . $RA . " " . $RB;
//echo "<br>";
//echo "k + k " . $K . " " . $K;
//echo "<br>";
//echo "sa + sb " . $SA . " " . $SB;
//echo "<br>";
//
//
//echo "ergebniss: ";
//$differenzBA = $RB - $RA;
//echo $differenzBA;
//echo "<br>";
//$differenzBA400 = $differenzBA / 400;
//echo "Diffenrenz BA / 400: ";
//echo $differenzBA400;
//echo "<br>";
//$hoch10BA = pow(10, $differenzBA400);
//echo $hoch10BA;
//echo "<br>";
//$nennerBA = $hoch10BA + 1;
//$EA = 1 / $nennerBA;
//echo "EA: ";
//echo $EA;
//echo "<br>";
//echo "Berechnung Teil 2: ";
//echo "<br>";
//$ELOA = $RA + $K * ($SA - $EA);
//echo "ELO A: ";
//echo $ELOA;
//
//
//echo "<br>";
//echo "<br>";
//echo "<br>";
//echo "Spieler B Berechunng:";
//echo "<br>";
//echo "ergebniss: ";
//echo $RA - $RB;
//$differenzAB = $RA - $RB;
//echo "<br>";
//echo $differenzAB;
//echo "<br>";
//$differenzAB400 = $differenzAB / 400;
//echo "Diffenrenz AB / 400: ";
//echo $differenzAB400;
//echo "<br>";
//$hoch10AB = pow(10, $differenzAB400);
//echo $hoch10AB;
//echo "<br>";
//$nennerAB = $hoch10AB + 1;
//$EB = 1 / $nennerAB;
//echo "EB: ";
//echo $EB;
//echo "<br>";
//echo "Berechnung Teil 2: ";
//echo "<br>";
//$ELOB = $RB + $K * ($SB - $EB);
//echo "ELO B: ";
//echo $ELOB;


?>
</body>
</html>

