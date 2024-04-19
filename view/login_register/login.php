<?php
include("../../actions/signup_action.php");
include("../../actions/login_action.php");
?>
<!DOCTYPE HTML>
<html lang="en">
     <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ashesi Media</title>
        <link rel="stylesheet" href="../css/login_register.css">
        
     </head>
 <body>
<h2>AshesiGram- Connection on the Hill</h2>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form name="SignUp" action="../../actions/signup_action.php" method="post" >
           
			<h1><strong>Create Account</strong></h1>
			
			
			<input  name="first_name" type="text"  id="FirstName" placeholder="FirstName" pattern="[a-zA-Z0-9 ]+" title="FirstName must only contain letters, numbers, and spaces" required/>

			<input name="last_name" type="text" id="LastName" placeholder="LastName" pattern="[a-zA-Z0-9 ]+" title="LastName must only contain letters, numbers, and spaces" required/>
			
			<span>Gender: <br></span>
			<select name="gender" id="options">
				<option>Female</option>
				<option>Male</option>

			</select>
			<br>

			<input  name="email"type="email" id="Email" placeholder="Email"  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address" required />

			<input name="password" type="password" placeholder="Password" id="Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must be at least 8 characters long and contain at least one digit, one lowercase letter, and one uppercase letter" required />

			<!--<input name="password" type="password" placeholder="Retype Password" id="Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must be at least 8 characters long and contain at least one digit, one lowercase letter, and one uppercase letter" oninput="checkPasswordMatch(this)"required />-->
			
			<button type="submit" id="SignUp_button">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form name="sign_in_form" id="sign_in_form" action="../../actions/login_action.php" method="post" >
			<h1>Sign in</h1>
			<div class="social-container">
				Connect Easily with Peers
			</div>
			<span> use your account</span>
			<input name="email" value="<?php echo $email ?>" type="text" id="Email"placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address" required/>
			<input name="password" value="<?php echo $password ?>" type="password" id="Password"placeholder="Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must be at least 8 characters long and contain at least one digit, one lowercase letter, and one uppercase letter" required />
			<a href="#">Forgot your password?</a>
			<button  type="submit" name="_button" id="_button">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
        
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

<footer>
	<p>
		Created with <i class="fa fa-heart"></i> by
		<a target="_blank" href="https://florin-pop.com">Florin Pop</a>
		- Read how I created this and how you can join the challenge
		<a target="_blank" href="https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/">here</a>.
	</p>
</footer>
<script src="../js/login_register.js" crossorigin="anonymous"></script>
</body>
</html>
