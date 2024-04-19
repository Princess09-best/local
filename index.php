<?php


include("Classes/autoload.php");



    $login = new Login();
   $userdata =$login->check_login($_SESSION['ashesigram_user_id']);
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AshesiGram-Profile</title>
        <link rel="stylesheet" href="../css/timeline.css">
    </head>
   

     <body style="font-family: 'Montserrat', sans-serif; background-color:#d0d8e4">
        <!--top bar -->
        <?php include("../../header/header.php"); ?>
         <!--view area -->
         <div style="width: 800px;margin:auto; min-height:400px">

        </div>
        <!--below profile pic-->
        <div style="display: flex;">
            <!--friends Area-->
            <div style="min-height:400px; flex:1;" >
            <div id="friends_bar">
                <img src="../images/profilepic.jpg" id="profilepic"><br>
                <a href="view/profile/profile_page.php" style="text-decoration:none"><?php echo $userdata['first_name'] ." <br>". $userdata['last_name']?></a>
            </div>
        </div>
        
           <!--posts area-->
           <div style="min-height:400px;flex:2.5;padding-left:20px;">
        <div style="border:solid thin #aaa; padding:10px; background-color:white; border-radius:10px; margin-top:20px">
            <textarea placeholder="What do you want to say to the Ashesi Community today?"></textarea>
            <input id="post-button" type="submit" value="Post">
            <br>
        </div>
        <!--posts-->
        <div id="post_bar">
            <!--post1-->
            <div id="post">
                <!--image-->
                <div><img src="../images/search.png" style="width: 75px;" id="posts_images"></div>
                <!--post-->

                <div>
                    <div id="posters_name">Chelsea</div>
                    dummytext dummytext
                    <br><br>
                    <a href="#">Like</a> .<a href="#"> Comment </a>. <span style="color: #999">11/06/24</span> 
                </div>
            </div>
            <!--post2-->
            <div id="post">
                <!--image-->
                <div><img src="../images/search.png" style="width: 75px;" id="posts_images"></div>
                <!--post-->

                <div>
                    <div id="posters_name">Chelsea</div>
                    dummytext dummytext
                    <br><br>
                    <a href="#">Like</a> .<a href="#"> Comment </a>. <span style="color: #999">11/06/24</span> 
                </div>
            </div>
<!--post3-->
            <div id="post">
                <!--image-->
                <div><img src="../images/search.png" style="width: 75px;" id="posts_images"></div>
                <!--post-->

                <div>
                    <div id="posters_name">Chelsea</div>
                    dummytext dummytext
                    <br><br>
                    <a href="#">Like</a> .<a href="#"> Comment </a>. <span style="color: #999">11/06/24</span> 
                </div>
            </div>

        </div>
    </div>
    </div>
  


     </body>
</html>