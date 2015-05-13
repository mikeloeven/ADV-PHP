<?php namespace lab2; include './bootstrap.php'; ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    
    <body>
        <?php
            $dbConfig = array
            (
                    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                    "DB_USER"=>'root',
                    "DB_PASSWORD"=>'testpass1234'
            );
            
            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
            
            if (isset($_GET['emailtypeid']))
            {
                
            }
            else if (isset($_GET['emailid']))
            {
                
            }
            else
            {
                
            }

            
            
            
            
        ?>
    </body>



