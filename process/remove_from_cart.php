<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['item_key'])) {
        $itemKey = $_POST['item_key'];

        if (isset($_SESSION['cart'][$itemKey])) {
            if ($_SESSION['cart'][$itemKey]['quantity'] > 1) {
                // If quantity is more than 1, reduce by 1
                $_SESSION['cart'][$itemKey]['quantity'] -= 1;
                $_SESSION['message'] = "Item Removed from Cart!";
                $_SESSION['message_type'] = "success";
            } else {
                // If quantity is 1, set it to 0 (or remove the item if preferred)
                unset($_SESSION['cart'][$itemKey]);
                
                $_SESSION['message'] = "Item Removed from Cart!";
                $_SESSION['message_type'] = "success";
            }
        } else {
            $_SESSION['message'] = "Item not found in cart!";
            $_SESSION['message_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Invalid request!";
        $_SESSION['message_type'] = "error";
    }
} else {
    $_SESSION['message'] = "Invalid request method!";
    $_SESSION['message_type'] = "error";
}

header("Location: ../public/cart.php");
exit();
