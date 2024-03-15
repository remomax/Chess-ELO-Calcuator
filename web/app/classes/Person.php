<?php
declare(strict_types=1);
 $u = "<br>";
class Person {

    private int $age;
    private string $lname;
    private string $fname;
    private int $elo;
    private string $plz;
    private string $hausnummer;
    private string $street;
    private string $email;
    private int $games;


    public function getplz(): ?string {
        return $this->plz;
    }
    public function getAge(): int {
        return $this->age;
    }
    public function getLName(): string {
        return $this->lname;
    }
    public function getFName(): string {
        return $this->fname;
    }
    public function getELO(): int {
        return $this->elo;
    }

    public function gethausnummer(): ?string {
        return $this->hausnummer;
    }
    public function getstreet(): ?string {
        return $this->street;
    }
    public function getMail(): ?string {
        return $this->email;
    }
    public function getGames(): int {
        return $this->games;
    }

    public function setAge(int $age): void {
        if ($age <= 17) {
            echo " <br>Du musst mindestens 18 Jahre alt sein um dich zu Regestriren <br>";
        }
        elseif ($age >= 18) {
            $this->age = $age;
        }
    }
    public function setlName(string $lname): void {
            $this->lname = $lname;
    }
    public function setFName(string $fname): void {
            $this->fname = $fname;
    }
    public function setELO(int $elo):void {
        $this->elo = $elo;
    }
    public function setplz(string $plz):void {
        if ($plz < 1001) {
            echo "<br>"."Diese PLZ Exestirt nicht in Deutschland"."<br>";
        }
        elseif ($plz >= 1001) {
            $this->plz = $plz;
        }
    }
    public function sethausnummer(string $hausnummer): void {
        if ($hausnummer < 1) {
            echo "<br>"."Diese Hausnummer gibt es nicht"."<br>";
        }
        elseif ($hausnummer >= 1) {
            $this->hausnummer = $hausnummer;
        }
    }
    public function setstreet(string $street): void {
            $this->street = $street;

    }
    public function setemail(string $email): void {
        $this->email = $email;
    }
    public function setGames(int $games): void {
        $this->games = $games;
    }

}