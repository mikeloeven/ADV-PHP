<?php namespace lab2;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EmailModel implements IModel
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
    
    function getEmailTypeId()
    {
        return $this->emailtypeid;
    }
    
    function getEmailTypeActive()
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
    
    function setEmailTypeId($emailtypeid)
    {
        $this->emailtypeid = $emailtypeid;
    }
    
    function setEmailType($emailtype)
    {
        $this->emailtype = $emailtype;
    }
    
    function setEmailTypeActive($emailtypeactive)
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
    
    
    
    public function reset()
    {
        $this->setActive('');
        $this->setEmail('');
        $this->setEmailId('');
        $this->setEmailType('');
        $this->setEmailTypeActive('');
        $this->setEmailTypeId('');
        $this->setLastUpdated('');
        $this->setLogged('');
        return $this;
    }
    
    public function map(array $values)
    {
        if (array_key_exists('emailid', $values) )
        {
            $this->setEmailId($values['emailid']);
        }
        
        if ( array_key_exists('email', $values) ) {
            $this->setPhoneid($values['email']);
        }
        
        if ( array_key_exists('emailtypeid', $values) ) {
            $this->setPhoneid($values['emailtypeid']);
        }
        
        if ( array_key_exists('emailtypeactive', $values) ) {
            $this->setPhoneid($values['emailtypeactive']);
        }
        
        if ( array_key_exists('logged', $values) ) {
            $this->setPhoneid($values['logged']);
        }
        
        if ( array_key_exists('lastupdated', $values) ) {
            $this->setPhoneid($values['lastupdated']);
        }
        
        if ( array_key_exists('active', $values) ) {
            $this->setPhoneid($values['active']);
        }
        return $this;
    }
    
}