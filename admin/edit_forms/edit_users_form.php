<?php
session_start();
$pageTitle = "Update Item";
include('../../src/includes/header.php');
include('../../src/includes/db.php');

// Check if an item ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['message'] = "Invalid user ID.";
    $_SESSION['message_type'] = "error";
    header("Location: ../users_dashboard.php");
    exit();
}

$userId = intval($_GET['id']); 

// Fetch item details
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

$userFirstName = $user['first_name'];
$userLastName = $user['last_name'];
$userEmail = $user['email'];
$userAddress = $user['address'];
$userNumber = $user['phone_number'];

$stmt->close();
?>


<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl text-primary font-bold text-center mb-4">Edit User</h2>
        
        <form action="../../process/update_users.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $userId; ?>">

            <div class="mb-4">
                <label class="block text-gray-700">First Name</label>
                <input type="text" name="firstName" value="<?php echo $userFirstName; ?>" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Last Name</label>
                <input type="text" name="lastName" value="<?php echo $userLastName; ?>" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" value="<?php echo $userEmail; ?>" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Phone Number</label>
                <input type="text" name="number" value="<?php echo $userNumber; ?>" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Address</label>
                <input type="text" name="address" value="<?php echo $userAddress; ?>" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg hover:bg-secondary mt-4">Update User</button>
        </form>
    </div>
</body>
</html>
