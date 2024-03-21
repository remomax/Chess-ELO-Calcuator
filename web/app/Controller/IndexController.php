<?php

declare(strict_types=1);

namespace Praktikant\Praktikum\Controller;

class IndexController
{
    public function index(): void {
        echo '<h1>Welcome</h1>
<h1>Links:</h1>
<h1><a href="/register.php">Register</a></h1>
<h1><a href="/calculator.php">Calculator</a></h1>
<h1><a href="/scoreboard.php">Scoreboard</a></h1>
<h1><a href="/login">Login</a></h1>
<h1><a href="/logout">Logout</a></h1>
<h3><a href="/Help.php">You need Help? Press here</a></h3>';
    }
}
