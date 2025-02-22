<header class="bg-gradient-to-r from-primary to-gray-800 text-white p-4">
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
        <a href="../admin/admin_dashboard.php" class="hover:text-accent hover:scale-105 transition-transform">Dashboard</a>
        <a href="../admin/pizza_dashboard.php" class="hover:text-accent hover:scale-105 transition-transform">Pizzas</a>
        <a href="../admin/drinks_dashboard.php" class="hover:text-accent hover:scale-105 transition-transform">Beverages</a>
        <a href="../admin/users_dashboard.php" class="hover:text-accent hover:scale-105 transition-transform">Users</a>
        <a href="../admin/orders_dashboard.php" class="hover:text-accent hover:scale-105 transition-transform">Orders</a>

        <!-- Logout Button -->
        <a href="../process/logout.php" class="text-gray-100 hover:text-accent hover:scale-105 transition-transform">
          <button class="px-4 py-2 bg-accent text-white rounded-md">Log Out</button>
        </a>
      </nav>
    </div>
  </div>
</header>
