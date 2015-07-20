<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

        
            if ( $scope->util->isPostRequest() ) {
             
             if ( isset($scope->view['errors']) ) {
                print_r($scope->view['errors']);
             }
             
             if ( isset($scope->view['saved']) && $scope->view['saved'] ) {
                  echo 'Email Type Added';
             }
             
             if ( isset($scope->view['deleted']) && $scope->view['deleted'] ) {
                  echo 'Email Type deleted';
             }
             
         }
         $email = $scope->view['model']->getEmail();
         $emailType = $scope->view['model']->getEmailType;
         
         $active = $scope->view['model']->getActive();
         
        ?>
        
        <h3>Add Email Type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="number" max="1" min="0" name="Active" value="<?php echo $active; ?>" />
            <input type="hidden" name="action" value="create" />
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