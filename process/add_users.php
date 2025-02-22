<?php 
session_start();

include('../src/includes/db.php');

//Checking if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['number'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    //Hashing the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, email, password, address, phone_number, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $hashed_password, $address, $phone_number, $role);

    if($stmt->execute()){
        $_SESSION['message'] = "User Added Successfully";
        $_SESSION['message_type'] = "success";

        header("Location: ../admin/users_dashboard.php");
    } else {
        $_SESSION['message'] = "Failed to Add User";
        $_SESSION['message_type'] = "error";

        header("Location: ../admin/add_forms/add_user_form.php");
        exit();
    }
    $stmt->close();
    $conn->close();
}
?>