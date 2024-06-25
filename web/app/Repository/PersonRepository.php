<?php
declare(strict_types=1);
namespace Praktikant\Praktikum\Repository;

use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\classes\Person;

class PersonRepository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM person";

        $connection = new Connection();

        $result = $connection->getConnection()->query($sql);
        /* @var Person[] $list */
        $list = [];

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $list[] = $this->hydrate($row);
            }
        } else {

        }

        return $list;
    }

    public function getOne(int $id): Person
    {
        $connection = (new Connection())->getConnection();

        $data = $connection->query("SELECT * FROM person WHERE id=$id LIMIT 1")->fetch_assoc();

        return $this->hydrate($data);
    }

    public function hydrate(array $data): Person
    {
        $person = new Person();
        $person->setId((int)$data["id"]);
        $person->setlName((string)$data["lastname"]);
        $person->setfName((string)$data["firstname"]);
        $person->setELO((int)$data["elo"]);
        $person->setMail((string)$data["email"]);
        $person->setGames((int)$data["games"]);
        $person->setUsername((string)$data["username"]);
        $person->setPassword((string)$data["password"]);

        return $person;
    }
}