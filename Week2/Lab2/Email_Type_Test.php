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
           
        <h3>Add Email Type</h3>
        <form action="#" method ="post">
            <label>Email Type:</label>
            <input type="hidden" name="unused" />
            <input type="text" name="emailtype" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active;?>" />
            <br /><br />
            <input type="submit" value="Submit" />
        </form>
            
            <table border="1" cellpadding="5";>
                <tr>    
                    <th>Email Type</th>
                    <th>Active</th>
                </tr>
            <?php 
                
                $emailTypes = $emailTypeDAO->getAllRows();
                foreach ($emailTypes as $value)
                {
                    echo '<tr><td>',$value->getEmailtype(),'</td><td>',$value->getActive(),'</td></tr>';
                }
            
            ?>

                   
        
        