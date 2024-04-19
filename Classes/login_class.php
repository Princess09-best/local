<?php

class Login {
    private $error = "";

    public function evaluate($data) {
        session_start(); // Start the PHP session

        $email = addslashes($data['email']);
        $password = addslashes($data['password']);

        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

        $DB = new Database();
        $result = $DB->read($query);
        if($result){
            $row = $result[0];
            if(password_verify($password, $row['password'])){
                $_SESSION['ashesigram_user_id'] = $row['user_id'];
            }
            else{
                $this->error .= "Wrong password<br>";}
        }else{
            $this->error .= "Email does not exist<br>";}
        return $this->error;

       /* if($result){
            $row = $result[0];
            if(password_verify($password, $row['password'])){
                $_SESSION['ashesigram_user_id'] = $row['user_id'];
            }
            else{$this->error = "Wrong password or email<br>";}
        }else{$this->error = "Wrong password or email<br>";}
        return $this->error;*/

        
    }



   private function hashed_password($text){
        //$text=hash("sha1",$text);
        return password_hash($text, PASSWORD_DEFAULT);
    }
   public function check_login($id){
        if( is_numeric($id))
         {
             $query = "SELECT user_id FROM users WHERE id = '$id'  LIMIT 1";

               $DB = new Database();
                $result = $DB->read($query);
            if($result){
                return true;
            }
            return false;
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

    }
    
}



?>