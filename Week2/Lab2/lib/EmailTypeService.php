<?php namespace lab2; use PDO;
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
    private $_EmailTypeDAO;
    private $_EmailTypeModel;

    public function __construct($db, $util, $validator, $emailTypeDAO, $emailTypeModel)
    {
        $this->_DB = $db;
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_EmailTypeDAO = $emailTypeDAO;
        $this->_EmailTypeModel = $emailTypeModel;
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
            if($this->_EmailTypeDAO->save($this->_EmailTypeModel))
            {
                return true;
            }
            else 
            {
                return false;
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
    
    public function displayEmailTypes()
    {
        $stmt = $this->_DB->prepare("SELECT * FROM emailtype");
        
        if ($stmt->execute() && $stmt->rowCount()>0)
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($results as $value)
            {
                echo '<p>', $value['emailtype'], '</p>';
            }
        }
            else 
            {
                echo '<p>No Data</p>';
            }
        
    }
    
    public function displayEmailActions()
    {
        $Emails = $this->_EmailTypeDAO->getAllRows();
        
        if (count($emailtypes)<0)
        {
            echo '<p>No Data</p>';
        }
        else 
        {
            echo '<table border="1" cellpadding = "5"><tr><th>Email ID</th><th>Email</th><th>Email Type</th><th>Active</th><th>Last Updated</th></tr>;';
            foreach ($emailtypes as $value)
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
    
    public function validateForm(){
        if ($this->_Util->isPostRequest())
        {
            $this->_errors = array();
            if (!$this->_Validator->emailTypeIsValid($this->_EmailTypeModel->getEmailType()))
            {
                $this->_errors[] = 'Email Type Is Invalid';
            }

        }
    }
    
    
    
    
    
}