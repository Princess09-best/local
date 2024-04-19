<div id="friends">
<?php
$image="view/images/profilepic.jpg";
if ($ROW_USER['gender'] == "Male"){
    $image ="view/images/bobrisky.jpg"; }
if (file_exists($FRIEND_ROW['profile_image'] )){
    $image=$image_class->get_thumbnail_profile(file_exists($FRIEND_ROW['profile_image']));}

    ?>
    <a href="profile_page.php?id=<?php echo $FRIEND_ROW['user_id'];?>">
                    <img id="friends_img" src="<?php echo $image?>">
                    <br>
                   <?php echo $FRIEND_ROW['first_name']." ".$FRIEND_ROW['last_name'] ?>
                </div>
    </a>