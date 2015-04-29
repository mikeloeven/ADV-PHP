<?php namespace demo; include 'bootstrap.php'; ?>
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
       
        $util = new Util();
        $validator = new Validator();
        $phoneTypeDAO = new PhoneTypeDAO($db);
        $phonetypeModel = new PhoneTypeModel();
         
        if ( $util->isPostRequest() ) {
            
            $phonetypeModel->map(filter_input_array(INPUT_POST));
                       
        } else {
            $phonetypeid = filter_input(INPUT_GET, 'phonetypeid');
            $phonetypeModel = $phoneTypeDAO->getById($phonetypeid);
        }
        
        
        $phonetypeid = $phonetypeModel->getPhonetypeid();
        $phoneType = $phonetypeModel->getPhonetype();
        $active = $phonetypeModel->getActive();  
              
        
        $phoneTypeService = new PhoneTypeService($db, $util, $validator, $phoneTypeDAO, $phonetypeModel);
        
        if ( $phoneTypeDAO->idExisit($phonetypeModel->getPhonetypeid()) ) {
            $phoneTypeService->saveForm();
        }
        
        
        ?>
        
        
         <h3>UPDATE phone type</h3>
        <form action="#" method="post">
             <input type="hidden" name="phonetypeid" value="<?php echo $phonetypeid; ?>" />
            <label>Phone Type:</label> 
            <input type="text" name="phonetype" value="<?php echo $phoneType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
         
         <?php         
             $phoneTypeService->displayPhonesActions();
                          
         ?>
                  
    </body>
</html>
