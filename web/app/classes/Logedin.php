<?php

namespace Praktikant\Praktikum\classes;

class Logedin
{
 public function Logedin(): void
 {
     if ($_SESSION == []) {
         redirect(url('login')->getAbsoluteUrl());
         exit();
     } elseif ($_SESSION['loggedin'] === false) {
         redirect(url('login')->getAbsoluteUrl());
         exit();
     }
     elseif ($_SESSION['username'] == '') {
         redirect(url('login')->getAbsoluteUrl());
         session_destroy();
         exit();}
 }
}