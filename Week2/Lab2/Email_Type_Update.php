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
        $emailModel = new EmailModel();
       
         
        if ( $util->isPostRequest() ) {
            

            
            if (isset($_POST["EID"]))
            {             
                $_SESSION['EID'] = filter_input(INPUT_POST, "EID");   
                $emailId = $_SESSION['EID'];
                $emailModel = $emailDAO->getById($emailId);
                
            }

            else if (isset($_POST['BACK']))
            {
                
                session_destroy();
                header("refresh:0; url=Email_Test.php");
            }
            else if (isset($_SESSION['EID']))
            {
                $emailModel->map(filter_input_array(INPUT_POST));
                $emailModel->setEmailId($_SESSION['EID']);
            }          
        } 
           
        
        
        
        $emailtypeid = $emailModel->getEmailtypeid();
        $email = $emailModel->getEmail();
        $active = $emailModel->getActive();  
        $emailTypes = $emailTypeDAO->getAllRows();
              
        
        $emailService = new EmailService($db, $util, $validator, $emailDAO, $emailModel);
        
        if (isset($_POST["email"]))
        {
            if ( $emailDAO->idExist($emailModel->getEmailId())) {
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
        
        
        <h3>Add email</h3>
        <form action="#" method="post">
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            <label>Email Type:</label>           
            <select name="emailtypeid">
            <?php                
                foreach ($emailTypes as $value) {
                    if ( $value->getEmailTypeid() == $emailModel->getEmailTypeId() ) {                        
                        echo '<option value="',$value->getEmailTypeId(),'" selected="selected">',$value->getEmailType(),'</option>';  
                    } else {
                        echo '<option value="',$value->getEmailTypeId(),'">',$value->getEmailType(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
            <input type="submit" value="Submit" />
            </form>
            <form action ="#" method="post"><input type="hidden" name ="BACK" value="true"/> <input type="submit" value ="back" /> </form>
            
         
 
                  
    </body>
</html>
