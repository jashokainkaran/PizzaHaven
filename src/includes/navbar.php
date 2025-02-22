<?php session_start(); ?>

<header class="bg-gradient-to-r from-primary to-secondary text-white p-4">
  <div class="w-full flex flex-wrap items-center justify-between mx-auto">
    <!-- Logo -->
    <a href="#" class="flex items-center space-x-3">
      <img src="../assets/img/favicon.png" class="w-10">
      <h1 class="text-2xl font-bold tracking-wide hover:scale-105 transition-transform">Pizza Haven</h1>
    </a>

    <!-- Hamburger Button -->
    <button 
      data-collapse-toggle="navbar-default" 
      type="button" 
      class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600" 
      aria-controls="navbar-default" 
      aria-expanded="false"
    >
      <span class="sr-only">Open main menu</span>
      <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 4h14a1 1 0 110 2H3a1 1 0 110-2zm0 4h14a1 1 0 110 2H3a1 1 0 110-2z" clip-rule="evenodd"></path>
      </svg>
    </button>

    <!-- Navbar Links -->
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <nav class="flex flex-col items-center text-center md:flex-row md:items-center md:space-x-8 space-y-4 md:space-y-0 w-full">
        <a href="../public/index.php" class="hover:text-accent hover:scale-105 transition-transform">Home</a>
        <a href="../public/pizza.php" class="hover:text-accent hover:scale-105 transition-transform">Pizzas</a>
        <a href="../public/drinks.php" class="hover:text-accent hover:scale-105 transition-transform">Drinks</a>
        <a href="../public/cart.php" class="flex items-center hover:text-accent transition-colors duration-300">
          <svg class="w-6 h-6 text-gray-100 hover:text-accent" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
          </svg>
        </a>

        <!-- Conditional Rendering for Profile and Login/Register Buttons -->
        <?php if (isset($_SESSION['email'])): ?>
          <a href="../public/orders.php" class="flex items-center hover:scale-105 transition-transform">
            <div class="relative w-8 h-8 overflow-hidden bg-gray-50 rounded-full dark:bg-slate-400 hover:bg-amber-100">
              <svg class="absolute w-10 h-10 text-white -left-1 hover:text-accent" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
              </svg>
            </div>
          </a>
          <a href="../process/logout.php" class="text-gray-100 hover:text-accent hover:scale-105 transition-transform">
            <button class="px-4 py-2 bg-accent text-white rounded-md">Log Out</button>
          </a>
        <?php else: ?>
          <a href="../public/login_form.php" class="text-gray-100 hover:text-accent hover:scale-105 transition-transform">
            <button class="px-4 py-2 bg-accent text-white rounded-md">Login</button>
          </a>
          <a href="../public/signup_form.php" class="text-gray-100 hover:text-accent hover:scale-105 transition-transform">
            <button class="px-4 py-2 bg-accent text-white rounded-md">Register</button>
          </a>
        <?php endif; ?>
      </nav>
    </div>
  </div>
</header>
