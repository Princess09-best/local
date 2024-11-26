<?php
session_start();
include '../Classes/connection.php'; // Include database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare and execute the SQL query to fetch user data based on email
    $stmt = $conn->prepare("SELECT userid, firstname, lastname,gender, email,  password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); // Bind the email parameter
    $stmt->execute();
    $stmt->store_result();
    
    // Check if a user is found
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $firstName, $lastName, $dbEmail,$gender, $dbPassword );
        $stmt->fetch();

        // Verify the entered password against the stored hashed password
        if (password_verify($password, $dbPassword)) {
            // Check if the user role is valid (1 or 2)
          /*  if ($role > 2) {
                // Unauthorized role, redirect to signup
                $_SESSION['error_message'] = "You are unauthorized to access this page. Please sign up.";
                header("Location: ../views/SignUp.php");
                exit();
            }*/

            // Password is correct, start a session and store user information
            $_SESSION['userid'] = $id;
            $_SESSION['first_name'] = $firstName;
            $_SESSION['last_name'] = $lastName;
            $_SESSION['gender'] = $gender;

            header("Location: ../view/profile/profile_page.php");
            exit();

        } else {
            // Incorrect password
            $_SESSION['error_message'] = "Invalid credentials. Please try again.";
            header("Location: ../view/login_register/login.php");
            exit();
        }
    } else {
        // No user found with the given email
        $_SESSION['error_message'] = "No user found with that email address.";
        header("Location: ../view/login_register/login.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
