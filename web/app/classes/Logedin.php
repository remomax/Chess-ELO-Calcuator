<?php

namespace Praktikant\Praktikum\classes;

class Logedin
{
 public function Logedin(): void
 {
     if ($_SESSION == []) {
         header('Location: http://localhost:8000/login', true, 301);
         exit();
     } elseif ($_SESSION['loggedin'] === false) {
         header('Location: http://localhost:8000/login', true, 301);
         exit();
     }
     elseif ($_SESSION['username'] == 'NULL') {header('Location: http://localhost:8000/login', true, 301);
         exit();}
 }
}