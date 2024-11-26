<?php
session_start();
include '../Classes/connection.php'; // Include database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $firstName = trim($_POST['firstname']);
    $lastName = trim($_POST['lastname']);
    $gender = trim($_POST['gender']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
   

    

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error_message'] = "Email is already taken. Please use a different one.";
        header("Location: ../view/login_register/login.php");
        exit();
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, gender, email, password, created_at) VALUES (?, ?, ?,  ?, ?, NOW())");
    $stmt->bind_param("sssss", $firstName, $lastName, $gender, $email, $hashedPassword);

    if ($stmt->execute()) {
        // User successfully registered, redirect to login page
        $_SESSION['success_message'] = "Registration successful! You can now log in.";
        header("Location: ../view/login_register/login.php");
        exit();
    } else {
        // If there was an error, display it
        $_SESSION['error_message'] = "There was an error during registration. Please try again.";
        header("Location: ../view/login_register/login.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
