<?php

namespace Praktikant\Praktikum\Controller;

class LogoutController
{
    public function index(): void
    {
        session_destroy();
        redirect(url('login'));
    }
}