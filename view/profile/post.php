<link rel="stylesheet" href="../css/profile_page.css">
<div id="post">

<?php
$image="view/images/profilepic.jpg";
if ($ROW_USER['gender'] == "Male"){
    $image ="view/images/bobrisky.jpg"; }
    if (file_exists($ROW_USER['profile_image'] )){
        $image=$image_class->get_thumbnail_profile(file_exists($ROW_USER['profile_image']));}

    ?>

                <!--image-->
                <div><img src="<?php echo $image ?>" style="width: 75px;margin-right:4px; border-radius:30%" id="posts_images"></div>
                <!--post-->

                <div style="width:100%;">
                    <div id="posters_name" ><?php
                    
                    echo htmlspecialchars($ROW_USER['first_name'])." ".htmlspecialchars($ROW_USER['last_name'] );
                    if ($ROW['is_profile']){
                        $pronoun = "his";
                        if($ROW_USER['gender'] == "Female"){
                            $pronoun = "her";
                        }
                        echo"<span style ='font-weight:normal; color:#aaa'>updated $pronoun profile image</span> ";
                    }
                    if ($ROW['is_cover']){
                        $pronoun = "his";
                        if($ROW_USER['gender'] == "Female"){
                            $pronoun = "her";
                        }
                        echo"<span style ='font-weight:normal; color:#aaa'>updated $pronoun cover image</span> ";
                    }
                    
                    ?>

                

                </div>
                    <?php echo htmlspecialchars($ROW['post']); ?> 
                    <br><br>
                    <?php 
                    if(file_exists($ROW['image'])){
                       
                        $postimage = $image_class->get_thumbnail_post($ROW['image']);
                        echo "<img src='$postimage' style='width:80%;' >";
                    }
                    echo htmlspecialchars($ROW['post']); ?>
                    <br><br>
                    <a href="#">Like</a> .<a href="#"> Comment </a>.
                    <span style="color: #999">

                       <?php echo htmlspecialchars($ROW['date']) ?>
                    </span> 
                    <span style="color: #999;float:right;">
                    <?php
                        $post = new Post();


                       if($post->is_post_owner($ROW['post_id'],$_SESSION['ashesigram_user_id'])){
                           echo "
                           <a href='../../assets/post_actions/edit_post.php'>
                            Edit
                           </a> .
                           <a href='../../assets/post_actions/delete_post.php?id= $ROW[post_id] '>
                            Delete
                              </a> ";}


                         
                        ?>
                    </span> 
                </div>