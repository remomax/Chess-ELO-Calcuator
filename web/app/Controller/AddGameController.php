<?php
declare(strict_types=1);
namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\classes\Html;
use Praktikant\Praktikum\Repository\PersonRepository;


class AddGameController
{
    
    public function index(): void
    {

        $connection = new Connection();
        $personRepository = new PersonRepository();
        
        
        
        
function calculateKValue_Black($elo_black_before, $games_black, $age_black, $rating_type) {
    if ($age_black < 18 && $elo_black_before < 2300) {
        return 40;
    }
    
    if ($elo_black_before < 2400) {
        return 20;
    }
    
    if ($rating_type === "RAPID" || $rating_type === "BLITZ") {
        return 20;
    }
    
    if ($games_black < 30) {
        return 40;
    }
    
    return 10;
}
function calculateKValue_White($elo_white_before, $games_white, $age_white, $rating_type) {
    if ($age_white < 18 && $elo_white_before < 2300) {
        return 40;
    }
    
    if ($elo_white_before < 2400) {
        return 20;
    }
    
    if ($rating_type === "RAPID" || $rating_type === "BLITZ") {
        return 20;
    }
    
    if ($games_white < 30) {
        return 40;
    }
    
    return 10;
}



        
        $rating_type = $_POST["Gamemodie"];
        $whitePlayer = $personRepository->getOne($_POST['player_white']);
        $blackPlayer = $personRepository->getOne($_POST['player_black']);
        
        //----------------------------------
        $id_white = $_POST["player_white"];
        $id_black = $_POST["player_black"];
        if ($id_black == $id_white) {
            redirect(url('calculator', Null, ['Status'=>'GleicherSpieler'])->getAbsoluteUrl());
        }
        $sql = "SELECT elo_top, games, username, age FROM person WHERE id = '$id_black' LIMIT 1";
        $result = $connection->getConnection()->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $elo_top_black = $row["elo_top"];
                $games_black = $row["games"];
                $username_black = $row["username"];
                $age_black = $row["age"];
            }
        } else {

        }
        $sql = "SELECT elo_top, games, username, age FROM person WHERE id = '$id_white' LIMIT 1";
        $result = $connection->getConnection()->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $elo_top_white = $row["elo_top"];
                $games_white = $row["games"];
                $username_white = $row["username"];
                $age_white = $row["age"];
                
            }
        } else {

        }
        $username = $_SESSION['username'];
        if ($username !== $username_white) {
            if ($username !== $username_black) {
                redirect(url('calculator', Null, ['Status'=>'EigenerSpieler'])->getAbsoluteUrl());
            }
        }
        elseif ($username !== $username_black) {
            if ($username !== $username_white) {
                redirect(url('calculator', Null, ['Status'=>'EigenerSpieler'])->getAbsoluteUrl());
            }
        }

        
        // Set Variables

        $RA = $whitePlayer->getELO(); //Old ELO of White Player
        $RB = $blackPlayer->getELO(); //Old ELO of Black Player
        $elo_white_before = $RA;
        $elo_black_before = $RB;
        
        [$SA, $SB] = $this->getScore($_POST['winner']);
        $gameoutcome = ucfirst($_POST['winner']);

        // PLayer White
        $K_White = calculateKValue_White($elo_white_before, $games_white, $age_white, $rating_type);
        
        $differenzBA = $RB - $RA;
        $differenzBA400 = $differenzBA / 400;
        $hoch10BA = pow(10, $differenzBA400);
        $nennerBA = $hoch10BA + 1;
        $EA = 1 / $nennerBA;
        $ELOA_round = $RA + $K_White * ($SA - $EA);
        $ELOA = floor($ELOA_round); // $ELOA = New ELO of Player White


        // Player Black
        
        $K_Black = calculateKValue_Black($elo_black_before, $games_black, $age_black, $rating_type);
        
        $differenzAB = $RA - $RB;
        $differenzAB400 = $differenzAB / 400;
        $hoch10AB = pow(10, $differenzAB400);
        $nennerAB = $hoch10AB + 1;
        $EB = 1 / $nennerAB;
        $ELOB_round = $RB + $K_Black * ($SB - $EB);
        $ELOB = floor($ELOB_round); // $ELOB = New ELO of Player Black


        if ($ELOA < 0) {
            $ELOA = 0;
        }
        if ($ELOB < 0) {
            $ELOB = 0;
        }



        // Stroing Variable
        $elo_white_after = $ELOA;
        $elo_black_after = $ELOB;
        
        
        
        $connection = $connection->getConnection();

        $statement = $connection->prepare('INSERT INTO games (id_white, id_black, gameoutcome, elo_white_before, elo_white_after, elo_black_before, elo_black_after)
    VALUES (?, ?, ?, ?, ?, ?, ?)');
        $statement->bind_param(
            'ddsdddd',
            $id_white,
            $id_black,
            $gameoutcome,
            $elo_white_before,
            $elo_white_after,
            $elo_black_before,
            $elo_black_after,
        );
        $statement->execute();
        $games_black = $games_black + 1;

        if ($elo_black_after > $elo_top_black) {
            
        $statement = $connection->prepare('UPDATE person SET elo = ?, elo_top = ?, games = ? WHERE id = ?');
        $statement->bind_param(
            'dddd',
            $elo_black_after,
            $elo_black_after,
            $games_black,
            $id_black,
        );
        $statement->execute();

        } else { 
        
        
        $statement = $connection->prepare('UPDATE person SET elo = ?, games = ? WHERE id = ?');
        $statement->bind_param(
            'ddd',
            $elo_black_after,
            $games_black,
            $id_black,
        );
        $statement->execute();

        }
        
        
        $games_white = $games_white + 1;
        if ($elo_white_after > $elo_top_white) {
            
        
            $statement = $connection->prepare('UPDATE person SET elo = ?, elo_top = ?, games = ? WHERE id = ?');
        $statement->bind_param(
            'dddd',
            $elo_white_after,
            $elo_white_after,
            $games_white,
            $id_white,
        );
        $statement->execute();
        
          
        } else {
           $statement = $connection->prepare('UPDATE person SET elo = ?, games = ? WHERE id = ?');
        $statement->bind_param(
            'ddd',
            $elo_white_after,
            $games_white,
            $id_white,
        );
        $statement->execute();

            
            }
        
        
        $html = new Html();
        $html->setTitle('Results');
        $content = '<br><h1 class="h3 mb-3 font-weight-normal">Ergebnisse:</h1>
<body class="text-center"
<main class="form-signin">
<form class="form-signin" method="post">

    <h1 class="form-control">Neue ELO Weiß: ' . $elo_white_after .'   </h1>
    <h1 class="form-control">Neue ELO Schwarz: ' . $elo_black_after .' </h1>  
    <button class="btn btn-lg btn-primary btn-block" type="button" onclick="history.back();">Back</button>
</form>
</main> </body>';
        $html->render(['content' => $content, 'body_class' => 'text-center']);

    }


    private function getScore(string $winner): array
    {
        return match ($winner) {
            'white' => [1, 0],
            'black' => [0, 1],
            'remis' => [0.5, 0.5],
        };
    }


}

