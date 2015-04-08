<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
        
        $util = new util();
        $validator = new Validator();
        $EDB = new emailTypeDB();
        
        $emailType = filter_input(INPUT_POST, 'emailType');
                
        $errors = array();
        
        if ( $util->isPostRequest())
        {
            if (!$validator->emailTypeIsValid($emailType))
            {
                $errors[] = 'Email Type Is Not Valid';
            }
        
            if (count($errors) > 0)
            {
                foreach ($errors as $value)
                {
                    echo '<p>',$value,'</p>';
                }
            }
            
            else
            {
                $EDB->saveEmailType($emailType);
            }    
                   
               
            
            
        }
        
            
            
            
            
            
        
        ?>

        <h3>Add Email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailType" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>
        
        <?php
        
            $EDB = new emailTypeDB();
            $EDB->listEmailTypes();
        
        ?>
        
    </body>
</html>