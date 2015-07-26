<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\models\services;

class EmailModel extends BaseModel
{
    private $emailid;
    private $email;
    private $emailtypeid;
    private $emailtype;
    private $emailtypeactive;
    private $logged;
    private $lastupdated;
    private $active;
    
    function getEmailId()
    {
        return $this->emailid;
    }
    
    function getEmail()
    {
        return $this->email;
    }
    
    function getEmailType()
    {
        return $this->emailtype;
    }
    
    function getEmailTypeId()
    {
        return $this->emailtypeid;
    }
    
    function getEmailTypeactive()
    {
        return $this->emailtypeactive;
    }
    
    function getLogged()
    {
        return $this->logged;
    }
    
    function getLastUpdated()
    {
        return $this->lastupdated;
    }
    
    function getActive()
    {
        return $this->active;
    }
    
    function setEmailId($emailid)
    {
        $this->emailid = $emailid;
    }
    
    function setEmail($email)
    {
        $this->email = $email;
    }
    
    function setEmailtypeid($emailtypeid)
    {
        $this->emailtypeid = $emailtypeid;
    }
    
    function setEmailtype($emailtype)
    {
        $this->emailtype = $emailtype;
    }
    
    function setEmailtypeActive($emailtypeactive)
    {
        $this->emailtype = $emailtypeactive;
    }   
    
    function setLogged($logged)
    {
        $this->logged = $logged;
    }
    
    function setLastUpdated($lastupdated)
    {
        $this->lastupdated = $lastupdated;
    }
    
    function setActive($active)
    {
        $this->active = $active;
    }
    
    
    
}
?>