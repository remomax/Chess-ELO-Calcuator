<?php

declare(strict_types=1);

namespace Praktikant\Praktikum\classes;

use mysqli;

class Connection
{
    public function getConnection(): mysqli
    {
        $servername = "localhost";
        $username = "remomax";
        $password = "root";
        $dbname = "praktikumdb";

        return new mysqli($servername, $username, $password, $dbname);
    }

}
