<?php


    

    

   
    function checklogin_core(){
        if(!isset($_SESSION['user_id'])){
            header("Location: ../views/SignIn.php");
            exit();
        }
    }
    /*public function check_login($id){
        if( is_numeric($id))
         {
             $query = "SELECT user_id FROM users WHERE id = '$id'  LIMIT 1";

               $DB = new Database();
                $result = $DB->read($query);

               
            if ($result){
                $userdata=$result[0];
               return $userdata; 
            }
            return false;

            //else{ header("Location: ../profile/profile_page.php");
            //die;}
                
              
    }else{
        header("Location: ../login_register/login.php");
        die;
    }*/

    
    




?>