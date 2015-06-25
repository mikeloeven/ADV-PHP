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
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>'testpass1234'
        );

        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
       
        $util = new Util();
        $validator = new Validator();
        $emailDAO = new EmailDAO($db);
        $emailTypeDAO = new EmailTypeDAO($db);
        $emailTypeModel = new EmailTypeModel($db);
       
       
         
        if ( $util->isPostRequest() ) {
            

            
            if (isset($_POST["EID"]))
            {             
                $_SESSION['EID'] = filter_input(INPUT_POST, "EID");   
                $emailId = $_SESSION['EID'];
                $emailTypeModel = $emailDAO->getById($emailId);
                
            }

            else if (isset($_POST['BACK']))
            {
                
                session_destroy();
                header("refresh:0; url=Email_Test.php");
            }
            else if (isset($_SESSION['EID']))
            {
                $emailTypeModel->map(filter_input_array(INPUT_POST));
                $emailTypeModel->setEmailId($_SESSION['EID']);
            }          
        } 
           
        
        
        
        $emailtypeid = $emailTypeModel->getEmailTypeId();
        $emailtype = $emailTypeModel->getEmailType();
        $active = $emailTypeModel->getActive();  
        $emailTypes = $emailTypeDAO->getAllRows();
        
              
        
        $emailService = new EmailService($db, $util, $validator, $emailDAO, $emailTypeModel);
        
        if (isset($_POST["email"]))
        {
            if ( $emailDAO->idExist($emailTypeModel->getEmailId())) {
                if($emailService->saveForm())
                {
                    Echo "<h3>Email Updated Successfully</h3>";
                }
                else 
                {
                    Echo "<h3>Email Not Updated</h3>";
                }
            }
        }
        
        
        ?>
        
        
        <h3>Update email Type</h3>
        <form action="#" method="post">
            <label>Email Type:</label>
            <input type="text" name="emailType" value="<?php echo $emailtype; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             
            <br /><br />
            <input type="submit" value="Update" />
            </form>
            <form action ="#" method="post"><input type="hidden" name ="BACK" value="true"/> <input type="submit" value ="back" /> </form>
            
         
 
                  
    </body>
</html>
