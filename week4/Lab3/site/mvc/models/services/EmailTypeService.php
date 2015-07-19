<?php

/**
 * Description of EmailtypeService
 *
 * @author GFORTI
 */

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;


class EmailTypeService implements IService {
    
    protected $DAO;
    protected $validator;
    protected $model;
    
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
    
    function setModel(IModel $model)
    {
        $this->model = $model;
    }
    
    function getDAO()
    {
        return $this->DAO;
    }
    
    function setDAO(IDAO $DAO)
    {
        $this->DAO = $DAO;
    }
    
    function __construct(IDAO $EmailTypeDAO, IService $validator, IModel $model)
    {
        $this->setDAO($EmailTypeDAO);
        $this->setValidator($validator);
        $this->setModel($model);        
    }
    
    public function getAllRows($limit = "", $offset = "") 
    {
        
        return $this->getDAO()->getAllRows($limit, $offset);
    }
    
    public function idExist($id)
    {
        return $this->getDAO()->idExist($id);
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
        echo "pass";
        if ( count($this->validate($model)) === 0 )
        {
            return $this->getDAO()->create($model);
        }
        return false;
    }
    
    public function validate(IModel $model)
    {
        $errors = array();
        if ( !$this->getValidator()->emailTypeIsValid($model->getEmailType()))
        {
            $errors[] = 'Email Type is Invalid';
        }
        
        if ( !$this->getValidator()->emailTypeIsValid($model->getActive()))
        {
            $errors[] = 'Email Active is Invalid';
        }
    }
    
    public function getNewEmailTypeModel()
    {
        return clone $this->getModel();
    }
      
    
}
