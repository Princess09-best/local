<?php

class SignUp {
    private $error = "";

    public function evaluate($data) {
        // Check to make sure form isn't empty
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $this->error .= $key . " is empty! <br>";
            }
            if($key=="email"){
                if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value)){
                    $this->error .= "Invalid email address! <br>";
                    
                }
            }
            if($key=="first_name"){
                if(is_numeric($value) ){
                    $this->error .= "Invalid first name! <br>";
                }
                if(strstr($value, " ")){
                    $this->error .= "Invalid first name! <br>";
                }
                
            }
            if($key=="last_name"){
                if(is_numeric($value) ){
                    $this->error .= "Invalid last name! <br>";
                }
                if(strstr($value, " ")){
                    $this->error .= "Invalid last name! <br>";
                }
                
            }
          
        }

        if ($this->error == "") {
            // No error
            $this->create_user($data);
        } else {
            return $this->error;
        }
    }

    public function create_user($data) {
        $first_name = ucfirst($data['first_name']);
        $last_name = ucfirst($data['last_name']);
        $email = addslashes($data['email']);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $gender = $data['gender'];
        $url_address = strtolower($first_name) . "." . strtolower($last_name);
        $user_id = $this->create_user_id();

        $query = "INSERT INTO users (user_id, first_name, last_name, gender, email,password, url_address) 
                  VALUES ('$user_id', '$first_name', '$last_name', '$gender', '$email', '$password', '$url_address')";

        $DB = new Database();
        $DB->save($query);

        
    }

    private function create_user_id() {
        $length = rand(4, 19);
        $num = "";
        for ($i = 0; $i < $length; $i++) {
            $num .= rand(0, 9);
        }
        return $num;
    }

}

?>