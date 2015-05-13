<?php namespace lab2; include './bootstrap.php';?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>'testpass1234'
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB(); 
        
        
        $email = filter_input(INPUT_POST, 'email');
        $emailTypeid = filter_input(INPUT_POST, 'emailtypeid');
        $active = filter_input(INPUT_POST, 'active');
  
        
         $emailDAO = new EmailDAO($db);
         $emailTypeDAO = new EmailTypeDAO($db);
         
         $emailTypes = $emailTypeDAO->getAllRows();
         
         $util = new Util();
         
          if ( $util->isPostRequest() ) {
              echo "<p />";
               $validator = new Validator(); 
                $errors = array();
                if( !$validator->emailIsValid($email) ) {
                    $errors[] = 'Email is invalid';
                } 
                
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid';
                }
                
                if ( empty($emailTypeid) ) {
                     $errors[] = 'Email type is invalid';
                }     
                
                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p>',$value,'</p>';
                    }
                }
                
                else
                {
                    
                    $emailModel = new EmailModel();                    
                    $emailModel->map(filter_input_array(INPUT_POST));
                    //var_dump($emailModel);
                    if ( $emailDAO->save($emailModel) ) {
                        echo 'Email Added';
                    } else {
                        echo 'Email not added';
                    }
                echo "<p />";
                var_dump($errors);
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
                    if ( $value->getEmailTypeid() == $emailTypeid ) {                        
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
         
            <table border="1" cellpadding="5">
                <tr>
                    <th>Email</th>
                    <th>Email Type</th>
                    <th>Last updated</th>
                    <th>Logged</th>
                    <th>Active</th>
                </tr>
         <?php 
            $emails = $emailDAO->getAllRows(); 
            foreach ($emails as $value) {
                echo '<tr><td>',$value->getEmail(),'</td><td>',$value->getEmailType(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td><td><a href=update.php?eId=',$value->getEmailId(),'>Update</a></td></tr>' ;
            }

         ?>
            </table>
    </body>
</html>