<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailRequest
 *
 * @author Mikeloeven
 */

namespace API\models\services;

use API\models\interfaces\IRequest;
use API\models\interfaces\IService;
use API\models\interfaces\IModel;

class EmailRequest implements IRequest
{
    
    protected $service;
    
    public function __construct(IService $service)
    {
        $this->service = $service;        
    }
    
     /**
     * Returns a Dataset As Get Request from Email;
     * @param IModel $model
     */
    
    public function GET(IModel $model)
    {
        $id = intval($model->getId());
        
        if ($id >0)
        {
            if ($this->service->idExist($model->getId()))
            {
               return $this->service->read($model->getId())->getAllProperties(); 
            }
            else
            {
                throw new NoContentRequestException($id . 'Email Not Found');
            }
        }
        
        $data =$this->service->getAllRows();
        $values  = array();
        
        foreach($data as $value)
        {
            $values[] = $value->getAllProperties();
        }
        
        return $values;
    }
    
    /**
     * Parses and Uploads POST Requests from API
     * @param IModel $model
     */
    public function POST (IModel $model)
    {
        
        $emailModel = $this->service->getNewEmailModel();
        print_r($model->getRequestData());
        $emailModel->map($model->getRequestData());
        
        if ($this->service->create($emailModel))
        {
            throw new ContentCreatedException('Email Created');
        }
        
        $errors = $this->service->validate($emailModel);
        
        if(count($errors) > 0)
        {
            print_r($errors);
            throw new ValidationException($errors, 'Email Not Created Validation Failed');
            
        }
        
        print_r($errors);
        throw new ConflictRequestException("Email Not Created Conflict");
    
        
    }
    
    /**
     * Parses and Uploads Put Request
     * @param IModel $model
     */
    
    public function PUT(IModel $model)
    {
        $id = intval($model->getId());
        
        $emailModel = $this->service->getNewEmailModel();
        $emailModel->map($model->getRequestData());
        $emailModel->setEmailTypeId($id);
        
        if(!$this->service->idExist($id))
        {
            throw new NoContentRequestException($id, "Email Does Not Exist");
        }
        
        if($this->service->update($emailModel))
        {
            throw new ContentCreatedException("Email Updated");
        }
        
        else
        {
            throw new ConflictRequestException("Email Not Updated Unknown Conflict");
        }
        
    }
    
    /**
     * Processes Delete Requests
     * @param IModel $model
     */
    
    public function DELETE(IModel $model)
    {        
        $id = intval($model->getId());
        
        if ($this->service->delete($id))
        {
            return null;
        }
        
        throw new ConflictRequestException($id . 'Email Not Deleted');
        
    }






//endofclass    
}
