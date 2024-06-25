<?php
/** @var string $html_title */
/** @var string $body_class */
/** @var string $content */
    if ($_SESSION == [])
    {$a = '<li><a href="/register">Registrieren</a></li> <li><a href="/login">Login</a></li>';}
    elseif ($_SESSION['username'] !== ''){
      $a = '  <li><a class="active" href="/">Home</a></li>
    <li><a href="/calculator">Calculator</a></li>
    <li><a href="/Scoreboard">Games-Scoreboard</a></li>
    <li><a href="/PlayerScoreboard">Player-Scoreboard</a></li>
    <li><a href="/PasswordChange">Password Ändern</a></li>
    <li><a href="/logout">Logout</a></li> ';
    }
?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?= $html_title; ?></title>
    <link rel="stylesheet" href="/bootstrap.css">
    <style>
        .form-signin {
                width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #595959;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #6c6c6c;
        }
    </style>
</head>
<ul>
    <?php echo $a; ?>
</ul>
<body class="<?= $body_class ?>">
<?= $content ?>


</body>
</html>
