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
    </style>
</head>
<body class="<?= $body_class ?>">
<?= $content ?>
</body>
</html>