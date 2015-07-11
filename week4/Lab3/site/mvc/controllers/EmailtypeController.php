<?php

/**
 * Description of EmailtypeController
 *
 * @author GFORTI
 */
namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;


class EmailtypeController extends BaseController implements IController  {
    
    private $emailtypeservice;
    
    public function __construct( IService $emailtypeService) {
        $this->emailtypeservice = $emailtypeService;
    }
    
    public function execute(IService $scope) {
        
        $viewPage = 'emailtype';
        
        $this->data['email'] = $this->emailtypeservice->getEmail();
                
        
        $scope->view =  $this->data;     
        return $this->view($viewPage,$scope);
        
    }
}
