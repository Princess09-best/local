<?php
session_start();
if(isset($_SESSION['ashesigram_user_id'])){
    $_SESSION['ashesigram_user_id'] = null;
    unset($_SESSION['ashesigram_user_id']);
}

header("Location: login.php");
die;
?>