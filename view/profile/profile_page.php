<?php 
session_start();


//check if user is logged in
//session_start();

/*

// Check if user is logged in
if (isset($_SESSION['ashesigram_user_id']) && is_numeric($_SESSION['ashesigram_user_id'])) {
    $id = $_SESSION['ashesigram_user_id'];
    $login = new Login();
    $result = $login->check_login($id);

    if ($result) {
        // User is logged in, continue with profile page content
        $user = new User();
        $user_data = $user->get_data($id);

        if (!$user_data) {
            // Handle case where user data is not found
            header("Location: ../login_register/login.php");
            exit;
        }

        // Add your profile page content here
        echo "Welcome to your profile page!";
    } else {
        // Handle case where login check fails
        header("Location: ../login_register/login.php");
        exit;
    }
} else {
    // User is not logged in, redirect to the login page
    header("Location: ../login_register/login.php");
    exit;
}*/

include("../../Classes/autoload.php");
    $login = new Login();
   $userdata =$login->check_login($_SESSION['ashesigram_user_id']);
   $USER = $userdata;
   $profile= new Profile();
   $profile_data = "";
   if(isset($_GET['id']) && is_numeric($_GET['id']))//whitelisting on id
   {
       $profile_data = $profile->get_profile($_GET['id']);
}
   
   if(is_array($profile_data)){
       $userdata = $profile_data[0];}
    //for posting
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include("../../Classes/post_class.php");
        $post = new Post();
        $id = $_SESSION['ashesigram_user_id'];
        $result = $post->create_post($id, $_POST,$_FILES);
        if($result == ""){
            header("Location: profile_page.php");
            die;
        }else{
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "<br>The following errors occurred: <br><br>";
        echo $result;
        echo "</div>";
        
    }}
    //collect posts
    $post = new Post();
    $id = $userdata['user_id'];
    $posts =$post->get_post($id);

    //collect friends
    $user = new User();
    $id = $_SESSION['ashesigram_user_id'];
    $friends = $user->get_friends($id);
    $image_class = new Image(); 

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AshesiGram-Profile</title>
        <link rel="stylesheet" href="../css/profile_page.css">
    </head>
   

     <body style="font-family: 'Montserrat', sans-serif; background-color:#d0d8e4">
        <!--top bar -->
        <br>
        <?php include("../../header/header.php"); ?>
         <!--view area -->
         <div style="width: 800px;margin:auto; min-height:400px">
        <div style="background-color:white;text-align: center; color:#5d1111;"">
        <!--cover pic-->
           <?php 
            $image = "../images/cover_image.jpg";
            if(file_exists($userdata['cover_image'])){
                $image = $image_class->get_thumbnail($userdata['cover_image']);
            }?>
            <img src="<?php echo $image ?>" style="width:100%;height:300px;">
            <!--profile pic-->
            <span style="font-size:11px">
            <?php 
            $image = "../images/user_male.jpg";
            if($userdata['female']){$image = "../images/user_female.jpg";}
            if(file_exists($userdata['profile_image'])){
                $image =  $image_class->get_thumbnail($userdata['profile_image']);
            }?>
            <img src="<?php echo $image ?>" id="profilepic"><br>
            <a style="text-decoration:none;color: white" href="change_profile_pic.php?change=profile">Change Picture</a> |
            <a style="text-decoration:none;color: white" href="change_profile_pic.php?change=cover">Change cover pic</a>
        
        </span><br>

            <br>
           <div style="font-size:20px;"><?php echo $userdata['first_name']." ".$userdata['last_name'] ?></div> 
            <br>
            <a href="../../index.php"><div id="menu">Timeline </div> </a>
            
            <div id="menu">About</div>
            <div id="menu">Friends</div> 
            <div id="menu">Photos</div>
            <div id="menu">Settings</div> 
        </div>
        </div>
        <!--below profile pic-->
        <div style="display: flex;">
            <!--friends Area-->
            <div style="min-height:400px; flex:1;" >
            <div id="friends_bar">Friends<br>
            <?php
            if ($friends){
                foreach($friends as $FRIEND_ROW){
                    
                    include("user1.php");
                }
            }

           
            ?>
                
                
            </div>
        </div>
        
           <!--posts area-->
           <div style="min-height:400px;flex:2.5;padding-left:20px;">
        <div style="border:solid thin #aaa; padding:10px; background-color:white; border-radius:10px; margin-top:20px">
        <form name="postform"  enctype="multipart/form-data" action="" method="post">
            <textarea placeholder="What do you want to say to the Ashesi Community today?"></textarea>
            <input id=file" type="file" value="Post">
            <input id="post-button" type="submit" value="Post">
            <br>
            </form>
        </div>
        <!--posts-->
        <div id="post_bar">
            <?php
            if ($posts){
                foreach($posts as $ROW){
                    $user = new User();
                    $ROW_USER = $user->get_data($ROW['user_id']);
                    include("post.php");
                }
            }

           
            ?>
            <!--post1-->
           
            </div>

        </div>
    </div>
    </div>
  


     </body>
</html>