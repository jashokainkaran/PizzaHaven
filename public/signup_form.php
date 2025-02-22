<?php
$pageTitle = 'Sign Up Page'; 
include("../src/includes/header.php") 
?>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl text-primary font-bold text-center mb-4 mt-3" id="form-title">Sign Up</h2>
        
        <form id="auth-form" action="../process/signup.php" method="POST">
            <input type="hidden" name="form_type" id="form_type" value="login">
            
            <div class="mb-4">
                <label class="block text-gray-700">First Name</label>
                <input type="textbox" name="fname" required class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Last Name</label>
                <input type="textbox" name="lname" required class="w-full px-3 py-2 border rounded-lg">
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

            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg mt-2">
                Sign Up
            </button>
        </form>

        <p class="text-center mt-4 text-gray-600">
            <span id="toggle-text">Already have an account?</span>
            <a href="../public/login_form.php" id="toggle-form" class="text-primary">Log in</a>
        </p>
    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>
