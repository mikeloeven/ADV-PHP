<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

        
        if ( $scope->util->isPostRequest() ) {
             
             if ( isset($scope->view['errors']) ) {
             }
             
             if ( isset($scope->view['saved']) && $scope->view['saved'] ) {
                  echo 'Email Added';
             }
             
             if ( isset($scope->view['deleted']) && $scope->view['deleted'] ) {
                  echo 'Email deleted';
             }
             
         }
         $email = $scope->view['model']->getEmail();
         $emailTypeid = $scope->view['model']->getemailTypeId();
         $emailType = $scope->view['model']->getEmailType();         
         $active = $scope->view['model']->getActive();
         
         
?>
        
        <h3>Email</h3>
        <form action="#" method="post">
            <label>Email:</label> 
            <input type="text" name="email" value="<?php echo $email; ?>"/>
            <select name="emailtypeid">
            <?php                
                foreach ($scope->view['Types'] as $value) {
                    if ( $value->getEmailTypeid() == $emailTypeid ) {                        
                        echo '<option value="',$value->getEmailTypeId(),'" selected="selected">',$value->getEmailType(),'</option>';  
                    } else {
                        echo '<option value="',$value->getEmailTypeId(),'">',$value->getEmailType(),'</option>';
                    }
                }
            ?>
            </select>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            <input type="hidden" name="action" value="create" />
            <input type="submit" value="Submit" />
        </form>
        <form method ="link" action ="index">
            <input type="submit" value ="back"/>
        </form>
        <br/>    
        <br/>
        <br/>
        
        
        <?php
          
        if (count($scope->view['Email']) <= 0) 
            {
                echo '<p>Empty</p>';
            }
            
            else
            {
                echo '<table border="1" style="border-style:inset"<tr><th>Email</th><th>Email Type</th><th>Active</th><th>Updated</th><th>Logged</th></tr>';
                
                foreach ($scope->view['Email'] as $value)
                {
                    echo '<tr>';
                    echo '<td>', $value->getEmail(), '</td>';
                    echo '<td>', $value->getEmailType(),'</td>';
                    echo '<td>', $value->getActive() == 1 ? 'Yes' : 'No' ,'</td>';
                    echo '<td>', $value->getLastUpdated(), '</td>';
                    echo '<td>', $value->getLogged(),'</td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="emailid" value="',$value->getEmailId(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="emailid" value="',$value->getEmailId(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
                    echo '</tr>' ;
                }
            }
        
        ?>
        
        
    </body>
</html>