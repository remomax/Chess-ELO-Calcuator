<?php
declare(strict_types=1);
namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Html;

class RegisterController
{
    public function Index(): void
    {
        $Status = $_GET["Status"] ?? '';
        if ($Status == 'user')
        {
            $error = '<h2 class="h3 mb-3 font-weight-normal" style="color: red">Username schon vergeben</h2>';
        } elseif ($Status == 'emailuse'){
            $error = '<h2 class="h3 mb-3 font-weight-normal" style="color: red">Email schon Vergebenn</h2>';
        } elseif ($Status == 'emailat') {
            $error = '<h2 class="h3 mb-3 font-weight-normal" style="color: red">Email muss ein @ haben</h2>';
        } elseif ($Status == 'emaildomain') {
            $error = '<h2 class="h3 mb-3 font-weight-normal" style="color: red">Email exestirt nicht</h2>';
        } elseif ($Status == 'alter') {
            $error = '<h2 class="h3 mb-3 font-weight-normal" style="color: red">Du musst mindestens 13 sein!</h2>';
        } else {
            $error = '';
        }
        $html = new Html();
        $html->setTitle('Registrierung');
        $content = '<br><h1 class="h3 mb-3 font-weight-normal">Registrierung:</h1>
<body class="text-center"
<main class="form-signin">
<form class="form-signin" method="post" action="AddPersonController"> '. $error . '

        <p><input placeholder="Username" class="form-control" minlength="3" maxlength="20" name="username" required></p>
        <p><input placeholder="Password" class="form-control" type="password" id="password" minlength="8" maxlength="100" name="password" required></p>
        <p><input placeholder="Name" class="form-control" minlength="2" maxlength="20" name="lname" required></p>
        <p><input placeholder="Vorname" class="form-control" minlength="2" maxlength="20" name="fname" required></p>
        <p><input placeholder="E-Mail" class="form-control" minlength="5" name="email" required></p>
        <p><input placeholder="Alter" class="form-control" minlength="1" maxlength="2" name="age" required></p>
        <p><input class="btn btn-lg btn-primary btn-block" type="submit"></p>

</form>
</main> </body>';
        $html->render(['content' => $content, 'body_class' => 'text-center']);

    }
    
}




