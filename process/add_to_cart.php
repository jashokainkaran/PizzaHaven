<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productImage = $_POST['product_image'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += 1;
        $_SESSION['message'] = "$productName Quantity Updated!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['cart'][$productId] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'image' => $productImage,
            'quantity' => 1
        ];
        $_SESSION['message'] = "Item Added to Cart!";
        $_SESSION['message_type'] = "success";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
