<?php
declare(strict_types=1);
?>

<form method="post">

    <p><input name="age"> Alter:</p>
    <p><input name="lname"> Name:</p>
    <p><input name="fname"> Vorname:</p>
    <p><input name="elo"> ELO:</p>
    <p><input name="plz"> PLZ:</p>
    <p><input name="hausnummer"> Hausnummer:</p>
    <p><input name="street"> Straße:</p>
    <p><input name="email"> E-Mail:</p>
    <p><input type="submit"></p>

</form>

<?php
$u = "<br>";
require "../app/classes/Person.php";
