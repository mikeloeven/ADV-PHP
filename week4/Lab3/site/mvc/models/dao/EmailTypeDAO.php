<?php 

/**
 * Description of EmailTypeDAO
 * 
 * DAO = Data Access Object
 * 
 * The idea of a Data Access object is a class the will simply execute crud 
 * operations for your database.  We want to be able to create a DAO for each
 * table in your database.
 * 
 * CRUD = (Create Read Update Disable/Delete)
 *
 * @author Mike Loeven
 */
namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IModel;
use App\models\interfaces\ILogging;
use \PDO;

/**
 * DAO Object for Email Types
 * Provides Database Access on Email Types Table 
 */

class EmailTypeDAO extends BaseDAO implements IDAO 
{
    /**
     * Build Object
     * @param PDO $db
     * @param Interface IModel $model
     * @param Interface ILogging $log
     */
    
    public function __construct(PDO $db, IModel $model, ILogging $log) 
    {
        $this->setDB($db);
        $this->setModel($model);
        $this->setLog($log);
    }
    
    /**
     * 
     * @param int $id
     * @return boolean
     */
    
    public function idExist($id)
    {
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM emailtype WHERE emailtypeid = :emailtypeid");
        
        if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0)
        {
            return true;
        }
        return false;
        
    }
/**
 * 
 * @param int $id
 * @return Type Model
 */
    public function read($id) 
    {
        
        $model = clone $this->getModel();
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM emailtype WHERE emailtypeid = :emailtypeid");
        
        if ($stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0)
        {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $model->reset()->map($results);
        }        
        return $model;        
    }
    
    
    
/**
 * 
 * @param IModel $model
 * @return boolean
 */
    public function create(IModel $model) 
    {
        $db = $this->getDB();
        $binds = array(":emailtype" => $model->getEmailType(),":active" => $model->getActive());
        if (!$this->idExist($model->getEmailTypeId()))
        {
            $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype, active = :active");
            
            if ($stmt->execute($binds) && $stmt->rowCount()>0)
            {
                return true;
            }
        }
        return false;
    }
    
    
    /**
     * 
     * @param IModel $model
     * @return boolean
     */    
    
    public function update(IModel $model) 
    {
        
        $db = $this->getDB();         
        $binds = array(":emailtype" => $model->getEmailType(),":active" => $model->getActive(),":emailtypeid" => $model->getEmailTypeId());        
                
         if ( $this->idExist($model->getEmailTypeId()) ) {            
             $stmt = $db->prepare("UPDATE emailtype SET emailtype = :emailtype, active = :active WHERE emailtypeid = :emailtypeid");
             
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 )
             {
                return true;
             } 
             else 
             {
                 $error = implode(",", $db->errorInfo());
                 $this->getLog()->logError($error);
             }            
         }          
         return false;
    }

    /**
     * 
     * @param int $id
     * @return boolean
     */
    
    public function delete($id)
    {
        
        $db = $this->getDB();         
        $stmt = $db->prepare("DELETE FROM emailtype WHERE emailtypeid = :emailtypeid");

        if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) 
        {
            return true;
        } 
        else 
        {
            $error = implode(",", $db->errorInfo());
            $this->getLog()->logError($error);
        }         
        return false;
    }
    
    /**
     * 
     * @return type
     */
    
    public function getAllRows()
    {
        $db = $this->getDB();
        $values = array();
        
        $stmt = $db->prepare("SELECT * FROM emailtype");
        
        if($stmt->execute() && $stmt->rowCount() >0 )
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($results as $value)
            {
                $model = clone $this->getModel();
                $model->reset()->map($value);
                $values[] = $model;
            }
        }
        
        $stmt->closeCursor();
        return $values;
    }

}
