<?php 
class Post{
    private $error = "";

    public function create_post($user_id, $data,$files){                 

        if(!empty($data['postform']) || !empty($files['file']['name']) ||isset($data['is_profile']) || isset( $data['is_cover']) ){
            $myimage="";
            $has_image=0;
            $is_cover=0;
            $is_profile=0;
            if(isset($data['is_profile']) || isset( $data['is_cover'])){
                $myimage= $files;
                $has_image=1;
                if(isset($data['is_profile'])){$is_profile=1;}
                if(isset($data['is_cover'])){$is_cover=1;}
                

            }
            else{
            
                 if(!empty($files['file']['name'])){

                     $folder = "uploads/" . $user_id . "/";
                     if(!file_exists($folder)){
                         mkdir($folder,0777,true);
                         file_put_contents($folder . "index.php","");
                     }
                 
                      //create new image class , then crop given image
                     $image_class = new Image();
                 
                     $myimage= $folder.$image_class->generate_filename(15).".jpg";
                     move_uploaded_file($_FILES['file']['tmp_name'], $myimage);
                     $image_class->crop_image($myimage, $myimage,1500,1500);
                 
                     $has_image=1;
                 
                 }
        }
             $psot="";
            if(isset($data['postform']))
             $post = addslashes($data['postform']);
             $post_id = $this->create_post_id();

                $query = "INSERT INTO posts_db (post_id, user_id, post,image,has_image,is_profile,is_cover) 
                        VALUES ('$post_id', '$user_id', '$post','$myimage', '$has_image','$is_profile','$is_cover')";
                $DB = new Database();
                $DB->save($query);
        }else{
            $this->error = "Please type something to post!<br>";
        }
        return $this->error;
    }
    //get posts
    public function get_post($id){
        $query = "SELECT * FROM posts_db WHERE user_id = '$id' ORDER BY id DESC limit 10";
        $DB = new Database();
        $result = $DB->read($query);
        if($result){
            return $result;
        }else{
            return false;
        }

    }

    public function get_single_post($postid){
        if(!is_numeric($postid)){return false;}
        $query = "SELECT * FROM posts_db WHERE post_id = '$postid'  limit 1";
        $DB = new Database();
        $result = $DB->read($query);
        if($result){
            return $result[0];
        }else{
            return false;
        }

    }
    private function create_post_id() {
        $length = rand(4, 19);
        $num = "";
        for ($i = 0; $i < $length; $i++) {
            $num .= rand(0, 9);
        }
        return $num;
    }
//delete post
    public function delete_post($postid){
        if(!is_numeric($postid)){return false;}
        $query = "DELETE FROM posts_db WHERE post_id = '$postid'  limit 1";
        $DB = new Database();
        $result = $DB->save($query);
        
    }
    public function is_post_owner($postid,$ashesigram_user_id){
        if(!is_numeric($postid)){return false;}
        $query = "SELECT * FROM posts_db WHERE post_id = '$postid'  limit 1";
        $DB = new Database();
        $result = $DB->read($query);
        if(is_array($result)){
            if($result[0]['user_id'] == $ashesigram_user_id){
                return true;
            }
        }
        return false;
        
    }

} ?>