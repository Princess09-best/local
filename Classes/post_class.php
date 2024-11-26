<?php
include("../../Classes/database.php"); // Ensure your Database class is included for queries
include("../../Classes/image.php"); // Include your Image class for image processing

function create_post($user_id, $data, $files) {
    $error = "";

    if (!empty($data['postform']) || !empty($files['file']['name']) || isset($data['is_profile']) || isset($data['is_cover'])) {
        $myimage = "";
        $has_image = 0;
        $is_cover = 0;
        $is_profile = 0;

        if (isset($data['is_profile']) || isset($data['is_cover'])) {
            $myimage = $files;
            $has_image = 1;
            if (isset($data['is_profile'])) { $is_profile = 1; }
            if (isset($data['is_cover'])) { $is_cover = 1; }
        } else {
            if (!empty($files['file']['name'])) {
                $folder = "uploads/" . $user_id . "/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                    file_put_contents($folder . "index.php", "");
                }

                // Create new image class instance, then crop image
                $image_class = new Image();
                $myimage = $folder . $image_class->generate_filename(15) . ".jpg";
                move_uploaded_file($files['file']['tmp_name'], $myimage);
                $image_class->crop_image($myimage, $myimage, 1500, 1500);

                $has_image = 1;
            }
        }

        $post = isset($data['postform']) ? addslashes($data['postform']) : "";
        $post_id = create_post_id();

        $query = "INSERT INTO posts_db (post_id, user_id, post, image, has_image, is_profile, is_cover) 
                  VALUES ('$post_id', '$user_id', '$post', '$myimage', '$has_image', '$is_profile', '$is_cover')";
        
        $DB = new Database();
        $DB->save($query);
    } else {
        $error = "Please type something to post!<br>";
    }
    return $error;
}

function get_post($id) {
    $query = "SELECT * FROM posts_db WHERE user_id = '$id' ORDER BY id DESC LIMIT 10";
    $DB = new Database();
    $result = $DB->read($query);
    return $result ? $result : false;
}

function get_single_post($postid) {
    if (!is_numeric($postid)) { return false; }
    $query = "SELECT * FROM posts_db WHERE post_id = '$postid' LIMIT 1";
    $DB = new Database();
    $result = $DB->read($query);
    return $result ? $result[0] : false;
}

function delete_post($postid) {
    if (!is_numeric($postid)) { return false; }
    $query = "DELETE FROM posts_db WHERE post_id = '$postid' LIMIT 1";
    $DB = new Database();
    return $DB->save($query);
}

function is_post_owner($postid, $ashesigram_user_id) {
    if (!is_numeric($postid)) { return false; }
    $query = "SELECT * FROM posts_db WHERE post_id = '$postid' LIMIT 1";
    $DB = new Database();
    $result = $DB->read($query);
    return (is_array($result) && $result[0]['user_id'] == $ashesigram_user_id);
}

// Helper function to generate a random post ID
function create_post_id() {
    $length = rand(4, 19);
    $num = "";
    for ($i = 0; $i < $length; $i++) {
        $num .= rand(0, 9);
    }
    return $num;
}
?>
