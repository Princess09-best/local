<?php
$servername = "localhost"; //  database server
$username = "root"; //  database username
$password = ""; //  database password
$dbname = "ashesigram_db"; //  database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>