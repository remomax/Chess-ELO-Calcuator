<?php
declare(strict_types=1);
$u = "<br>";
require '../app/classes/Connection.php';
require "../app/classes/game.php";


$connection = new Connection();
global $ELOB;
global $ELOA;
?>

<html><head></head><body>

<h1>Calculator</h1>

<form method="post">
    <h6></h6>
    <label for="id_b">Wähle dein Gegner</label>

    <select name="id_b" id="pet-select">
        <option value="">--Gegner--</option>
        <option value="dog">Dog</option>
        <option value="cat">Cat</option>
        <option value="hamster">Hamster</option>
        <option value="parrot">Parrot</option>
        <option value="spider">Spider</option>
        <option value="goldfish">Goldfish</option>
    </select>

    <p><input minlength="2" maxlength="2" name="k"> K-Wert</p>
      <input type="radio" Id="w" name="winner" value="1">
      <label for="html">Weiß Gewonnen</label><br>
      <input type="radio" id="b" name="winner" value="0">
      <label for="html">Schwarz Gewonnen</label><br>
      <input type="radio" id="none" name="winner" value="0.5">
      <label for="html">Remie</label><br>

    <h3> Als was Hasst Du Gespielt?</h3>
      <input type="radio" id="white" name="player" value="1">
      <label for="html">Weiß</label><br>
      <input type="radio" id="black" name="player" value="0">
      <label for="html">Schwarz</label><br>

    <p><input type="submit"></p>





</form>

<?php

$sql = "SELECT (id, age, elo, games) FROM person";




echo "Winner: ";
var_dump($_POST["winner"]);
echo $u;
$winner = $_POST["winner"];


if ($winner == 1) {
    $SA = 1;
    $SB = 0;
}
if ($winner == 0) {
    $SA = 0;
    $SB = 1;
}

if  ($winner == 0.5) {
    $SA = '0.5';
    $SB = '0.5';
}


echo $u;
echo "sa: ";
var_dump($SA);
echo "<br>";
echo "sb: ";
var_dump($SB);
echo $u;



//$RA = $_POST["ra"];
//$RB = $_POST["rb"];
//$K  = $_POST["k"];

$RA = 603;
$RB = 661;
$K = 40;
echo $u;
echo "ra + rb " . $RA . " " . $RB;
echo "<br>";
echo "k + k " . $K . " " . $K;
echo "<br>";
echo "sa + sb " . $SA . " " . $SB;
echo "<br>";


echo "ergebniss: ";
$differenzBA = $RB - $RA;
echo $differenzBA;
echo "<br>";
$differenzBA400 = $differenzBA / 400;
echo "Diffenrenz BA / 400: ";
echo $differenzBA400;
echo "<br>";
$hoch10BA = pow(10, $differenzBA400);
echo $hoch10BA;
echo "<br>";
$nennerBA = $hoch10BA + 1;
$EA = 1 / $nennerBA;
echo "EA: ";
echo $EA;
echo "<br>";
echo "Berechnung Teil 2: ";
echo "<br>";
$ELOA = $RA + $K * ($SA - $EA);
echo "ELO A: ";
echo $ELOA;


echo "<br>";
echo "<br>";
echo "<br>";
echo "Spieler B Berechunng:";
echo "<br>";
echo "ergebniss: ";
echo $RA - $RB;
$differenzAB = $RA - $RB;
echo "<br>";
echo $differenzAB;
echo "<br>";
$differenzAB400 = $differenzAB / 400;
echo "Diffenrenz AB / 400: ";
echo $differenzAB400;
echo "<br>";
$hoch10AB = pow(10, $differenzAB400);
echo $hoch10AB;
echo "<br>";
$nennerAB = $hoch10AB + 1;
$EB = 1 / $nennerAB;
echo "EB: ";
echo $EB;
echo "<br>";
echo "Berechnung Teil 2: ";
echo "<br>";
$ELOB = $RB + $K * ($SB - $EB);
echo "ELO B: ";
echo $ELOB;




?>
</body></html>

