<?php

declare(strict_types=1);

namespace Praktikant\Praktikum\classes;

use mysqli;

class Connection
{
    public function getConnection(): mysqli
    {
        $servername = ''; //IP Adresse, oder wen localhost einfach 'Mysql' order 'localhost' (string)
        $username = ''; //Benutzername für denn zugang Meistens 'root' (string)
        $password = ''; //Password des benutzers (string)
        $dbname = ''; /datenbank name (string)

        return new mysqli($servername, $username, $password, $dbname);
    }

}
