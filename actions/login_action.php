<?php

session_start();
include('../Classes/connection.php');
include('../Classes/login_class.php');



$email="";
$password="";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = new Login();
    $result = $login->evaluate($_POST);

    if ($result != "") {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "<br>The following errors occurred: <br><br>";
        echo $result;
        echo "</div>";
        
    }else{
        header("Location: ../view/profile/profile_page.php");
        die;
    }
    $email=$_POST['email'];
    $password = $_POST['password'];
}
?>