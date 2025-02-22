<?php
    $pageTitle = 'Add Users';
    include("../../src/includes/header.php"); 
?>

<body class="flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl text-primary font-bold text-center mb-4 " id="form-title">Add User</h2>
        
        <form id="auth-form" action="../../process/add_users.php" method="POST">
            <input type="hidden" name="form_type" id="form_type" value="add_users">
            
            <div class="mb-4">
                <label class="block text-gray-700">First Name</label>
                <input type="textbox" name="firstName" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Last Name</label>
                <input type ="text" name="lastName" required class="w-full px-3 py-2 border rounded-lg" rows="4"></input>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700" maxlength="13">Phone Number</label>
                <input type="textbox" name="number" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Address</label>
                <input type="textbox" name="address" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <!-- //Radio buttons for user type -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-3">User Type</label>
                <div class="space-y-3">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" id="user_radio" name="role" value="user" required class="form-radio text-primary h-5 w-5 border-gray-300">
                    <span class="ml-2 text-gray-800">User</span>
                </label>

                <label class="flex items-center cursor-pointer">
                    <input type="radio" id="admin_radio" name="role" value="admin" required class="form-radio fill-primary h-5 w-5 border-gray-300">
                    <span class="ml-2 text-gray-800">Admin</span>
                </label>

                </div>
            </div>

            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg">
                Add User
            </button>
        </form>

    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>
