<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', [\Praktikant\Praktikum\Controller\IndexController::class, 'index'], ['as' => 'main']);
SimpleRouter::get('/login', [\Praktikant\Praktikum\Controller\LoginController::class, 'index'], ['as' => 'login.get']);
SimpleRouter::post('/login', [\Praktikant\Praktikum\Controller\LoginController::class, 'login'], ['as' => 'login.post']);
SimpleRouter::get('/logout', [\Praktikant\Praktikum\Controller\LogoutController::class, 'index'], ['as' => 'logout.get']);
//SimpleRouter::get('/send_email', [\Praktikant\Praktikum\Controller\LoginController::class, 'index'], ['as' => 'send_mail.get']);
//SimpleRouter::post('/send_email', [\Praktikant\Praktikum\Controller\LoginController::class, 'index'], ['as' => 'send_mail.post']);
