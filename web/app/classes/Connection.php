<?php
declare(strict_types=1);
class Connection
{
    public function getConnection(): mysqli
    {
        $servername = "mysql";
        $username = "root";
        $password = "root";
        $dbname = "praktikumdb";

        return new mysqli($servername, $username, $password, $dbname);
    }
}