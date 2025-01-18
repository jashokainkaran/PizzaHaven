<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../admin/admin_login_form.php");
    exit();
}
?>
<?php 
include('../src/includes/header.php');
 include('../src/includes/admin_navbar.php');
?>