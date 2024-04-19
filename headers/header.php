<?php 
$corner_image = "../view/images/user_female.jpg";

    if(isset($USER)){
        if(file_exists($USER['profile_image']))

        {
            $image_class = new Image();
            $corner_image=$image_class->get_thumbnail_profile($USER['profile_image']);
        }else{if($USER['gender']=='Male'){
            $corner_image = "../view/images/user_male.jpg";}
        }

    }
    

?>

<div id="red_bar">
            <div style="width: 800px; margin:auto;font-size:30px;"><a href="../../index.php" style="color: white;text-decoration:none">AshesiGram</a> &nbsp &nbsp <input type="text" id="searchbox" placeholder="Search for people" >
            
            <a href="../view/profile/profile_page.php"><img src="<?php echo $corner_image?>" style="width:50px;float:right"></a>
            <a href="../login_register/logout.php">
            <span style="font-size:11px;float:right;margin:10px;color:white">Logout</span>
            </a>
            </div>
            
        </div>