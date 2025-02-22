<?php 
$pageTitle = 'Users Dashboard';

include('../src/includes/admin_check.php');
include('../src/includes/header.php');
include('../src/includes/admin_navbar.php');
include('../src/includes/db.php'); // Database connection

// Check if a delete request was made when the page reloads
if (isset($_GET['delete_id'])) {
    $userId = intval($_GET['delete_id']); // Convert to an integer

    // Ask for confirmation using JavaScript
    echo "<script>
        var confirmDelete = confirm('Are you sure you want to delete this user?');
        if (confirmDelete) {
            window.location.href = 'users_dashboard.php?confirm_delete_id=$userId';
        } else {
            window.location.href = 'users_dashboard.php';
        }
    </script>";
    exit();
}

// Processing the confirmed delete request
if (isset($_GET['confirm_delete_id'])) {
    $userId = intval($_GET['confirm_delete_id']); // Ensure it's an integer

    // Check if the user has any pending orders
    $checkOrders = $conn->prepare("SELECT COUNT(*) FROM orders WHERE user_id = ? AND status = 'Pending'");
    $checkOrders->bind_param("i", $userId);
    $checkOrders->execute();
    $checkOrders->bind_result($pendingOrders);
    $checkOrders->fetch();
    $checkOrders->close();

    if ($pendingOrders > 0) {
        // User has pending orders, do not delete
        $_SESSION['message'] = "User cannot be deleted as they have pending orders.";
        $_SESSION['message_type'] = "error";
    } else {
        // Step 2: Proceed with user deletion but keep orders by setting user_id to NULL
        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['message'] = "User Removed Successfully. Past orders are retained.";
                $_SESSION['message_type'] = "success";
                $conn->commit();
            } else {
                throw new Exception("Error: User ID not found in database.");
            }

            $stmt->close();
        } catch (Exception $e) {
            $conn->rollback();
            $_SESSION['message'] = "Error removing user: " . $e->getMessage();
            $_SESSION['message_type'] = "error";
        }
    }

    // Redirect back to the users dashboard
    header("Location: users_dashboard.php");
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
        <h2 class="text-2xl font-bold text-secondary">Users Table</h2>
        
        <a href="../admin/add_forms/add_users_form.php" class="bg-primary text-white px-6 py-2 mt-4 rounded-lg font-medium hover:bg-red-700">Add User</a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <table class="w-full text-md sm:text-md text-center">
            <thead class="text-md sm:text-sm font-bold uppercase bg-gray-50 text-gray-500">
                <tr>
                    <th scope="col" class="px-4 sm:px-6 py-3">User ID</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">First Name</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Last Name</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Email</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Phone Number</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Address</th>
                    <th scope="col" class="px-4 sm:px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
<?php
// Fetching the data from the database
$sqlUsers = "SELECT * FROM users WHERE role = 'user'";
$resultUsers = mysqli_query($conn, $sqlUsers);

if ($resultUsers->num_rows > 0) {
    while ($userRow = $resultUsers->fetch_assoc()) {
        $userId = $userRow['user_id'];
        $userFirstName = ucfirst(strtolower($userRow['first_name']));
        $userLastName = ucfirst(strtolower($userRow['last_name']));
        $userEmail = $userRow['email'];
        $userAddress = ucfirst(strtolower($userRow['address']));
        $userNumber = $userRow['phone_number'];

        echo "<tr class='bg-white border-b'>";
        echo "<th scope='row' class='px-4 sm:px-6 py-4 font-bold whitespace-nowrap'>$userId</th>";
        echo "<td class='px-4 sm:px-6 py-4'>$userFirstName</td>";
        echo "<td class='px-4 sm:px-6 py-4'>$userLastName</td>";
        echo "<td class='px-4 sm:px-6 py-4'>$userEmail</td>";
        echo "<td class='px-4 sm:px-6 py-4'>$userNumber</td>";
        echo "<td class='px-4 sm:px-6 py-4'>$userAddress</td>";
        echo "<td class='px-4 sm:px-6 py-4'>
                <a href='./edit_forms/edit_users_form.php?id=$userId' class='font-medium text-blue-600 hover:underline'>Edit</a>
                <a href='users_dashboard.php?delete_id=$userId' class='font-medium text-red-600 hover:underline ms-3'>Delete</a>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center py-4 text-gray-500'>No users Found</td></tr>";
}
?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
