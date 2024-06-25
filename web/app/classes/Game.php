<?php
declare(strict_types=1);
namespace Praktikant\Praktikum\Classes;

class Game
{
    private int $game_id;
    private int $id_white;
    private int $id_black;
    protected string $gameoutcome;
    private int $elo_white_before = 0;
    private int $elo_white_after = 0;
    private int $elo_black_before = 0;
    private int $elo_black_after = 0;
    private string $time;
    private int $k = 40;

    public  function getGameID(): int
    {
        return $this->game_id;
    }
    public function getID_white(): int
    {
        return $this->id_white;
    }

    public function getID_black(): int
    {
        return $this->id_black;
    }

    public function getGameoutcome(): string
    {
        return $this->gameoutcome;
    }

    public function getEloWhiteBefore(): int
    {
        return $this->elo_white_before;
    }

    public function getEloWhiteAfter(): int
    {
        return $this->elo_white_after;
    }

    public function getEloBlackBefore(): int
    {
        return $this->elo_black_before;
    }

    public function getEloBlackAfter(): int
    {
        return $this->elo_black_after;
    }
    public function getTime(): string
    {
        return $this->time;
    }
    public function getK(): int
    {
        return $this->k;
    }




    public function setGameID(int $game_id): void
    {
        $this->game_id = $game_id;
    }
    public function setID_white(int $id_white): void
    {
        $this->id_white = $id_white;
    }

    public function setID_black(int $id_black): void
    {
        $this->id_black = $id_black;
    }

    public function setELO_White_Before(int $elo_white_before): void
    {
        $this->elo_white_before = $elo_white_before;
    }

    public function setELO_White_After(int $elo_white_after): void
    {
        $this->elo_white_after = $elo_white_after;
    }

    public function setELO_Black_Before(int $ELO_Black_Before): void
    {
        $this->elo_black_before = $ELO_Black_Before;
    }

    public function setELO_Black_After(int $ELO_Black_After): void
    {
        $this->elo_black_after = $ELO_Black_After;
    }
    public function setGameoutcome(string $gameoutcome): void
    {
        $this->gameoutcome = $gameoutcome;
    }
    public function setTime(string $time): void
    {
        $this->time = $time;
    }
    public function setK(int $k): void
    {
        $this->k = $k;
    }

}
