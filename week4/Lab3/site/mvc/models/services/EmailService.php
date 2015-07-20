<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;

class EmailService implements IService
{
    protected $DAO;
    protected $validator;
    protected $model;
    
    function getDAO()
    {
        return $this->DAO;
    }
    
    function setDAO($dao)
    {
        $this->DAO = $dao;
    }
    
    function getValidator()
    {
        return $this->validator;
    }
    
    function setValidator($validator)
    {
        $this->validator = $validator;
    }
    
    function getModel()
    {
        return $this->model;
    }
    
    function setModel($model)
    {
        $this->model = $model;
    }    

    public function __construct(IDAO $emailDAO, IService $validator, IModel $model)
    {
        $this->Validator = $validator;
        $this->DAO = $emailDAO;
        $this->model = $model;
    }
    
    public function getAllRows($limit = "", $offset = "") 
    {
        return $this->getDAO()->getAllRows($limit, $offset);
    }
    
    public function read($id) 
    {
        return $this->getDAO()->read($id);
    }
    
    public function delete($id) 
    {
        return $this->getDAO()->delete($id);
    }
    
    public function create(IModel $model) 
    {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->create($model);
        }
        return false;
    }
    
    public function update(IModel $model) 
    {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->update($model);
        }
        return false;
    }
    
    public function validate( IModel $model ) {
        $errors = array();
        if ( !$this->getValidator()->emailIsValid($model->getEmail()) ) 
        {
            $errors[] = 'Email Type is Invalid';
        }
               
        if ( !$this->getValidator()->activeIsValid($model->getActive()) ) 
        {
            $errors[] = 'Email active is Invalid';
        }
        
        if ( !$this->getValidator()->emailTypeIsValid($model->getEmailType()) )
        {
            $errors[] = 'Email Type is Invalid';
        }
        
        return $errors;

    }
    
    public function getNewEmailModel()
    {
        return clone $this->getModel();
    }
    
    
    
}