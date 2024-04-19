<?php
Class Profile{
    public function get_profile($id){
        //eescaping special characters on id to prevent sql injection
        $id = addslashes($id);
        $DB = new Database();
        $query="SELECT * FROM users WHERE user_id = '$id' limit 1";
        return $DB->read($query);
        
    }
}
?>