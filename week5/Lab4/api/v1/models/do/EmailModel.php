<?php

/**
 * Data Object Model for Email Table
 */
namespace API\models\services;

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
    
    function getemailid()
    {
        return $this->emailid;
    }
    
    function getemail()
    {
        return $this->email;
    }
    
    function getemailtype()
    {
        return $this->emailtype;
    }
    
    function getemailtypeid()
    {
        return $this->emailtypeid;
    }
    
    function getemailtypeactive()
    {
        return $this->emailtypeactive;
    }
    
    function getlogged()
    {
        return $this->logged;
    }
    
    function getlastupdated()
    {
        return $this->lastupdated;
    }
    
    function getactive()
    {
        return $this->active;
    }
    
    function setemailid($emailid)
    {
        $this->emailid = $emailid;
    }
    
    function setemail($email)
    {
        $this->email = $email;
    }
    
    function setemailtypeid($emailtypeid)
    {
        $this->emailtypeid = $emailtypeid;
    }
    
    function setemailtype($emailtype)
    {
        $this->emailtype = $emailtype;
    }
    
    function setemailtypeactive($emailtypeactive)
    {
        $this->emailtypeactive = $emailtypeactive;
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