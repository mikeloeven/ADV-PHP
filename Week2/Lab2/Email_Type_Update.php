<?php namespace lab2; include 'bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        $pdo = new DB(DBconfig::DBC);
        $db = $pdo->getDB();
        $validator = new Validator;
        $util = new Util();
        $emailTypeDAO = new EmailTypeDAO($db);
        $emailTypeModel = new EmailTypeModel($db);
       
       
         
        if ( $util->isPostRequest() ) {
            

            
            if (isset($_POST["TID"]))
            {             
                $_SESSION['TID'] = filter_input(INPUT_POST, "TID");   
                $emailTypeId = $_SESSION['TID'];
                $emailTypeModel = $emailTypeDAO->getById($emailTypeId);
                if (!$emailTypeDAO->idExist($emailTypeModel->getEmailTypeId()))
                {
                    echo '<h1>This TypeID Does Not Exist</h1>';
                    header("refresh:3; url=Email_Test.php");
                }
                
            }

            else if (isset($_POST['BACK']))
            {
                
                session_destroy();
                header("refresh:0; url=Email_Type_Test.php");
            }
            else if (isset($_SESSION['TID']))
            {
                $emailTypeModel->map(filter_input_array(INPUT_POST));
                $emailTypeModel->setEmailTypeId($_SESSION['TID']);
            }          
        } 
           
        
        
        
        $emailtypeid = $emailTypeModel->getEmailTypeId();
        $emailtype = $emailTypeModel->getEmailType();
        $active = $emailTypeModel->getActive();  
        $emailTypes = $emailTypeDAO->getAllRows();
        
              
       
        $emailTypeService = new EmailTypeService($db, $util, $validator, $emailTypeDAO, $emailTypeModel);
        
        if (isset($_POST["emailtype"]))
        {
            if ( $emailTypeDAO->idExist($emailTypeModel->getEmailTypeId())) {
                if($emailTypeService->saveForm())
                {
                    Echo "<h3>Email Type Updated Successfully</h3>";
                }
                else 
                {
                    Echo "<h3>Email Type Not Updated</h3>";
                }
            }
        }
        
        
        ?>
        
        
        <h3>Update email Type</h3>
        <form action="#" method="post">
            <label>Email Type:</label>
            <input type="text" name="emailtype" value="<?php echo $emailtype; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             
            <br /><br />
            <input type="submit" value="Update" />
            </form>
            <form action ="#" method="post"><input type="hidden" name ="BACK" value="true"/> <input type="submit" value ="back" /> </form>
            
         
 
                  
    </body>
</html>
