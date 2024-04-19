
<?php
	include("../Classes/connection.php");
	include("../Classes/signup_class.php");
 



if($_SERVER['REQUEST_METHOD']=='POST'){
	$signup = new SignUp();
	$result = $signup->evaluate($_POST);
	if($result != ""){
		echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
	echo "<br>the following errors occured: <br><br>";
	echo "result";
	echo "</div>";
    }
	else{
		
	header("Location: ../view/login_register/login.php");
	die;
       }
	   $first_name = $_POST["first_name"];

       $last_name = $_POST["last_name"];
       $gender = $_POST["gender"];
       $email = $_POST["email"];


}

?>