<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace APP\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IModel;
use App\models\interfaces\ILogging;
use \PDO;

class EmailDAO extends BaseDAO implements IDAO
{
    
    /**
     * Build Object
     * @param PDO $db
     * @param Interface IModel $model
     * @param Interface ILogging $log
     */
    
    public function __construct(PDO $db, IModel $model, ILogging $log) 
    {
        $this->setDB($db);
        $this->setModel($model);
        $this->setLog($log);
    }
    
    /**
     * Return true if email id exists in database
     * @return boolen
     */
    
    public function idExist($id)
    {
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT emailid FROM email WHERE emailid= :emailid");
        
        if($stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 )
        {
            return true;
        }
        return false;
    }
    
    /**
     * Return true if email exists in database
     * @return boolen
     */
    
    public function emailExist($email)
    {
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT emailid FROM email WHERE email= :email");
        if($stmt->execute(array(':email' => $email)) && $stmt->rowCount() > 0)
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $value = $result[0];
            $this->$setModel->setEmailId($value['emailid']);
        }
        return null;
    }   
    
    /**
     * Returns row from database By email ID
     * @return array
     */
    
    public function read($id)
    {
        $model = clone $this->getModel();
        $db = $this->getDB();        
        $stmt = $db->prepare("SELECT email.emailid, email.email, emailtype.emailtypeid, emailtype.emailtype, emailtype.active, email.logged, email.lastupdated, email.active FROM email LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid "
                ."WHERE email.emailid = :emailid");
        if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0)
        {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $model->reset()->map($results);
        }
        
        return $model;
        
    }
    
    /**
     * Method to Create a New Row in the Database
     * @return boolen
     */
    
    public function create(IModel $model)
    {
        $db = $this->getDB();
        $binds = array
        (
            ":email" => $model->getEmail(),
            ":active" => $model->getActive(),
            ":emailtypeid" => $model->getEmailTypeId(),
        );
        
        if (!$this->idExist($model->getEmailId()))
        {
            $stmt = $db->prepare("INSERT INTO email SET email = :email, emailtypeid = :emailtypeid, active = :active, logged = now(), lastupdated=now()");
            
            if ( $stmt->execute($binds) && $stmt->rowCount() > 0)
            {
                return true;
            }
        }
        
        return false;     
    }
    
    /**
     * Method to Update Existing New Row in the Database 
     * @return boolen
     */
    
    public function update(IModel $model)
    {
        $db = $this->getDB();
        $values = array
        (
            ":email" => $model->getEmail(),
            ":active" => $model->getActive(),
            ":emailtypeid" => $model->getEmailTypeId(),
        );
        
        if( $this->idExist($model->getEmailId()))
        {
            $values[":emailid"] = $model->getEmailid();
            $stmt = $db->prepare("UPDATE email set email = :email, emailtypeid = :emailtypeid, active = :active, lastupdated = now() WHERE emailid = :emailid");
        
        echo "<prepare Statement>";
        if ($stmt->execute($values) && $stmt->rowCount() > 0 )
        {
            return true;
        }
        }
        
        return false;
    }
    
    /**
     * Method to Delete a Row from the Database
     * @return boolen
     */
    
    public function delete($id)
    {
        $db = $this->getDB();
        $stmt = $db->prepare("DELETE FROM email WHERE emailid = :emailid");
        
        if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0)
        {
            return true;
        }
        
        return false;
    }
    
    /**
     * Method to Return All Rows
     * @return Array
     */
    
    public function getAllRows()
    {
       
        $values = array();
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT email.emailid, email.email, email.emailtypeid, emailtype.emailtype ,email.lastupdated, email.logged, email.active FROM email LEFT JOIN emailtype ON email.emailtypeid = emailtype.emailtypeid");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0)
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($results as $value)
            {
                $model = new EmailModel();
                $model->reset()->map($value);
                $values[] = $model;
                
            }
        }
    
        
        $stmt->closeCursor();
        return $values;
    }


}

