<?php 
session_start();
include("../src/includes/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Hashing the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);
    
    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id; //stores the user's id after the record is created in the database
        $_SESSION['email'] = $email;

        echo "<script>
            alert('Registered Successfully')
            window.location.href = '../public/index.php.php';
            </script>'";
            
        exit();
    } else {
        echo "<script>
                alert('Error: $stmt->error');
                window.location.href = '../public/signup_form.php';
            </script>";
        
            exit();
    }

    $stmt->close();
    $conn->close();
}
?>