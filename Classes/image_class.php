<?php 
class Image{
    public function generate_filename($length){
        //creating a random filename
        $num = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z' );
        $text = "";
        for ($i=0; $i<$length; $i++){
            $text.= $num[rand(0, 61)];
        }
        return $text;
    }
    public function resize_image($original_image_name, $cropped_image_name, $max_width, $max_height){
        if(file_exists($original_image_name)){
            $original_image = imagecreatefromjpeg($original_image_name);
            $original_width = imagesx($original_image);
            $original_height = imagesy($original_image);

            if($original_height > $original_width){
                //make width equal max width
                $ratio = $max_width/$original_width;
                $new_width = $max_width;
                $new_height= $original_height * $ratio;
        

        }else{
            //make height equal max height
            $ratio = $max_height/$original_height;
            $new_height = $max_height;
            $new_width = $original_width * $ratio;
        }
        //adjust in case diffrent max_width and height
        if($max_width != $max_height){
            if($max_height > $max_width){
                if($max_height > $new_height){$adjustment =($max_height/$new_height);}
                else{$adjustment =($new_height/$max_height);}
                $new_width = $new_width * $adjustment;
                $new_height = $new_height * $adjustment;
            }
           
            else{ if($max_width > $new_width){$adjustment =($max_width/$new_width);}
                else{$adjustment =($new_width/$max_width);}
                $new_width = $new_width * $adjustment;
                $new_height = $new_height * $adjustment;}
        }
        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
        imagedestroy($original_image);
        //cropping the image
        if($max_width =! $max_height){
            if($max_width > $max_height){
                $difference = ($new_height - $max_height);
                if($difference < 0){$difference = $difference * -1;}
                
                $y = round($difference/2);
                $x=0;
            }
            else{
                $difference = ($new_width - $max_height);
                if($difference < 0){$difference = $difference * -1;}
                $x = round($difference/2);
                $y=0;
            }
        }
        else{
             if($new_height > $new_width){
                 $difference = ($new_height - $new_width)/2;
                 $y = round($difference/2);
                 $x=0;
                }
            else{
                $difference = ($new_width - $new_height);
                $x = round($difference/2);
                $y=0;
            }}
            $new_cropped_image = imagecreatetruecolor($max_width, $max_height);
            imagecopyresampled($new_cropped_image, $new_image, 0, 0, $x, $y, $max_width, $max_height, $max_width, $max_height);
            imagedestroy($new_image);
            imagejpeg($new_image, $cropped_image_name, 90);
            imagedestroy($new_cropped_image);
    }
}
//this function actually resizes
public function crop_image($original_image_name, $resized_image_name, $max_width, $max_height){
    if(file_exists($original_image_name)){
        $original_image = imagecreatefromjpeg($original_image_name);
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        if($original_height > $original_width){
            //make width equal max width
            $ratio = $max_width/$original_width;
            $new_width = $max_width;
            $new_height= $original_height * $ratio;
    

    }else{
        //make height equal max height
        $ratio = $max_height/$original_height;
        $new_height = $max_height;
        $new_width = $original_width * $ratio;
    }
    //adjust in case diffrent max_width and height
    if($max_width != $max_height){
        if($max_height > $max_width){
            if($max_height > $new_height){$adjustment =($max_height/$new_height);}
            else{$adjustment =($new_height/$max_height);}
            $new_width = $new_width * $adjustment;
            $new_height = $new_height * $adjustment;
        }
       
        else{ if($max_width > $new_width){$adjustment =($max_width/$new_width);}
            else{$adjustment =($new_width/$max_width);}
            $new_width = $new_width * $adjustment;
            $new_height = $new_height * $adjustment;}
    }
    $new_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
    imagedestroy($original_image);
    //cropping the image
    
      
       
        imagejpeg($new_image, $resized_image_name, 90);
        imagedestroy($new_image);
}
}
//creating thumbnail for cover image
public function get_thumbnail($filename){
    $thumbnail = $filename.".thumbnail.jpg";
    if(file_exists($thumbnail)){
        return $thumbnail;
    }
    $this->resize_image($filename, $thumbnail, 1366, 488);
    if (file_exists($thumbnail)){
        return $thumbnail;
    }
    else{return $filename;}}
    
    
    
    public function get_thumbnail_profile($filename){
        $thumbnail = $filename.".thumbnail_profile.jpg";
        if(file_exists($thumbnail)){
            return $thumbnail;
        }
        $this->resize_image($filename, $thumbnail, 600, 600);
        if (file_exists($thumbnail)){
            return $thumbnail;
        }
        else{return $filename;}}
        public function get_thumbnail_post($filename){
            $thumbnail = $filename.".thumbnail_post.jpg";
            if(file_exists($thumbnail)){
                return $thumbnail;
            }
            $this->resize_image($filename, $thumbnail, 600, 600);
            if (file_exists($thumbnail)){
                return $thumbnail;
            }
            else{return $filename;}}} ?>

