<?php

/** 
 * Data Object Model for the Email Type Table
 */

namespace App\models\services;

class EmailTypeModel extends BaseModel {
    
    private $emailtypeid;
    private $emailtype;
    private $active;
    
    function getEmailTypeId() {
        return $this->emailtypeid;
    }

    function getEmailType() {
        return $this->emailtype;
    }

    function getActive() {
        return $this->active;
    }

    function setEmailtypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;        
    }

    function setEmailtype($emailtype) {
        $this->emailtype = $emailtype;
    }

    function setActive($active) {
        $this->active = $active;
    }
}
