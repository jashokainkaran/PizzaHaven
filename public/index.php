<?php 
  $pageTitle = 'Home';
  include("../src/includes/header.php");
  include("../src/includes/navbar.php");
?>

    <!-- Hero Section -->
    <section class="relative text-center w-full">
      <!-- Full-width background image -->
      <div class="relative w-full">
        <img src="../assets/img/hero.jpg" class="w-full h-[50vh] object-cover sm:h-[60vh] md:h-[70vh]">
        <!-- Text overlay -->
        <div class="absolute inset-0 flex flex-col justify-center items-center">
          <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white drop-shadow-md">
            Welcome to Pizza Haven
          </h1>
          <p class="mt-4 text-lg md:text-xl text-white font-bold">
            Serving the Best Pizzas in Town, Day or Night.
          </p>
        </div>
      </div>
    </section>
  </div>

  <!-- Featured Items -->
  <section class="bg-background px-4 pb-4 pt-3 mt-4">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-primary text-center">Featured Pizzas</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <div class="rounded-lg shadow-2xl shadow-white-900 p-4">
          <img src="../assets/img/pepperoni.jpg" alt="Pepperoni Perfection" class="w-full h-40 object-cover rounded">
          <h3 class="text-lg text-primary font-bold mt-4">Pepperoni Perfection</h3>
          <p class="mt-2 text-secondary">Loaded with premium pepperoni and cheese.</p>          <div class="flex justify-center mt-4 mx-auto">
            <button type="submit" class="bg-primary text-white rounded-full px-4 py-2">Order Now</button>
          </div>
        </div>
        <div class="rounded-lg shadow-2xl shadow-white-900 p-4">
          <img src="../assets/img/veggie.jpg" alt="Veggie Supreme" class="w-full h-40 object-cover rounded">
          <h3 class="text-lg text-primary font-bold mt-4">Veggie Supreme</h3>
          <p class="mt-2 text-secondary">Packed with fresh veggies and a hint of basil.</p>
          <div class="flex justify-center mt-4 mx-auto">
            <button type="submit" class="bg-primary text-white rounded-full px-4 py-2">Order Now</button>
          </div>
        </div>
        <div class="rounded-lg shadow-2xl shadow-white-900 p-4">
          <img src="../assets/img/bbq.jpg" alt="BBQ Chicken Delight" class="w-full h-40 object-cover rounded">
          <h3 class="text-lg text-primary font-bold mt-4">BBQ Chicken Delight</h3>
          <p class="mt-2 text-secondary">Topped with tender chicken and BBQ sauce</p>
          <div class="flex justify-center mt-4 mx-auto">
            <button type="submit" class="bg-primary text-white rounded-full px-4 py-2">Order Now</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Us Section -->
  <section class="bg-background py-8 px-4">
    <div class="container mx-auto flex flex-col lg:flex-row items-center">
      <!-- Text Section -->
      <div class="lg:w-1/2 text-center lg:text-left mb-8 lg:mb-0">
        <h2 class="text-3xl font-bold text-primary">Welcome to Pizza Haven – Where Every Slice Feels Like Home!</h2>
        <p class="mt-4 text-gray-700">
          At Pizza Haven, we believe that great pizza brings people together. Located at the heart of flavor and
          creativity, we’re passionate about crafting pizzas that delight your taste buds and warm your soul.
        </p>
        <p class="mt-4 text-gray-700">
          Our journey began with a simple idea: to create a haven where pizza lovers can enjoy the perfect blend of
          quality, taste, and freshness. Every pizza we serve is made with love, using the finest ingredients and our
          signature dough prepared fresh daily.
        </p>

      </div>
      <!-- Image -->
      <div class="lg:w-1/2 flex justify-center">
        <img src="../assets/img/about-us.jpg" alt="Delicious Pizza" class="w-full lg:w-3/4 rounded-lg shadow-lg" />
      </div>
    </div>
  </section>

<?php 
    include("../src/includes/footer.php");
?>