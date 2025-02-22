<?php 
$pageTitle = 'Drinks';
include ("../src/includes/header.php");
include ("../src/includes/navbar.php");
// Database Connection
include("../src/includes/db.php");

// Check if there's a success message
$successMessage = isset($_GET['success']) ? $_GET['success'] : '';
?>

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
      
<!-- Displaying the menu items-->
<?php
// Fetching the categories from menu based on whether it is a drink
$sqlCategories = "SELECT DISTINCT category FROM menu WHERE type = 'drink'";
$resultCategories = $conn->query($sqlCategories);

if ($resultCategories->num_rows > 0) {
  // Using while loop to get the name of the category to name the section and populate the menu
  while ($categoryRow = $resultCategories->fetch_assoc()) {
    $categoryName = $categoryRow['category'];
    echo '<section class="bg-background px-4 pb-5">';
    echo '<div class="container mx-auto">';
    echo "<h2 class='text-3xl font-bold pt-5 text-primary text-center'>$categoryName</h2>";
    echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">';

    // Fetching drinks data from the database
    $sqlDrinks = "SELECT * FROM menu WHERE category = '$categoryName'"; 
    $resultDrinks = $conn->query($sqlDrinks);

    if ($resultDrinks->num_rows > 0) {
      while ($drinkRow = $resultDrinks->fetch_assoc()) {
        $drinkId = $drinkRow['item_id'];
        $drinkName = $drinkRow['item_name'];
        $drinkDescription = $drinkRow['item_description'];
        $drinkPrice = $drinkRow['price'];
        $drinkImage = htmlspecialchars($drinkRow['image_url']);

        // Populate the drink sections based on the content from the database
        echo "<div class='rounded-lg shadow-2xl shadow-white-900 p-4 flex flex-col h-full'>";
        echo "<img src='$drinkImage' alt='$drinkName' class='w-full h-40 object-cover rounded'>";
        echo "<h3 class='text-lg text-primary font-bold mt-4'>$drinkName</h3>";
        echo "<p class='mt-2 text-secondary flex-grow'>$drinkDescription</p>";
        echo "<div class='flex justify-center mt-5'>";
        echo '<form action = "../process/add_to_cart.php" method="POST">';
        echo "<input type='hidden' name='product_id' value='$drinkId'>";
        echo "<input type='hidden' name='product_name' value='$drinkName'>";
        echo "<input type='hidden' name='product_price' value='$drinkPrice'>";
        echo "<input type='hidden' name='product_image' value='$drinkImage'>";
        echo "<input type='hidden' name='redirect_page' value='" . basename($_SERVER['PHP_SELF']) . "'>";
        echo "<button type='submit' class='bg-primary text-white rounded-lg px-4 py-2'>Add to Cart - Rs $drinkPrice</button>";
        echo "</form>";
        echo "</div></div>";
      }
      echo '</div></div></section>';
    } else {
      echo '<h2 class="text-3xl font-bold pt-5 text-primary text-center">No Drinks Available</h2>';
    }
  }
} else {
  echo '<h2 class="text-3xl font-bold pt-5 text-primary text-center">No categories found for drinks</h2>';
}

include ("../src/includes/footer.php");
?>