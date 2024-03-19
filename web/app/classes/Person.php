<?php
declare(strict_types=1);
 $u = "<br>";
class Person {

    private int $id;
    private int $age;
    private string $lname;
    private string $fname;
    private int $elo;
    private string $plz;
    private string $hausnummer;
    private string $street;
    private string $email;
    private int $games;
    private string $username;
    private string $password;


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
    public function getUsername(): string {
        return $this->username;
    }
    public function getPassword(): string {
        return $this->password;
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
        $this->plz = $plz;

    }
    public function sethausnummer(string $hausnummer): void {
            $this->hausnummer = $hausnummer;
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
    public function setUsername(string $username): void {
        $this->username = $username;
    }
    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}