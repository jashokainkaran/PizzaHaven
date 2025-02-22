<?php
session_start();
include('../src/includes/db.php'); // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = intval($_POST['order_id']);
    $status = $_POST['status'];

    // Validate input
    if (!in_array($status, ['pending', 'completed'])) {
        $_SESSION['message'] = "Invalid status selected.";
        $_SESSION['message_type'] = "error";
        header("Location: ../admin/orders_dashboard.php");
        exit();
    }

    try {
        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $status, $orderId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "Order status updated successfully.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "No changes were made to the order status.";
            $_SESSION['message_type'] = "error";
        }
        $stmt->close();
    } catch (Exception $e) {
        $_SESSION['message'] = "Error updating order status: " . $e->getMessage();
        $_SESSION['message_type'] = "error";
    }

    // Redirect back to the orders dashboard
    header("Location: ../admin/orders_dashboard.php");
    exit();
}
?>
