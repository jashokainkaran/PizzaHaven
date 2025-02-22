<?php 
session_start();
include ("../src/includes/db.php");

//Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();

    //Checking whether the query was successful i.e the user exists
    if($result->num_rows > 0) {
        //Fetching the user's data
        $user = $result->fetch_assoc();

        //Verify the password
        if (password_verify($password, $user['password'])) {
            //If the password is correct, then we can start the session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];

            // Redirect to the cart if the user was sent from there
            $redirect = isset($_SESSION['redirect_after_login']) ? $_SESSION['redirect_after_login'] : '../public/index.php';
            unset($_SESSION['redirect_after_login']); // Clear the session variable
            header("Location: $redirect");
            exit();
        }
        else {
            echo "<script>
                    alert('Incorrect Password');
                    window.location.href = '../public/login_form.php';
                </script>";
            exit();
        } 

    } else{
        echo "<script>
                    alert('User Not Found');
                    window.location.href = '../public/login_form.php';
            </script>";
        exit();
    }
    $stmt->close();
    } else{
        echo "<script>
                alert('SQL Error'.$conn->error)
                window.location.href = '../public/login_form.php';
            </script>";
        exit();
        $stmt->close();
        $conn->close();
}


?>