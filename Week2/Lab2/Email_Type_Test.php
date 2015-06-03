<?php namespace lab2; include './bootstrap.php';?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
        
        $emailType = filter_input(INPUT_POST, 'emailType');
        $emailTypeID = filter_input(INPUT_POST, 'emailTypeId');
        $emailTypeActive = filter_input(INPUT_POST, 'emailTypeActive');
        
        $emailTypeDAO = new EmailTypeDAO($db);
        
        $util = new Util();
        
        if ($util->isPostRequest())
        {
            
        }