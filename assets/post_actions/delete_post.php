<?php


include("../../Classes/autoload.php");




    $login = new Login();
   $userdata =$login->check_login($_SESSION['ashesigram_user_id']);
   $ERROR = "";
   $Post= new Post();

   if(isset($_GET['id']))
   { 
      $ROW = $Post->get_single_post($_GET['id']);

      if(!$ROW){$ERROR = "No such post found ";}
       else{
           if($ROW['user_id'] != $_SESSION['ashesigram_user_id']){
               $ERROR = "Access denied! You can't delete this post";}
           }
   }
   else{$ERROR = "No such post was found";}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $result = $Post->delete_post($_POST['postid']);
   
        header("Location: ../../view/profile/profile_page.php");
        die;
    }
  
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AshesiGram | Delete</title>
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
            
            
        
           <!--posts area-->
           <div style="min-height:400px;flex:2.5;padding-left:20px;">
        <div style="border:solid thin #aaa; padding:10px; background-color:white; border-radius:10px; margin-top:20px">
        
            <form method="post">
            <?php 
             if($ERROR != ""){
                echo $ERROR;}else{
                    echo"Are you sure you want to delete this post?<br><br>";
                
                
                    $user = new User();
                    $ROW_USER = $user->get_user($ROW['user_id']);
                    include("../../view/profile/post_delete.php");

                    echo"<input id='postid' type='hidden' name='postid' value='$ROW[post_id]'>";
                   echo" <input id='post-button' type='submit' value='Delete'>";
                }
                
            


                ?>
                <br>
                
              <br>
        </div>

   </div>

    </div>
    </div>
  


     </body>
</html>