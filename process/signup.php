<?php 
session_start();
include("../src/includes/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['number'];
    $address = $_POST['address'];

    //Hashing the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $checkQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Email Already Exists');
                window.location.href = '../public/signup_form.php';
            </script>";
        
            exit();
    } else {
    $sql = "INSERT INTO users (first_name, last_name, email, password, address, phone_number) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $hashed_password, $address, $phone_number);
    
    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id; //stores the user's id after the record is created in the database
        $_SESSION['email'] = $email;

        echo "<script>
            alert('Registered Successfully')
            window.location.href = '../public/index.php';
            </script>'";
            
        exit();
    } else {
        echo "<script>
                alert('Error: $stmt->error');
                window.location.href = '../public/signup_form.php';
            </script>";
        
            exit();
    }
}

    $stmt->close();
    $conn->close();
}
?>