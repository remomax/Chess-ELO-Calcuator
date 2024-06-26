<?php
declare(strict_types=1);
namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Connection;
use Praktikant\Praktikum\classes\Html;
class VerifyController
{
public function Index(): void
{
    $connection = new Connection;


    $html = new Html();
    $html->setTitle('Verify');
    $content = '<br><h1 class="h3 mb-3 font-weight-normal">Ergebnisse:</h1>
    <body class="text-center">
    <main class="form-signin">
    <form class="form-control" method="post" action="/RealVerifyController">

        <p><input placeholder="Username" class="form-control" minlength="3" name="username3" required></p>
        <p><input placeholder="Verification ID" class="form-control" minlength="1" maxlength="20" name="verify_id3" required></p>
        <p><input class="btn btn-lg btn-primary btn-block" type="submit"></p>

    </form>
    </main> </body>';
    $html->render(['content' => $content, 'body_class' => 'text-center']);





}
}
