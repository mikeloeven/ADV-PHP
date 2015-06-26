<?php namespace lab2; include './bootstrap.php';?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $pdo = new DB(DBconfig::DBC);
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
        <p />
        <h3>List email</h3>
            <table border="1" cellpadding="5">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Email Type</th>
                    <th>Last updated</th>
                    <th>Logged</th>
                    <th>Active</th>
                </tr>
         <?php 
            $emails = $emailDAO->getAllRows();
            foreach ($emails as $value) {
                echo '<tr><td>',$value->getEmailId(),'</td>','<td>',$value->getEmail(),'</td><td>',$value->getEmailType(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No'),
                    '<td><form action = "Email_Update.php" method="POST"><input type="hidden" name="EID" value="',$value->getEmailId(),'"/><input type="submit" value="Update"/></form></td>',
                    '</td><td><form action="Email_Delete.php" method="POST"><input type="hidden" name="EID" value="',$value->getEmailId(),'"/><input type="submit" value="Delete"/></form></td></tr>';
            }
            echo '</table>'

         ?>
        </table>  
        <p />
        <h3>Update email</h3>
        <p />
        <form action ="Email_Update.php" method="POST">
            <span>ID: <input type="text" name="EID" value=""/><span>
            <input type="submit" value="Lookup"/>
        </form>
        <br /><br />
        <form action='index.php' method='link'><input type='submit' value='Return To Index'></form>
        
    </body>
</html>