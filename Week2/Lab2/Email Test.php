<?php namespace lab2; include 'bootstrap.php';?>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 <!DOCTYPE html>
 <<html>
     <head>
         <meta charset="UTF-8">
         <title>email Test</title>
     </head>
     <body>
         <?php
         
         $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>'testpass1234'
        );
          
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $email = new filter_input(INPUT_POST, 'emailID');
        $emailType = filter_input(INPUT_POST, 'emailID');
        $active = filter_input(INPUT_POST, 'active');
        
        $emailDAO = new EmailDAO($db);
        
        $Emails
                
        
                
        
        
        
         
         
         ?>
     </body>
 </html>

