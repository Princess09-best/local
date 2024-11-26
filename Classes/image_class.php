<?php
// Function to generate a random filename
function generate_filename($length) {
    $num = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $text = "";
    for ($i=0; $i<$length; $i++) {
        $text .= $num[rand(0, 61)];
    }
    return $text;
}

// Function to resize an image
function resize_image($original_image_name, $cropped_image_name, $max_width, $max_height) {
    if(file_exists($original_image_name)) {
        $original_image = imagecreatefromjpeg($original_image_name);
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        if ($original_height > $original_width) {
            // Make width equal to max width
            $ratio = $max_width / $original_width;
            $new_width = $max_width;
            $new_height = $original_height * $ratio;
        } else {
            // Make height equal to max height
            $ratio = $max_height / $original_height;
            $new_height = $max_height;
            $new_width = $original_width * $ratio;
        }

        // Adjust in case of different max_width and max_height
        if ($max_width != $max_height) {
            if ($max_height > $max_width) {
                $adjustment = ($max_height > $new_height) ? ($max_height / $new_height) : ($new_height / $max_height);
            } else {
                $adjustment = ($max_width > $new_width) ? ($max_width / $new_width) : ($new_width / $max_width);
            }
            $new_width *= $adjustment;
            $new_height *= $adjustment;
        }

        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
        imagedestroy($original_image);

        // Cropping the image
        if ($max_width != $max_height) {
            if ($max_width > $max_height) {
                $difference = abs($new_height - $max_height);
                $y = round($difference / 2);
                $x = 0;
            } else {
                $difference = abs($new_width - $max_height);
                $x = round($difference / 2);
                $y = 0;
            }
        } else {
            if ($new_height > $new_width) {
                $difference = ($new_height - $new_width) / 2;
                $y = round($difference / 2);
                $x = 0;
            } else {
                $difference = ($new_width - $new_height);
                $x = round($difference / 2);
                $y = 0;
            }
        }

        $new_cropped_image = imagecreatetruecolor($max_width, $max_height);
        imagecopyresampled($new_cropped_image, $new_image, 0, 0, $x, $y, $max_width, $max_height, $max_width, $max_height);
        imagedestroy($new_image);

        imagejpeg($new_cropped_image, $cropped_image_name, 90);
        imagedestroy($new_cropped_image);
    }
}

// Function to crop an image
function crop_image($original_image_name, $resized_image_name, $max_width, $max_height) {
    if(file_exists($original_image_name)) {
        $original_image = imagecreatefromjpeg($original_image_name);
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        if ($original_height > $original_width) {
            // Make width equal to max width
            $ratio = $max_width / $original_width;
            $new_width = $max_width;
            $new_height = $original_height * $ratio;
        } else {
            // Make height equal to max height
            $ratio = $max_height / $original_height;
            $new_height = $max_height;
            $new_width = $original_width * $ratio;
        }

        // Adjust in case of different max_width and max_height
        if ($max_width != $max_height) {
            if ($max_height > $max_width) {
                $adjustment = ($max_height > $new_height) ? ($max_height / $new_height) : ($new_height / $max_height);
            } else {
                $adjustment = ($max_width > $new_width) ? ($max_width / $new_width) : ($new_width / $max_width);
            }
            $new_width *= $adjustment;
            $new_height *= $adjustment;
        }

        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
        imagedestroy($original_image);

        imagejpeg($new_image, $resized_image_name, 90);
        imagedestroy($new_image);
    }
}

// Function to create a thumbnail for cover image
function get_thumbnail($filename) {
    $thumbnail = $filename . ".thumbnail.jpg";
    if (file_exists($thumbnail)) {
        return $thumbnail;
    }
    resize_image($filename, $thumbnail, 1366, 488);
    return file_exists($thumbnail) ? $thumbnail : $filename;
}

// Function to create a thumbnail for profile image
function get_thumbnail_profile($filename) {
    $thumbnail = $filename . ".thumbnail_profile.jpg";
    if (file_exists($thumbnail)) {
        return $thumbnail;
    }
    resize_image($filename, $thumbnail, 600, 600);
    return file_exists($thumbnail) ? $thumbnail : $filename;
}

// Function to create a thumbnail for post image
function get_thumbnail_post($filename) {
    $thumbnail = $filename . ".thumbnail_post.jpg";
    if (file_exists($thumbnail)) {
        return $thumbnail;
    }
    resize_image($filename, $thumbnail, 600, 600);
    return file_exists($thumbnail) ? $thumbnail : $filename;
}
?>
