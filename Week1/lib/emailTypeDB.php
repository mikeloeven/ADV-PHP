<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class emailTypeDB
{
    
    private $dbConfig = array
    (
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>'testpass1234'
    );


public function saveEmailType($type)
{
$pdo = new DB($this->dbConfig);
$db = $pdo->getDB();

$stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");
$values = array(":emailtype"=>$type);
try
{
if ($stmt->execute($values) && $stmt->rowCount() > 0)
{
    echo 'Email Type Added';
}
}

 catch (Exception $e)
 {
     echo $e->getMessage();
 }
 
 finally 
 {
     $pdo->closeDB();
 }

}

public function listEmailTypes()
{
    $pdo = new DB($this->dbConfig);
    $db = $pdo->getDB();
    
    $stmt = $db->prepare("SELECT * FROM emailtype");
    
    try
    {
        if ($stmt->execute() && $stmt->rowCount() > 0)
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value)
            {
                if($value['active']!=1)
                {
                    echo '<p>', $value['emailtype'], '</p>';
                }
                else 
                {
                    echo '<p><strong>', $value['emailtype'], '</strong></p>';
                }
            }
        }
        else echo '<p> There are No Results </p>';
    } 
    catch (Exception $e) {
        echo $e->getMessage();
    }
    finally
    {
        $pdo->closeDB();
    }
      
}



}
