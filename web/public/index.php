<?php
declare(strict_types=1);
$u = "<br>";
global $u;
require "../app/classes/Person.php";
require '../app/classes/Connection.php';
?>
    <form method="post" action="add_person.php">

        <p><input minlength="3" maxlength="20" name="username"> Username:</p>
        <p><input type="password" id="password" minlength="8" maxlength="100" name="password"> Password (8 characters minimum):</p>
        <p><input minlength="2" maxlength="2" name="age"> Alter:</p>
        <p><input minlength="2" maxlength="20" name="lname"> Name:</p>
        <p><input minlength="2" maxlength="20" name="fname"> Vorname:</p>
        <p><input minlength="1" maxlength="4" name="elo"> ELO:</p>
        <p><input minlength="5" maxlength="20" name="plz"> PLZ:</p>
        <p><input minlength="1" maxlength="5" name="hausnummer"> Hausnummer:</p>
        <p><input minlength="1" maxlength="25" name="street"> Straße:</p>
        <p><input minlength="5" name="email"> E-Mail:</p>
        <p><input minlength="1" name="games"> Wie Viele Gewertete Schach Spiele:</p>
        <p><input type="submit"></p>

    </form>


<?php
$sql = "SELECT * FROM person";

$connection = new Connection();

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

echo "<table border=´1´>";
    echo "<tr><th>Nummer</th><th>Alter</th><th>Name</th><th>Vorname</th><th>ELO</th><th>PLZ</th><th>Hausnummer</th><th>Straße</th><th>E-Mail</th><th>Games</th><th>Username</th><th>Password</th></tr>";

    foreach ($list as $key => $value) {
        echo "<tr>"
            ."<td>".$key.":"."</td>"
            ."<td>".$value->getAge(). "</td>"
            ."<td>".$value->getLName(). "</td>"
            ."<td>".$value->getFName()."</td>"
            ."<td>".$value->getELO()."</td>"
            ."<td>".$value->getplz()."</td>"
            ."<td>".$value->gethausnummer()."</td>"
            ."<td>".$value->getstreet()."</td>"
            ."<td>".$value->getMail()."</td>"
            ."<td>".$value->getGames()."</td>"
            ."<td>".$value->getUsername()."</td>"
            ."<td>".$value->getPassword()."</td>"
            ."</tr>";
    }

echo "</table>";









//echo "Alter: " . $person->getAge() . $u;
//echo "Name: " . $person->getLName() . ", " . $person->getFName() . $u;
//echo "ELO: " . $person->getELO() . $u;
//echo "PLZ: " . $person->getplz() . $u;
//echo "Hausnummer: " . $person->gethausnummer() . $u;
//echo "Straße: " . $person->getstreet() . $u;
//echo "Mail: " . $person->getMail() . $u; a


