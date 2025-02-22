<?php
session_start(); // Start the session

// Destroy all session data
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

//Get an alert
echo "<script>alert('Session Destroyed')</script>";

// Redirect to the homepage after logout
header("Location: ../public/index.php");
exit();
?>
