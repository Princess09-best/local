<?php
#display error messages
session_start();
if (isset($_SESSION['error_message'])) {
    echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
    unset($_SESSION['error_message']); // Clear the error message after displaying
}

if (isset($_SESSION['success_message'])) {
    echo "<p style='color: green;'>" . $_SESSION['success_message'] . "</p>";
    unset($_SESSION['success_message']); // Clear the success message after displaying
}
?>
<!DOCTYPE HTML>
<html lang="en">
     <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ashesi Media</title>
        <link rel="stylesheet" href="../../assets/css/login_register.css">
        
     </head>
 <body>
<h2>AshesiGram- Connection on the Hill</h2>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form name="signUpForm" id="signUpForm" onsubmit="return validateForm()" action="../../actions/signup_action.php" method="post" >
           
			<h1><strong>Create Account</strong></h1>
			
			
			<input  name="firstname" type="text"  id="FirstName" placeholder="FirstName" pattern="[a-zA-Z0-9 ]+" title="FirstName must only contain letters, numbers, and spaces" required/>

			<input name="lastname" type="text" id="LastName" placeholder="LastName" pattern="[a-zA-Z0-9 ]+" title="LastName must only contain letters, numbers, and spaces" required/>
			
			<span>Gender: <br></span>
			<select name="gender" id="options">
				<option>Female</option>
				<option>Male</option>

			</select>
			<br>

			<input  name="email"type="email" id="Email" placeholder="Email"   required />

			<input name="password" type="password" placeholder="Password" id="Password"  required />

			<!--<input name="password" type="password" placeholder="Retype Password" id="Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must be at least 8 characters long and contain at least one digit, one lowercase letter, and one uppercase letter" oninput="checkPasswordMatch(this)"required />-->
			
			<button type="submit" id="SignUp_button">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form name="sign_in_form" id="sign_in_form" onsubmit ="return validateLoginForm()" action="../../actions/login_action.php" method="post" >
			<h1>Sign in</h1>
			<div class="social-container">
				Connect Easily with Peers
			</div>
			<span> use your account</span>
			<input name="email"  type="text" id="Email"placeholder="Email"  required/>
			<input name="password"  type="password" id="Password"placeholder="Password"   required />
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
<script>function validateForm() {
    // Access form elements
    const signUpForm = document.forms["signUpForm"];
    const firstName = signUpForm["firstname"].value.trim();
    const lastName = signUpForm["lastname"].value.trim();
    const email = signUpForm["email"].value.trim();
    const password = signUpForm["password"].value.trim();
    const gender = signUpForm["gender"].value;

    // Regular expression for @ashesi.edu.gh email validation
    const emailPattern = /^[a-zA-Z0-9._%+-]+@ashesi\.edu\.gh$/;

    // Name validation
    if (firstName === "") {
        alert("First name must not be empty.");
        return false;
    }

    if (lastName === "") {
        alert("Last name must not be empty.");
        return false;
    }

    // Email validation
    if (!emailPattern.test(email)) {
        alert("Email must be in the format 'example@ashesi.edu.gh'.");
        return false;
    }

    // Password validation
    if (password.length < 7) {
        alert("Password must be at least 7 characters long.");
        return false;
    }

    // Gender validation
    if (gender !== "Male" && gender !== "Female") {
        alert("Please select a valid gender.");
        return false;
    }

    // All validations passed
    return true;
}


function validateLoginForm() {
        const email = document.forms["signInForm"]["email"].value;
        const password = document.forms["signInForm"]["password"].value;

        // Email validation
        const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!email.match(emailPattern)) {
            alert("Please enter a valid email address.");
            return false;
        }

        // Password validation
        if (password == "") {
            alert("Password must not be empty.");
            return false;
        }

        // Password length check (optional)
        if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            return false;
        }

        // If everything is valid
        return true;
    }

</script>
<script src="../js/login_register.js" crossorigin="anonymous"></script>
</body>
</html>
