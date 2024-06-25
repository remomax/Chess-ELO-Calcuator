<?php
declare(strict_types=1);
namespace Praktikant\Praktikum\classes;
use Praktikant\Praktikum\classes\Connection;
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
     } elseif ($_SESSION['verifyed'] === '') {
         redirect(url('login')->getAbsoluteUrl());
         exit();
         } 
     elseif ($_SESSION['username'] == '') {redirect(url('login')->getAbsoluteUrl());
         session_destroy();
         exit();  } else {
     $connection = new Connection();
            $sql = 'SELECT username FROM person WHERE username="' . $_SESSION['username'] . '" LIMIT 1';
            
    $result = $connection->getConnection()->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $username4 = $row["username"];
            
        }
        if ($_SESSION['username'] === $username4) {
           if ($_SESSION['verifyed'] === true) {} else {redirect(url('login')->getAbsoluteUrl());
         session_destroy();
         exit();}
           } else { redirect(url('login')->getAbsoluteUrl());
         session_destroy();
         exit(); }
     
     
        
            
    } else {
      redirect(url('login')->getAbsoluteUrl());
         session_destroy();
         exit(); 
    }
         
 }
}}
