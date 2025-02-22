<?php
$pageTitle = 'Orders';
include('../src/includes/header.php');
include('../src/includes/navbar.php');
include('../src/includes/db.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Please log in to view your orders.";
    $_SESSION['message_type'] = "error";
    header("Location: ../public/login.php");
    exit();
}
?>

<?php if (isset($_SESSION['message'])): ?>
                <p class="text-green-600 text-center font-bold mt-4" id="session-message"><?= $_SESSION['message']; ?></p>
                <?php unset($_SESSION['message']); ?>

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
            
<?php
$userId = $_SESSION['user_id'];

// Fetch orders for the logged-in user
$sqlOrders = "SELECT o.order_id, o.total_amount, o.status, 
              GROUP_CONCAT(CONCAT(m.item_name, ' (x', oi.quantity, ')') SEPARATOR '<br>') AS product_details
              FROM orders o
              JOIN order_items oi ON o.order_id = oi.order_id
              JOIN menu m ON oi.product_id = m.item_id
              WHERE o.user_id = ?
              GROUP BY o.order_id
              ORDER BY o.order_id DESC";


$stmt = $conn->prepare($sqlOrders);
$stmt->bind_param("i", $userId);
$stmt->execute();
$resultOrders = $stmt->get_result();
?>

<div class="container mx-auto px-4 mt-3">
    <h2 class="text-2xl font-bold text-secondary">Your Orders</h2>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 mt-4">
        <table class="w-full text-md text-center">
            <thead class="text-md font-bold uppercase bg-gray-50 text-gray-500">
                <tr>
                    <th class="px-4 py-3">Order ID</th>
                    <th class="px-4 py-3">Products & Quantities</th>
                    <th class="px-4 py-3">Total Price</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
    <?php
    if ($resultOrders->num_rows > 0) {
        while ($order = $resultOrders->fetch_assoc()) {
            $orderId = $order['order_id'];
            $orderPrice = number_format($order['total_amount'], 2);
            $orderDetails = $order['product_details'] ;
            $orderStatus = strtolower($order['status']);
            echo "<tr class='bg-white border-b'>";
            echo "<td class='px-4 py-4 font-bold'>{$orderId}</td>";
            echo "<td class='px-4 py-4'><div class='text-left'>{$orderDetails}</div></td>";
            echo "<td class='px-4 py-4'>Rs {$orderPrice}</td>";
            echo "<td class='px-4 py-4 font-bold " . ($orderStatus == 'completed' ? 'text-green-600' : 'text-yellow-600') . "'>"
                . ucfirst($orderStatus) .
                  "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4' class='text-center py-4 text-gray-500'>No orders found.</td></tr>";
    }
    ?>
</tbody>

        </table>
    </div>
</div>
<?php
include('../src/includes/footer.php');
?>