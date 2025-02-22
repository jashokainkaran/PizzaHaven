<?php
    $pageTitle = 'Add Items';
    include("../../src/includes/header.php"); 
?>

<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl text-primary font-bold text-center mb-4 " id="form-title">Add Items</h2>
        
        <form id="auth-form" action="../../process/add_items.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="form_type" id="form_type" value="add_items">
            
            <div class="mb-4">
                <label class="block text-gray-700">Item Name</label>
                <input type="textbox" name="itemName" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <input type="text" name="description" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Category</label>
                <input type="textbox" name="category" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Price</label>
                <input type="number" name="price" step="0.01" min="0" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-3">Item Type</label>
                <div class="space-y-3">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" id="pizza_radio" name="item_type" value="pizza" required class="form-radio text-primary h-5 w-5 border-gray-300">
                    <span class="ml-2 text-gray-800">Pizza</span>
                </label>

                <label class="flex items-center cursor-pointer">
                    <input type="radio" id="drink_radio" name="item_type" value="drink" required class="form-radio fill-primary h-5 w-5 border-gray-300">
                    <span class="ml-2 text-gray-800">Drink</span>
                </label>

                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Upload Image</label>
                <input type="file" name="image" accept="image/jpeg, image/jpg, image/png" max="10485760" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg">
                Add Item
            </button>
        </form>

    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>
