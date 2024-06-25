<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', [\Praktikant\Praktikum\Controller\IndexController::class, 'index'], ['as' => 'main']);
SimpleRouter::get('/login', [\Praktikant\Praktikum\Controller\LoginController::class, 'index'], ['as' => 'login.get']);
SimpleRouter::post('/login', [\Praktikant\Praktikum\Controller\LoginController::class, 'login'], ['as' => 'login.post']);
SimpleRouter::get('/logout', [\Praktikant\Praktikum\Controller\LogoutController::class, 'index'], ['as' => 'logout.get']);
SimpleRouter::get('/calculator', [\Praktikant\Praktikum\Controller\CalculatorController::class, 'index'], ['as' => 'calculator.get']);
SimpleRouter::post('/calculator', [\Praktikant\Praktikum\Controller\CalculatorController::class, 'calculator'], ['as' => 'calculator.post']);
SimpleRouter::get('/AddGameController', [\Praktikant\Praktikum\Controller\AddGameController::class, 'index'], ['as' => 'AddGameController.get']);
SimpleRouter::post('/AddGameController', [\Praktikant\Praktikum\Controller\AddGameController::class, 'index'], ['as' => 'AddGameController.post']);
SimpleRouter::get('/calculator/calculator', [\Praktikant\Praktikum\Controller\CalculatorController::class, 'index'], ['as' => 'calculator.get']);
SimpleRouter::get('/register', [\Praktikant\Praktikum\Controller\RegisterController::class, 'index'], ['as' => 'RegisterController.get']);
SimpleRouter::get('/AddPersonController', [\Praktikant\Praktikum\Controller\AddPersonController::class, 'index'], ['as' => 'AddPersonController.get']);
SimpleRouter::get('/register/AddPersonController', [\Praktikant\Praktikum\Controller\AddPersonController::class, 'index'], ['as' => 'AddPersonController.get']);
SimpleRouter::post('/AddPersonController', [\Praktikant\Praktikum\Controller\AddPersonController::class, 'index'], ['as' => 'AddPersonController.post']);
SimpleRouter::post('/register/AddPersonController', [\Praktikant\Praktikum\Controller\AddPersonController::class, 'index'], ['as' => 'AddPersonController.post']);
SimpleRouter::get('/Scoreboard', [\Praktikant\Praktikum\Controller\ScoreboardController::class, 'index'], ['as' => 'Scoreboard.get']);
SimpleRouter::get('/PlayerScoreboard', [\Praktikant\Praktikum\Controller\PlayerScoreboardController::class, 'index'], ['as' => 'PlayerScoreboardController.get']);
SimpleRouter::get('/verify', [\Praktikant\Praktikum\Controller\VerifyController::class, 'index'], ['as' => 'verify.get']);
SimpleRouter::get('/phpmyadmin', [\Praktikant\Praktikum\phpmyadmin\index::class, 'index'], ['as' => 'index.get']);
SimpleRouter::post('/verify', [\Praktikant\Praktikum\Controller\VerifyController::class, 'index'], ['as' => 'verify.post']);
SimpleRouter::get('/PasswordChange', [\Praktikant\Praktikum\Controller\ChangePasswordController::class, 'index'], ['as' => 'ChangePW.get']);
SimpleRouter::get('/PasswordChangeController', [\Praktikant\Praktikum\Controller\PasswordChangeController::class, 'index'], ['as' => 'ChangePW2.get']);
SimpleRouter::get('/PasswordChange/PasswordChangeController', [\Praktikant\Praktikum\Controller\PasswordChangeController::class, 'index'], ['as' => 'ChangePW2.get']);
SimpleRouter::get('/RealVerifyController', [\Praktikant\Praktikum\Controller\RealVerifyController::class, 'index'], ['as' => 'RealVerifyController.get']);
SimpleRouter::post('/PasswordChange', [\Praktikant\Praktikum\Controller\ChangePasswordController::class, 'index'], ['as' => 'ChangePW.post']);
SimpleRouter::post('/PasswordChangeController', [\Praktikant\Praktikum\Controller\PasswordChangeController::class, 'index'], ['as' => 'ChangePW2.post']);
SimpleRouter::post('/PasswordChange/PasswordChangeController', [\Praktikant\Praktikum\Controller\PasswordChangeController::class, 'index'], ['as' => 'ChangePW2.post']);
SimpleRouter::post('/RealVerifyController', [\Praktikant\Praktikum\Controller\RealVerifyController::class, 'index'], ['as' => 'RealVerifyController.post']);



