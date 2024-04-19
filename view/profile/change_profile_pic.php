<?php
session_start();

include("../../Classes/connection.php");
include("../../Classes/login_class.php");
include("../../Classes/user_class.php");
include("../../Classes/image_class.php");
include("../../Classes/post_class.php");


    $login = new Login();
   $userdata =$login->check_login($_SESSION['ashesigram_user_id']);

   
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_FILES['file']['type'] == 'image/jpeg'){
        $allowed_size = (1024*1024)*3;
        if($_FILES['file']['size'] < $allowed_size){
            //create folder for each user
            $folder = "uploads/" . $userdata['user_id'] . "/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
            }

             //create new image class , then crop given image
            $image = new Image();

            $filename= $folder.$image->generate_filename(15).".jpg";
            move_uploaded_file($_FILES['file']['tmp_name'], $filename);
            $change = "profile";
            //workng with the query string, check for change value
            if(isset($_GET['change'])){
                $change = $_GET['change'];
            }
           

            if($change == "cover")

            {   if(file_exists($userdata['cover_image'])){
                unlink($userdata['cover_image']);
                }
                // 1366, 488
                $image->crop_image($filename, $filename,1500,1500);
            }
            else{
                if(file_exists($userdata['profile_image'])){
                    unlink($userdata['profile_image']);
                    }
                $image->resize_image($filename, $filename, 800, 800);
            }
            
            
            if(file_exists($filename))
            {
              
                $userid = $userdata['user_id'];
              
               
                if($change=="cover"){               
                     $query = "UPDATE users SET cover_image = '$filename' WHERE user_id = '$userid ' LIMIT 1";
                     $_POST['is_cover'] = 1;
                    }else{$query = "UPDATE users SET profile_image = '$filename' WHERE user_id = '$userid ' LIMIT 1";
                        $_POST['is_profile'] = 1;}
                

                $DB = new Database();
                $DB->save($query);
            // creating a post
            $post = new Post();
            
            $post->create_post($userid, $_POST,$filename);
                header(("Location: profile_page.php"));
                die;
        }else{
            echo "Upload file of 3mb or lower";}
        }}else{
            echo "Please select an image";}}
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AshesiGram-Change Profile image</title>
        <link rel="stylesheet" href="../css/change_profile_image.css">
    </head>
   

     <body style="font-family: 'Montserrat', sans-serif; background-color:#d0d8e4">
        <!--top bar -->
        <?php include("../../header/header.php"); ?>
         <!--view area -->
         <div style="width: 800px;margin:auto; min-height:400px">

        </div>
        <!--below profile pic-->
        <div style="display: flex;">
            
            
        </div>
        
           <!--posts area-->
           <div style="min-height:400px;flex:2.5;padding-left:20px;">
           <!--upload profile picture-->
    <form method="post" enctype="multipart/form-data">
             <div style="border:solid thin #aaa; padding:10px; background-color:white; border-radius:10px; margin-top:20px">
            <input type="file" id="file" name="file" style="display:none">
            <input id="post-button" type="submit" value="Apply  Changes">
            <br>
        </div>
        <div style="text-align: center";>
        <br><br>
        <?php
        
        if(isset($_GET['change']) && $_GET['change'] == "cover"){
            $change = $_GET['cover'];
            echo "<img src='$userdata[cover_image]' style='max-width:500px;>";
        }else{
            $change = "profile";
            echo "<img src='$userdata[profile_image]' style='max-width:500px;>";
        }
        
        ?>
        </div>
    </form>
       
        <!--posts-->
        
    </div>
    </div>
  


     </body>
</html>