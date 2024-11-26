<?php
// Function to get user profile
function get_profile($conn, $id) {
    // Prepare the query to prevent SQL injection
    $query = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
    
    // Prepare the statement
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind the user ID parameter (assuming user_id is an integer)
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Execute the query
        mysqli_stmt_execute($stmt);
        
        // Get the result
        $result = mysqli_stmt_get_result($stmt);
        
        // Fetch the user data and return it
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null; // User not found
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle query preparation errors
        return null;
    }
}
?>
