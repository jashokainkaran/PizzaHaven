<?php 
session_start();
include('../src/includes/db.php');

// Ensure the request is a POST request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['message_type'] = "error";
    header("Location: ../admin/users_dashboard.php");
    exit();
}

// Get form data
$userId = intval($_POST['user_id']);
$userFirstName = trim($_POST['firstName']);
$userLastName = trim($_POST['lastName']);
$userEmail = trim($_POST['email']);
$userNumber = trim($_POST['number']);
$userAddress = trim($_POST['address']);


$sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, address= ?, phone_number = ? WHERE user_id =?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("sssssi", $userFirstName, $userLastName, $userEmail, $userAddress, $userNumber, $userId);

if($stmt->execute()){
    $_SESSION['message'] = "User updated successfully!";
    $_SESSION['message_type'] = "success";
} else {
    $_SESSION['message'] = "Error updating user: " . $stmt->error;
    $_SESSION['message_type'] = "error";
}

$stmt->close();
$conn->close();

//Redirect back to user dashboard
header("Location: ../admin/users_dashboard.php");
exit();
?>