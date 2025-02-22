<?php 
session_start();

// Check if the user is logged in and if the user has admin privileges
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Redirect to the admin login page if not logged in or not an admin
    header("Location: ../admin/admin_login_form.php");
    exit();
}
?>
