
<?php
 $pageTitle = 'Admin Dashboard';
 include('../src/includes/admin_check.php');
 include('../src/includes/header.php');
 include('../src/includes/admin_navbar.php');
include('../src/includes/db.php');

//Getting the total number of items in the menu
$sqlItems = "SELECT COUNT(*) AS total_items FROM menu";
$resultItems = $conn->query($sqlItems);
if ($resultItems) {
    $item = $resultItems->fetch_assoc();
    $totalItems = $item['total_items'];
} else {
    $totalItems = 'Error connecting to database';
}

//Gettting the total number of orders from the orders table
$sqlOrders = "SELECT COUNT(*) AS total_orders FROM orders";
$resultOrders = $conn->query($sqlOrders);
if ($resultOrders) {
    $order = $resultOrders->fetch_assoc();
    $totalOrders = $order['total_orders'];
} else{
    $totalOrders = 'Error connecting to database';
}

//Getting the toal number of users in the menu
$sqlUsers = "SELECT COUNT(*) AS total_users FROM users WHERE role = 'user'";
$resultUsers = $conn->query($sqlUsers);

if ($resultUsers) {
    $user = $resultUsers->fetch_assoc();
    $totalUsers = $user['total_users'];
} else {
    $totalUsers = 'Error connecting to database';
}

?>

<h1 class="text-3xl font-bold text-gray-700 mb-4 mt-5 ml-3">Admin Dashboard</h1>

<!-- Overview Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h2 class="text-xl font-semibold">Total Items</h2>
        <p class="text-3xl font-bold text-primary"><?php echo $totalItems; ?></p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h2 class="text-xl font-semibold">Total Orders</h2>
        <p class="text-3xl font-bold text-primary"><?php echo $totalOrders ?></p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h2 class="text-xl font-semibold">Total Users</h2>
        <p class="text-3xl font-bold text-primary"><?php echo $totalUsers ?></p>
    </div>
</div>

<!-- Recent Activity -->
<div class="mt-8 bg-white p-6 rounded-lg shadow-md overflow-x-auto">
    <h2 class="text-xl font-semibold mb-4">Recent Orders</h2>
    <table class="w-full border-collapse border border-gray-300 min-w-[400px]">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Order ID</th>
                <th class="border px-4 py-2">Customer</th>
                <th class="border px-4 py-2">Total</th>
                <th class="border px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqlRecentOrders = "SELECT order_id, 
                                    (SELECT CONCAT(first_name, ' ', last_name) FROM users WHERE user_id = orders.user_id) AS customer_name, 
                                        total_amount, status 
                                FROM orders 
                                ORDER BY order_id DESC 
                                LIMIT 3; ";
            $resultRecentOrders = $conn->query($sqlRecentOrders);

            if ($resultRecentOrders->num_rows > 0) {
                while ($row = $resultRecentOrders->fetch_assoc()) {
                    $orderId = $row['order_id'];
                    $orderCustomer =  ucwords(strtolower($row['customer_name']));
                    $orderAmount = $row['total_amount'];
                    $orderStatus =  strtolower($row['status']);
                    echo "<tr>
                        <td class='border px-4 py-2'>{$orderId}</td>
                        <td class='border px-4 py-2'>{$orderCustomer}</td>
                        <td class='border px-4 py-2'>Rs {$orderAmount}</td>";
                        if ($orderStatus == 'pending'){
                            echo"<td class='border px-4 py-2 text-red-600 font-semibold'>Pending</td>";
                        } else {
                            echo"<td class='border px-4 py-2 text-green-600 font-semibold'>Completed</td>";
                        }
                        
                    echo"</tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center py-4 text-gray-500'>No recent orders</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>


</body>
