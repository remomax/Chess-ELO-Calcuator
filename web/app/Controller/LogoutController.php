<?php
declare(strict_types=1);
namespace Praktikant\Praktikum\Controller;

class LogoutController
{
    public function index(): void
    {
        session_destroy();
        redirect(url('login', Null, ['Status'=>'Logout'])->getAbsoluteUrl());
    }
}