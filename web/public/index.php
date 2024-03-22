<?php
session_start();
if ($_SESSION = []) {
    header('Location: http://localhost:8000/login', true, 301);
    exit();
} elseif ($_SESSION["loggedin"] = false) {
    header('Location: http://localhost:8000/login', true, 301);
    exit();
}
elseif ($_SESSION["username"] = 'NULL') {header('Location: http://localhost:8000/login', true, 301);
    exit();}
?>
<h1>Welcome</h1>
<h1>Links:</h1>
<h1><a href="/register.php">Register</a></h1>
<h1><a href="/calculator.php">Calculator</a></h1>
<h1><a href="/scoreboard.php">Scoreboard</a></h1>


<?php
if ($_SESSION['loggedin'] = true)
echo '<h1><a href="/login">Login</a></h1>';
 else {
     echo '<h1><a href="/logout">Logout</a></h1';
 }

?>
<h3><a href="/Help.php">You need Help? Press here</a></h3>