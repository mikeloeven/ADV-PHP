<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Mikeloeven
 */
namespace API\models\services;

use API\models\interfaces\IRequest;
use API\models\interfaces\IService;
use API\models\interfaces\IModel;


class EmailTypeRequest implements IRequest
{
    protected $service;    
    
    public function __construct(IService $service) 
    {
        $this->service = $service;
    }
    
    /**
     * Returns a Dataset As Get Request from Email Type;
     * @param IModel $model
     */
    public function GET(IModel $model)
    {
        $id = intval($model->getId());
        
        if ( $id > 0)
        {
            if ($this->service->idExist($model->getId()))
            {
                return $this->service->read($model->getId())->getAllProperties();
            }
            else
            {
                throw new NoContentRequesTException($id . 'ID does not exist');
            }
        }
        
        $data = $this->service->getAllRows();
        $values = array();
        
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
    public function POST(IModel $model)
    {
        
        $emailTypeModel = $this->service->getNewEmailTypeModel();
        $emailTypeModel->map($model->getRequestData());
        
        if ($this->service->validate($emailTypeModel))
        {
            throw new ContentCreatedException('Email Type Created');
        }
        
        $errors = $this->service->validate($emailTypeModel);
        
        if (count($errors) > 0)
        {
            throw new ValidationException($errors, 'Email Type Not Created ');
        }
        
        throw new ConflictRequestException("Email Type Not Created");
        
    }
    
    /**
     * Parses and Uploads Put Request
     * @param IModel $model
     */
    
    public function PUT(IModel $model)
    {
        $id = intval($model->getId());
        
        $emailTypeModel = $this->service->getNewEmailTypeModel();
        $emailTypeModel->map($model->getRequestData());
        $emailTypeModel->setEmailTypeId($id);
        
        if (!$this->service->idExist($id))
        {
            throw new NoContentRequestException($id, "Email Type Does Not Exist");
        }
        
        if ($this->service->update($emailTypeModel))
        {
            throw new ContentCreatedException("Email Type Created");
        }
        else
        {
            throw new ConflictRequestException('Email Type Not Created');
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
        
        throw new ConflictRequestException($id . 'Email Type Not Deleted');
    }
    
    
}
 