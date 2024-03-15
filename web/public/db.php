<?php
declare(strict_types=1);
$servername = "172.21.0.4";
$username = "root";
$password = "root";
$dbname = "praktikumdb";
$connection = new mysqli($servername, $username, $password, $dbname);

 //Check connection
 if ($connection->connect_error) {
     die('connectionection failed: ' . $connection->connect_error);
 }

// $sql = sprintf("INSERT INTO person (age, lastname, firstname, elo, plz, hausnummer, street, email, games)
//VALUES (%d, '%s', '%s', %d, '%s', '%s', '%s', '%s', '%d')",
//     $_POST["age"],
//     $_POST["lname"],
//     $_POST["fname"], $_POST["elo"],
//     $_POST["plz"],
//     $_POST["hausnummer"],
//     $_POST["street"],
//     $_POST["email"],
//     $_POST["email"]);

//$connection->query($sql);

//if ($connection->query($sql) === TRUE) {
//    echo "New record created successfully";
//} else {
//    echo "Error: " . $sql . "<br>" . $connection->connect_error;
//}
//
// $sql = 'SELECT * FROM `person`';
// $result = $connection->query($sql);

// if ($result->num_rows > 0) {
//      //output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
//     }
// } else {
//     echo '0 results';
// }


//$connection->close();