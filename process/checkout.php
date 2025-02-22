<?php
session_start();
include("../src/includes/db.php");

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    // Store the current page to redirect back to after login
    $_SESSION['redirect_after_login'] = '../public/cart.php';
    header("Location: ../public/login_form.php"); // Redirect to login page
    exit();
}

// If user is logged in, proceed to checkout
if (isset($_SESSION['user_id'])) {
    // Check if the cart is not empty
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $userId = $_SESSION['user_id'];
        $totalPrice = intval($_SESSION['total_price']);
        // Start transaction for order insertion
        $conn->begin_transaction();
        
        try {
            // Insert order into orders table
            $stmt = $conn->prepare("INSERT INTO orders (user_id, order_date, total_amount) VALUES (?, NOW(), ?)");
            $stmt->bind_param("id", $userId, $totalPrice);
            $stmt->execute();
            $orderId = $stmt->insert_id; // Get the inserted order ID

            // Insert items from the cart into the order_items table
            foreach ($_SESSION['cart'] as $itemKey => $item) {
                $itemId = $item['id']; // Assuming 'id' is the item ID in the cart
                $quantity = $item['quantity'];
                $price = $item['price']; // Assuming 'price' is the item price
                
                $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiid", $orderId, $itemId, $quantity, $price);
                $stmt->execute();
            }

            // Commit the transaction if everything is successful
            $conn->commit();

            // Clear the cart after order has been placed
            unset($_SESSION['cart']);

            // Set a success message
            $_SESSION['message'] = "Your order has been placed successfully!";
            $_SESSION['message_type'] = "success";

            // Redirect to orders page
            header("Location: ../public/orders.php");
            exit();
        } catch (Exception $e) {
            // Rollback the transaction if there's an error
            $conn->rollback();
            
            $_SESSION['message'] = " ERROR: " . $e->getMessage();
            $_SESSION['message_type'] = "error";
            header("Location: ../public/cart.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Your cart is empty!";
        $_SESSION['message_type'] = "error";
        header("Location: ../public/cart.php");
        exit();
    }
}
?>
