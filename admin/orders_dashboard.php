<?php 
$pageTitle = 'Orders Dashboard';

include('../src/includes/admin_check.php');
include('../src/includes/header.php');
include('../src/includes/admin_navbar.php');
include('../src/includes/db.php'); // Database connection

// Check if a delete request was made when the page reloads
if (isset($_GET['delete_id'])) {
    $orderId = intval($_GET['delete_id']); // Convert to an integer

    // Ask for confirmation using JavaScript
    echo "<script>
        var confirmDelete = confirm('Are you sure you want to delete this item?');
        if (confirmDelete) {
            window.location.href = 'orders_dashboard.php?confirm_delete_id=$orderId';
        } else {
            window.location.href = 'orders_dashboard.php';
        }
    </script>";
    exit();
}

// Processing the confirmed delete request
if (isset($_GET['confirm_delete_id'])) {
    $orderId = intval($_GET['confirm_delete_id']); // Ensure it's an integer

    // Delete from related tables using a transaction
    $conn->begin_transaction();

    try {
        // Delete from order_items
        $stmt1 = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
        $stmt1->bind_param("i", $orderId);
        $stmt1->execute();
    
        // Check if rows were affected in order_items
        if ($stmt1->affected_rows === 0) {
            throw new Exception("No items found for the given Order ID.");
        }
    
        // Delete from orders
        $stmt2 = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt2->bind_param("i", $orderId);
        $stmt2->execute();
    
        // Check if rows were affected in orders
        if ($stmt2->affected_rows === 0) {
            throw new Exception("No order found with the given Order ID.");
        }
    
        // Commit the transaction if everything is successful
        $conn->commit();
    
        $_SESSION['message'] = "Order Removed Successfully";
        $_SESSION['message_type'] = "success";
    
        $stmt1->close();
        $stmt2->close();
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $conn->rollback();
        $_SESSION['message'] = "Error Removing Order: " . $e->getMessage();
        $_SESSION['message_type'] = "error";
    }
    
    // Redirect back to the orders dashboard
    header("Location: orders_dashboard.php");
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


<!-- Displaying orders -->
<div class="container mx-auto px-4 mt-3">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-secondary">Orders Table</h2>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <table class="w-full text-md sm:text-md text-center">
            <thead class="text-md sm:text-sm font-bold uppercase bg-gray-50 text-gray-500">
                <tr>
                    <th scope="col" class="px-4 sm:px-6 py-3">Order ID</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Customer Name</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Order Details</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Total Amount</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Status</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>

<!-- Fetch orders from database -->
<?php
$sqlOrders = "SELECT 
                    o.order_id, 
                    o.total_amount, 
                    o.status,
                    CONCAT(u.first_name, ' ', u.last_name) AS customer_name,
                    GROUP_CONCAT(CONCAT(m.item_name, ' (x', oi.quantity, ')') SEPARATOR '<br>') AS product_details
                FROM 
                    orders o
                JOIN 
                    users u ON o.user_id = u.user_id
                JOIN 
                    order_items oi ON o.order_id = oi.order_id
                JOIN 
                    menu m ON oi.product_id = m.item_id
                GROUP BY 
                    o.order_id, o.total_amount, o.status, customer_name
                ORDER BY 
                    o.order_id DESC;";


$resultOrders = $conn->query($sqlOrders);
if ($resultOrders->num_rows > 0){
    while($row = $resultOrders->fetch_assoc()) {
        $orderId = $row['order_id'];
        $orderCustomer = ucwords(strtolower($row['customer_name']));
        $orderDetails = $row['product_details'];
        $orderPrice = number_format($row['total_amount'], 2);
        $orderStatus = strtolower($row['status']);

        echo "<tr class='bg-white border-b'>";
        echo "<th scope='row' class='px-4 sm:px-6 py-4 font-bold whitespace-nowrap'>$orderId</th>";
        echo "<td class='px-4 sm:px-6 py-4'>$orderCustomer</td>";
        echo "<td class='px-4 sm:px-6 py-4'>$orderDetails</td>";
        echo "<td class='px-4 sm:px-6 py-4'>$orderPrice</td>";
        if ($orderStatus == 'pending'){
            echo"<td class='px-4 py-4 sm:px-6 text-secondary font-semibold'>Pending</td>";
        } else {
            echo"<td class='px-4 py-4 sm:px-6 text-green-600 font-semibold'>Completed</td>";
        }
        echo "<td class='px-4 sm:px-6 py-4'>
        <a href='javascript:void(0);' class='edit-order-btn font-medium text-blue-600 hover:underline' data-order-id='$orderId'>Edit</a>
        <a href='orders_dashboard.php?delete_id=$orderId' class='font-medium text-red-600 hover:underline ms-3'>Delete</a>
        </td>";
        echo"</tr>";
    } 
} else {
    echo "<tr><td colspan='7' class='text-center py-4 text-gray-500'>No Orders Found</td></tr>";
}
?>

</tbody>
        </table>
    </div>
</div>

<!-- Edit Order Status Modal -->
<div id="editOrderModal" class="fixed inset-0 bg-black bg-opacity-50  justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-md p-6 w-96">
        <h3 class="text-xl font-bold mb-4">Edit Order Status</h3>
        <form id="editOrderForm" method="POST" action="../process/edit_order_status.php">
            <input type="hidden" name="order_id" id="modalOrderId"> <?php echo $orderId ?>

            <div class="mb-4">
                <p class="font-semibold mb-2">Select Status:</p>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="status" value="pending" class="form-radio" required>
                    <span>Pending</span>
                </label>
                <label class="flex items-center space-x-2 mt-2">
                    <input type="radio" name="status" value="completed" class="form-radio" required>
                    <span>Completed</span>
                </label>
            </div>

            <div class="flex justify-end space-x-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
                <button type="button" id="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script src="../assets/js/edit_orders_modal.js"></script>
</body>
</html>