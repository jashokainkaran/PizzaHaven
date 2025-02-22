<?php
session_start();
include('../src/includes/db.php');

// Ensure the request is a POST request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['message_type'] = "error";
    header("Location: ../admin/pizza_dashboard.php");
    exit();
}

// Get form data
$itemId = intval($_POST['item_id']);
$itemName = trim($_POST['itemName']);
$description = trim($_POST['description']);
$category = trim($_POST['category']);
$price = floatval($_POST['price']);
$itemType = $_POST['item_type'];

$imageUrl = ""; // Initialize empty URL

// Check if a new image was uploaded
if (!empty($_FILES['image']['name'])) {
    $targetDir = "../assets/uploads/"; // Directory to store uploaded images
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . time() . "_" . $fileName; // Unique filename to prevent overwrites
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Validate image file type (only allow JPG, PNG)
    $allowedTypes = ['jpg', 'jpeg', 'png'];
    if (in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $imageUrl = $targetFilePath; // Save image path in database
        } else {
            $_SESSION['message'] = "Error uploading image.";
            $_SESSION['message_type'] = "error";
            header("Location: ../admin/admin_dashboard.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Invalid image format. Only JPG, JPEG and PNG are allowed.";
        $_SESSION['message_type'] = "error";
        header("Location: ../admin/admin_dashboard.php");
        exit();
    }
}

// Update the database (include image only if a new one was uploaded)
if (!empty($imageUrl)) {
    $sql = "UPDATE menu SET item_name = ?, item_description = ?, category = ?, price = ?, type = ?, image_url = ? WHERE item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsss", $itemName, $description, $category, $price, $itemType, $imageUrl, $itemId);
} else {
    $sql = "UPDATE menu SET item_name = ?, item_description = ?, category = ?, price = ?, type = ? WHERE item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdss", $itemName, $description, $category, $price, $itemType, $itemId);
}
if ($stmt->execute()) {
    $_SESSION['message'] = "Item Updated Successfully!";
    $_SESSION['message_type'] = "success";
} else {
    $_SESSION['message'] = "Error Updating Item: " . $stmt->error;
    $_SESSION['message_type'] = "error";
}

$stmt->close();
$conn->close();

// Redirect back to respective dashboards
if($itemType=='pizza'){
header("Location: ../admin/pizza_dashboard.php");
exit();
}else{
    header("Location: ../admin/drinks_dashboard.php");
    exit();
}
?>