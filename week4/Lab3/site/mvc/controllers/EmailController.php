<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controller for Email
 *
 * @author Mikeloeven
 */

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class EmailController extends BaseController implements IController{
    
    public function __construct(IService $EmailTypeService, IService $EmailService) 
    {
        $this->service = $EmailService;
        $this->typeservice = $EmailTypeService;
    }
    
    public function execute(IService $scope)
    {
        $this->data['model'] = $this->service->getNewEmailModel();
        $this->data['model']->reset();
        $viewPage = 'email';
        
        if ($scope->util->isPostRequest())
        {
            
          
            switch($scope->util->getAction())
            {
                case "create":
                    
                    $this->data['model']->map($scope->util->getPostValues());
                    
                    $this->data['errors'] = $this->service->validate($this->data['model']);             
                    
                    $this->data['saved'] = $this->service->create($this->data['model']);
                    
                    break;
                
                case "update":
                    
                    $this->data['model']->map($scope->util->getPostValues());
                    
                    $this->data["updated"] = $this->service->update($this->data['model']);
                 
                    $viewPage .= 'edit';
                    
                    break;
                
                case "edit":
                    
                    $viewPage .= 'edit';
                $this->data['model'] = $this->service->read($scope->util->getPostParam('emailid'));
                    break;
                
                case "delete":
                    $this->data["deleted"] = $this->service->delete($scope->util->getPostParam('emailid'));
                    break;
                
            }
        }
        
        $this->data['Email'] = $this->service->getAllRows();
        $this->data['Types'] =$this->typeservice->getAllRows();
        $scope->view = $this->data;
        
        return $this->view($viewPage,$scope);
    }
    

}
