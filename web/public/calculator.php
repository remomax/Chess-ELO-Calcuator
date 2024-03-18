<?php
declare(strict_types=1);
?>

<html><head></head><body>

<h1>Einfaches Eingabeformular</h1>

<form method="post">
    <h1>1 Gewonnen, 0.5 Remis, 0 Lost</h1>
    <p><input name="ra"> ELO A</p>
    <p><input name="rb"> ELO B</p>
    <p><input name="k"> K-Wert</p>
    <p><input name="sa"> Spielstand A</p>
    <p><input name="sb"> Spielstand B</p>
    <p><input type="submit"></p>

</form>

<?php

echo "ra + rb " . $_POST["ra"] . " " . $_POST["rb"];
echo "<br>";
echo "k + k " . $_POST["k"] . " " . $_POST["k"];
echo "<br>";
echo "sa + sb " . $_POST["sa"] . " " . $_POST["sb"];
echo "<br>";


echo "ergebniss: ";
$differenzBA = $_POST["rb"] - $_POST["ra"];
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
$RA = $_POST["ra"];
$RB = $_POST["rb"];
$K = $_POST["k"];
$SA = $_POST["sa"];
$SB = $_POST["sb"];
$ELOA = $RA + $K * ($SA - $EA);
echo "ELO A: ";
echo $ELOA;


echo "<br>";
echo "<br>";
echo "<br>";
echo "Spieler B Berechunng:";
echo "<br>";
echo "ergebniss: ";
echo $_POST["ra"] - $_POST["rb"];
$differenzAB = $_POST["ra"] - $_POST["rb"];
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

