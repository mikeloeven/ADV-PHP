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
        
        $emailType = filter_input(INPUT_POST, 'emailtype');
        $emailTypeActive = filter_input(INPUT_POST, 'active');
        $emailTypeDAO = new EmailTypeDAO($db);
        
        $util = new Util();
        
        if ($util->isPostRequest())
        {
            echo "<p /";
            $validator = new Validator();
            $errors = array();
            if ( !$validator->emailTypeIsValid($emailType))
            {
                $errors[] = 'Email Type Is Invalid';
            }
            if( !$validator->activeIsValid($emailTypeActive))
            {
                $errors[] = 'Active Is Invalid';
            }
           
            if (count($errors) > 0 )
            {
                foreach ($errors as $value)
                {
                    echo '<p>',$value,'</p>';
                }
            }
            
            else
            {
                $emailtypeModel = new EmailTypeModel();
                $emailtypeModel -> map(filter_input_array(INPUT_POST));
                echo '<p />';
                echo '<p />';
                
                if($emailTypeDAO->save($emailtypeModel))
                {
                    echo 'EmailType Added';
                }
                else 
                {
                    echo 'EmailType Not Added';
                }
                
            }
            
        }
        ?>
           
        <h3>Add Email Types</h3>
        <form action="#" method ="post">
            <label>Email Type:</label>
            <input type="hidden" name="unused" />
            <input type="text" name="emailtype" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active;?>" />
            <br /><br />
            <input type="submit" value="Submit" />
            <br /><br />
        </form>
        <h3>List Email Types</h3>
            <table border="1" cellpadding="5";>
                <tr> 
                    <th>Type ID</th>
                    <th>Email Type</th>
                    <th>Active</th>
                    <th></th>
                    <th></th>
                </tr>
            <?php 
                
                $emailTypes = $emailTypeDAO->getAllRows();
                foreach ($emailTypes as $value)
                {
                    echo '<tr><td>',$value->getEmailtypeid(),'</td><td>',$value->getEmailtype(),'</td><td>',$value->getActive(),'</td>'
                            . '<td><form action="Email_Type_Update.php" method="post"><input type="hidden" name="TID" value="',$value->getEmailtypeid(),'"/><input type="submit" value="Update"/></form></td>'
                            . '<td><form action="Email_Type_Delete.php" method="post"><input type="hidden" name="TID" value="',$value->getEmailtypeid(),'"/><input type="submit" value="Delete"/></form></td></tr>';
                }
            
            ?>
            </table>
        <br /><br />
        <h3>Update Email Type</h3>
        <form action="Email_Type_Update.php" method="post">
            <span><label>TypeID:</label><input type="text" name="TID" value=""/><input type="submit" value="Update"/></span>
        </form>
        <br /><br />
        <form action='index.php' method='link'><input type='submit' value='Return To Index'></form>




                   
        
        