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
            
            $TID=filter_input(INPUT_POST,"TID");
            
            if(isset($TID))
            {
                $emailTypeDAO = new EmailTypeDAO($db);
                if ($emailTypeDAO ->delete($TID))
                {
                    Echo '<h1>Email Type Deleted Successfully</h1><h3>You will be returned to the menu shortly, Click the button if nothing happens</h3><form method="link" action ="Email_Type_Test.php"><input type="submit" value="Return"/></form>';
                 
     
                }
                else 
                {
                    Echo '<h1>Email Type Could not Be Deleted</h1><h3>You will be returned to the menu shortly, Click the button if nothing happens</h3><form method="link" action ="Email__Type_Test.php"><input type="submit" value="Return"/></form>';
   
                    
                }
        
                header("refresh:5; url=Email_Type_Test.php");
                        
            }
            
            
            

            
            
            
            
        ?>
    </body>



