<?php namespace lab2;
include PDO;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EmailTypeService
{
    
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_EmailDAO;
    private $_EmailModel;

    private function __construct($db, $util, $validator, $emailDAO, $emailModel)
    {
        $this->_DB = $db;
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_EmailDAO = $emailDAO;
        $this->_EmailModel = $emailModel;
    }
    
    public function saveForm()
    {
        if(!$this->_Util->isPostRequest())
        {
            return false;
        }
        
        $this->validateForm();
        
        if($this->hasErrors())
        {
            $this->displayErrors();
        }
        else 
        {
            if($this->_EmailDAO->save($this->_EmailModel))
            {
                echo 'Email Added/Updated';
            }
            else 
            {
                echo 'Email could not be added';
            }
        }
    }
    
    public function validateForm() 
    {
        if ($this->_Util->isPostRequest())
        {
            $this->_errors = array();
            if (!$this->_Validator->emailTypeIsValid($this->_EmailModel->getEmailType()))
            {
                $this->_errors[] = 'Email Type Is Invalid';
            }
            if (!$this->_Validator->activeIsValid($this->_emailTypeModel->getActive()))
            {
                $this->_errors[] = 'Active Is Invalid';
            }
        }
    }
    
    public function displayErrors()
    {
        foreach ($this->_errors as $value)
        {
            echo '<p>',$value,'</p>';
        }
    }
    
    public function hasErrors()
    {
        return (count($this->_errors)>0);
    }
    
    public function displayEmails()
    {
        $stmt = $this->_DB->prepare("SELECT * FROM email");
        
        if ($stmt->execute() && $stmt->rowCount()>0)
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($results as $value)
            {
                echo '<p>', $value['email'], '</p>';
            }
        }
            else 
            {
                echo '<p>No Data</p>';
            }
        
    }
    
    public function displayEmailActions()
    {
        $Emails = $this->_EmailDAO->getAllRows();
        
        if (count($emails)<0)
        {
            echo '<p>No Data</p>';
        }
        else 
        {
            echo '<table border="1" cellpadding = "5"><tr><th>Email ID</th><th>Email</th><th>Email Type</th><th>Active</th><th>Last Updated</th></tr>;';
            foreach ($emails as $value)
            {
                echo '<tr>';
                echo '<td>', $value->getEmailId(),'</td>';
                echo '<td>', $value->getEmail(),'</td>';
                echo '<td>', $value->getEmailType(),'</td>';
                echo '<td>', $value->getActive(),'</td>';
                echo '<tr>';
            }
            echo '</table>';
        }
    }
    
    
    
    
    
}