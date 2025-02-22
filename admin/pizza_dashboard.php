<?php 
$pageTitle = 'Pizza Dashboard';

include('../src/includes/admin_check.php');
include('../src/includes/header.php');
include('../src/includes/admin_navbar.php');
include('../src/includes/db.php'); // Database connection

// Check if a delete request was made when the page reloads
if (isset($_GET['delete_id'])) {
    $itemId = intval($_GET['delete_id']); // Convert to an integer

    // Ask for confirmation using JavaScript
    echo "<script>
        var confirmDelete = confirm('Are you sure you want to delete this item?');
        if (confirmDelete) {
            window.location.href = 'pizza_dashboard.php?confirm_delete_id=$itemId';
        } else {
            window.location.href = 'pizza_dashboard.php';
        }
    </script>";
    exit();
}

// Processing the confirmed delete request
if (isset($_GET['confirm_delete_id'])) {
    $itemId = intval($_GET['confirm_delete_id']); // Ensure it's an integer

    // Delete from related tables using a transaction
    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("DELETE FROM menu WHERE item_id = ?");
        $stmt->bind_param("i", $itemId);
        $stmt->execute();
        
        // Check if the delete was successful
        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "Item Deleted Successfully";
            $_SESSION['message_type'] = "success";
            $conn->commit(); // Commit the deletion
        } else {
            throw new Exception("Error: Item ID not found in database.");
        }

        $stmt->close();
    } catch (Exception $e) {
        $conn->rollback(); // Undo the transaction if an error occurs
        $_SESSION['message'] = "Error deleting item: " . $e->getMessage();
        $_SESSION['message_type'] = "error";
    }

    // Redirect back to the pizza dashboard
    header("Location: pizza_dashboard.php");
    exit();
}
?>

<!-- Displaying success/error message -->
<?php if (isset($_SESSION['message'])): ?>
    <div id="session-message" class="text-center p-3 text-white 
        <?php echo $_SESSION['message_type'] === 'success' ? 'bg-green-500' : 'bg-red-500'; ?>">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']); // Remove message after displaying
            unset($_SESSION['message_type']); 
        ?>
    </div>

    <!-- JavaScript to remove message after 3 seconds -->
    <script>
        setTimeout(function() {
            var messageDiv = document.getElementById("session-message");
            if (messageDiv) {
                messageDiv.style.display = "none";
            }
        }, 3000);
    </script>
<?php endif; ?>


<div class="container mx-auto px-4 mt-3">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-secondary">Pizzas Table</h2>
        
        <a href="../admin/add_forms/add_items_form.php" class="bg-primary text-white px-6 py-2 mt-4 rounded-lg font-medium hover:bg-red-700">Add Pizza</a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <table class="w-full text-md sm:text-md text-center">
            <thead class="text-md sm:text-sm font-bold uppercase bg-gray-50 text-gray-500">
                <tr>
                    <th scope="col" class="px-4 sm:px-6 py-3">Product ID</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Product Image</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Product Name</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Description</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Category</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Price</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
<?php
// Fetching the data from the database
$sqlPizzas = "SELECT * FROM menu WHERE type = 'pizza'";
$resultPizzas = mysqli_query($conn, $sqlPizzas);

if ($resultPizzas->num_rows > 0) {
    while ($pizzaRow = $resultPizzas->fetch_assoc()) {
        $pizzaId = $pizzaRow['item_id'];
        $pizzaName = $pizzaRow['item_name'];
        $pizzaDescription = $pizzaRow['item_description'];
        $pizzaPrice = $pizzaRow['price'];
        $pizzaImage = htmlspecialchars($pizzaRow['image_url']);
        $pizzaCategory = $pizzaRow['category'];

        echo "<tr class='bg-white border-b'>";
        echo "<th scope='row' class='px-4 sm:px-6 py-4 font-bold whitespace-nowrap'>$pizzaId</th>";
        echo "<td class='px-4 sm:px-6 py-4'><img src='$pizzaImage' alt='$pizzaName' class='w-20 h-20 object-cover rounded'></td>";
        echo "<td class='px-4 sm:px-6 py-4'>$pizzaName</td>";
        echo "<td class='px-4 sm:px-6 py-4'>$pizzaDescription</td>";
        echo "<td class='px-4 sm:px-6 py-4'>$pizzaCategory</td>";
        echo "<td class='px-4 sm:px-6 py-4'>Rs $pizzaPrice</td>";
        echo "<td class='px-4 sm:px-6 py-4'>
                <a href='./edit_forms/edit_items_form.php?id=$pizzaId' class='font-medium text-blue-600 hover:underline'>Edit</a>
                <a href='pizza_dashboard.php?delete_id=$pizzaId' class='font-medium text-red-600 hover:underline ms-3'>Delete</a>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center py-4 text-gray-500'>No Pizzas Found</td></tr>";
}
?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
