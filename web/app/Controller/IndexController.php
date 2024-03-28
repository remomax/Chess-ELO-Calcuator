<?php

declare(strict_types=1);

namespace Praktikant\Praktikum\Controller;

use Praktikant\Praktikum\classes\Html;
use Praktikant\Praktikum\classes\Logedin;
class IndexController
{
    public function index(): void
    {
        $logedin = new Logedin();
        $logedin->Logedin();

        $html = new Html();
        $html->setTitle('Loggen Sie sich ein');
        $content = '<h2>Hallo, ' . $_SESSION["username"] . '</h2>
<main class="form-signin">
</main>';
        $html->render(['content' => $content, 'body_class' => 'text-center']);
    }
}