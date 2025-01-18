<header class="bg-primary text-gray-100 p-4">
  <div class="w-full flex flex-wrap items-center justify-between mx-auto">
    
    <!-- Logo -->
    <a href="#" class="flex items-center space-x-2">
      <img src="../assets/img/favicon.png" class="w-10">
      <h1 class="text-2xl font-bold">Pizza Haven</h1>
    </a>

    <!-- Hamburger Button -->
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-100 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <!-- New Hamburger Icon -->
      <svg class="w-7 h-7 text-gray-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 4h14a1 1 0 110 2H3a1 1 0 110-2zm0 4h14a1 1 0 110 2H3a1 1 0 110-2z" clip-rule="evenodd"></path>
      </svg>
    </button>

    <!-- Navbar Links -->
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <nav class="flex flex-col items-center text-center md:flex-row md:items-center md:space-x-6 space-y-4 md:space-y-0 w-full">
        <a href="../admin/admin_dashboard.php" class="hover:text-accent">Dashboard</a>
        <a href="../admin_menu_dashboard.php.php" class="hover:text-accent">Manage Menu</a>
        <a href="../admin/users_dashboard.php.php" class="hover:text-accent">Manage Users</a>
        <a href="../admin/carts_dashboard.php" class="hover:text-accent">Manage Orders</a>

          <a href="profile.php">
            <div class="relative w-8 h-8 overflow-hidden bg-gray-50 rounded-full dark:bg-slate-400 hover:bg-amber-100">
              <svg class="absolute w-10 h-10 text-white -left-1 hover:text-accent" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                </path>
              </svg>
            </div>
          </a>
          <a href="../process/logout.php" class="text-gray-100 hover:text-accent">
            <button class="px-4 py-2 bg-accent text-white rounded-md">Log Out</button>
          </a>
       
      </nav>
    </div>
  </div>
</header>