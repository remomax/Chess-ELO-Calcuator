<?php

declare(strict_types=1);

namespace Praktikant\Praktikum\Controller;

class IndexController
{
    public function index(): void {
        if ($_SESSION == []) {
            header('Location: http://localhost:8000/login', true, 301);
            exit();
        } elseif ($_SESSION['loggedin'] === false) {
            header('Location: http://localhost:8000/login', true, 301);
            exit();
        }
        elseif ($_SESSION['username'] == 'NULL') {header('Location: http://localhost:8000/login', true, 301);
            exit();}
        echo '<h1>Welcome</h1>
<h1>Links:</h1>
<h1><a href="/register.php">Register</a></h1>
<h1><a href="/calculator_old.php">Calculator</a></h1>
<h1><a href="/scoreboard.php">Scoreboard</a></h1>';
if ($_SESSION == []) {echo '<h1><a href="/login">Login</a></h1>';}
else {
    if ($_SESSION['loggedin'] !== true) {
        echo '<h1><a href="/login">Login</a></h1>';
}
    else {
        echo '<h1><a href="/logout">Logout</a></h1';

    }
}
        echo '<br><h3><a href="/Help.php">You need Help? Press here</a></h3>';
    }
}
