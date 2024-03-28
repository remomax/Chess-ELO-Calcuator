<?php
/** @var string $html_title */
/** @var string $body_class */
/** @var string $content */
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
            background-color: #333;
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
            background-color: #111;
        }
    </style>
</head>
<ul>
    <li><a class="active" href="/">Home</a></li>
    <li><a href="calculator">Calculator</a></li>
    <li><a href="Scoreboard">Scoreboard</a></li>
    <li><a href="register">Register</a></li>
    <li><a href="logout">Logout</a></li>
</ul>
<body class="<?= $body_class ?>">
<?= $content ?>


</body>
</html>