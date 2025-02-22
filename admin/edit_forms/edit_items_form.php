<?php
session_start();
$pageTitle = "Update Item";
include('../../src/includes/header.php');
include('../../src/includes/db.php');

// Check if an item ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['message'] = "Invalid item ID.";
    $_SESSION['message_type'] = "error";
    header("Location: ../pizza_dashboard.php");
    exit();
}

$itemId = intval($_GET['id']); 

// Fetch item details
$sql = "SELECT * FROM menu WHERE item_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $itemId);
$stmt->execute();
$result = $stmt->get_result();

$item = $result->fetch_assoc();

$itemName = $item['item_name'];
$itemDescription = $item['item_description'];
$itemCategory = $item['category'];
$itemPrice = $item['price'];
$itemType = $item['type'];
$itemImage = htmlspecialchars($item['image_url']);

$stmt->close();
?>


<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl text-primary font-bold text-center mb-4">Edit Item</h2>
        
        <form action="../../process/update_items.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
            <!-- Hidden Input to Ensure Default Value Gets Posted -->
            <input type="hidden" name="item_type" value="<?php echo $itemType; ?>">

            <div class="mb-4">
                <label class="block text-gray-700">Item Name</label>
                <input type="text" name="itemName" value="<?php echo $itemName; ?>" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" required class="w-full px-3 py-2 border rounded-lg"><?php echo $itemDescription; ?></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Category</label>
                <input type="text" name="category" value="<?php echo $itemCategory; ?>" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Price</label>
                <input type="number" name="price" value="<?php echo $itemPrice; ?>" step="0.01" min="0" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Upload New Image</label>
                <input type="file" name="image" accept="image/jpeg, image/png" class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-3">Item Type</label>
                <div class="space-y-3">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" id="pizza_radio" name="item_type" value="pizza" <?php echo ($itemType === 'pizza') ? 'checked' : ''; ?> required class="form-radio text-primary h-5 w-5 border-gray-300">
                    <span class="ml-2 text-gray-800">Pizza</span>
                </label>

                <label class="flex items-center cursor-pointer">
                    <input type="radio" id="drink_radio" name="item_type" value="drink" <?php echo ($itemType === 'drink') ? 'checked' : ''; ?> required class="form-radio fill-primary h-5 w-5 border-gray-300">
                    <span class="ml-2 text-gray-800">Drink</span>
                </label>

                </div>
            </div>

            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg hover:bg-secondary">Update Item</button>
        </form>
    </div>
</body>
</html>
