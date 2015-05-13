<?php namespace demo; include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
             

            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
                              
            // get values from URL
            $phonetypeid = filter_input(INPUT_GET, 'phonetypeid');
            
            if ( NULL !== $phonetypeid ) {
               $phoneTypeDAO = new PhoneTypeDAO($db);
               
               if ( $phoneTypeDAO->delete($phonetypeid) ) {
                   echo 'Phone Type was deleted';                  
               }                
        
            }
            
            
             echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Go back</a></p>';
        
        ?>
    </body>
</html>
