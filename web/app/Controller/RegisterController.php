<?php

namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Html;

class RegisterController
{
    public function Index(): void
    {
        $html = new Html();
        $html->setTitle('Results');
        $content = '<br><h1 class="h3 mb-3 font-weight-normal">Ergebnisse:</h1>
<body class="text-center"
<main class="form-signin">
<form class="form-signin" method="post" action="AddGameController.php">

        <p><input class="form-control" minlength="3" maxlength="20" name="username" placeholder="Username" required></p>
        <p><input placeholder="Password" class="form-control" type="password" id="password" minlength="8" maxlength="100" name="password" required></p>
        <p><input placeholder="Alter" class="form-control" minlength="2" maxlength="2" name="age" required></p>
        <p><input placeholder="Name" class="form-control" minlength="2" maxlength="20" name="lname" required></p>
        <p><input placeholder="Vorname" class="form-control" minlength="2" maxlength="20" name="fname" required></p>
        <p><input class="form-control" minlength="5" name="email" required> E-Mail:</p>
        <p><input class="btn btn-lg btn-primary btn-block" type="submit"></p>

</form>
</main> </body>';
        $html->render(['content' => $content, 'body_class' => 'text-center']);

    }
    
}




