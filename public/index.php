<?php 
  $pageTitle = 'Home';
  include("../src/includes/header.php");
  include("../src/includes/navbar.php");
  include("../src/includes/db.php");
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
      <!-- Displaying success/error message -->
      <?php if (isset($_SESSION['message'])): ?>
          <div id="session-message" class="text-center p-3 text-white rounded-lg mt-4 
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

      <?php 
      $query = "SELECT item_id, item_name, item_description, price, image_url FROM menu WHERE type='pizza' ORDER BY RAND() LIMIT 3";
      $featured = $conn->query($query);

      if ($featured->num_rows>0) {
        echo"<div class='grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6'>";
        while($row = $featured->fetch_assoc()) {
          $pizzaId = $row['item_id'];
          $pizzaName = $row['item_name'];
          $pizzaDescription = $row['item_description'];
          $pizzaPrice = $row['price'];
          $pizzaImage = $row['image_url'];

          //Populate the featured section based on selected pizzas
          
          echo "<div class='rounded-lg shadow-2xl shadow-white-900 p-4 flex flex-col h-full'>";
          echo "<img src='$pizzaImage' alt='$pizzaName' class='w-full h-40 object-cover rounded'>";
          echo "<h3 class='text-lg text-primary font-bold mt-4'>$pizzaName</h3>";
          echo "<p class='mt-2 text-secondary flex-grow'>$pizzaDescription</p>";
          echo "<div class='flex justify-center mt-5'>";
          echo '<form action = "../process/add_to_cart.php" method="POST">';
          echo "<input type='hidden' name='product_id' value='$pizzaId'>";
          echo "<input type='hidden' name='product_name' value='$pizzaName'>";
          echo "<input type='hidden' name='product_price' value='$pizzaPrice'>";
          echo "<input type='hidden' name='product_image' value='$pizzaImage'>";
          echo "<input type='hidden' name='redirect_page' value='" . basename($_SERVER['PHP_SELF']) . "'>";
          echo "<button type='submit' class='bg-primary text-white rounded-lg px-4 py-2'>Add to Cart - Rs $pizzaPrice</button>";
          echo "</form>";
          echo "</div></div>";
          
        }echo"</div>";
      } else{
        echo '<h4 class="text-xl  pt-5 text-secondary text-center">No featured items available at the moment</h4>';
      }
      ?>
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