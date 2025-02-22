<?php 
session_start();

include('../src/includes/db.php');

//Checking if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $item_name = $_POST['itemName'];
    $item_description = $_POST['description'];
    $item_category = $_POST['category'];
    $item_price = $_POST['price'];
    $item_type = $_POST['item_type'];

    $imageUrl = ""; // Initialize empty URL
    // Check if a new image was uploaded
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../assets/uploads/"; // Directory to store uploaded images
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . uniqid() . "_" . $fileName; // Unique filename to prevent overwrites
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

    $sql = "INSERT INTO menu (item_name, item_description, price, category, type, image_url) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $item_name, $item_description,  $item_price, $item_category, $item_type, $imageUrl);

    if($stmt->execute()){
        $_SESSION['message'] = "Item Added Successfully";
        $_SESSION['message_type'] = "success";
        if($item_type == 'pizza'){
        header("Location: ../admin/pizza_dashboard.php");
        } else {
            header("Location: ../admin/drinks_dashboard.php");
        }
    } else {
        $_SESSION['message'] = "Failed to Add Item";
        $_SESSION['message_type'] = "error";

        header("Location: ../admin/add_forms/add_items_form.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
}
?>