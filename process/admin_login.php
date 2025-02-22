<?php 
session_start();
include ("../src/includes/db.php");

//Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ? AND role = 'admin'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();

    //Checking whether the query was successful
    if($result->num_rows > 0) {
        //Fetching the user's data
        $admin = $result->fetch_assoc();

        //Verify the password
        if (password_verify($password, $admin['password'])) {
            //If the password is correct, then we can start the session
            $_SESSION['user_id'] = $admin['user_id'];
            $_SESSION['email'] = $admin['email'];
            $_SESSION['role'] = 'admin';

            header('Location: ../admin/admin_dashboard.php');
                
            exit();
        }
        else {
            echo "<script>
                    alert('Incorrect Password');
                    window.location.href = '../admin/admin_login_form.php';
                </script>";
            exit();
        } 

    } else{
        echo "<script>
                    alert('Access Denied');
                    window.location.href = '../admin/admin_login_form.php';
            </script>";
        exit();
    }
    $stmt->close();
    } else{
        echo "<script>
                alert('SQL Error'.$conn->error)
                window.location.href = '../admin/admin_login_form.php';
            </script>";
        exit();
        $stmt->close();
        $conn->close();
}


?>