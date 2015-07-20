<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        
        <?php
        
             if ( isset($scope->view['updated']) && $scope->view['updated'] ) 
             {
                  echo 'Email Type Updated';
             }
             
             else
             {
                  echo 'Email Type Not Updated';
             }
             
         $emailType = $scope->view['model']->getEmailType();
         $active = $scope->view['model']->getActive();
         $emailTypeid = $scope->view['model']->getEmailTypeId();
        ?>
        
        <h3>Add Email Type</h3>
        <form action="#" method="post">
            <label>Phone Type:</label> 
            <input type="hidden"  name="emailtypeid" value="<?php echo $emailTypeid; ?>" />
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="number" max="1" min="0" name="Active" value="<?php echo $active; ?>" />
            <input type="hidden" name="action" value="update" />
            <input type="submit" value="Submit" />
        </form>
        
        <br/>    
        <br/>
        <br/>
        
        
        <?php
            if (count($scope->view['EmailTypes']) <= 0) 
            {
                echo '<p>Empty</p>';
            }
            
            else
            {
                echo '<table border="1" style="border-style:inset"<tr><th>Email Type</th><th>Active</th></tr>';
                
                foreach ($scope->view['EmailTypes'] as $value)
                {
                    echo '<tr>';
                    echo '<td>', $value->getEmailType(),'</td>';
                    echo '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="emailtypeid" value="',$value->getEmailTypeId(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="emailtypeid" value="',$value->getEmailTypeId(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
                    echo '</tr>' ;
                }
            }
        
        ?>
        
        
    </body>
</html>
