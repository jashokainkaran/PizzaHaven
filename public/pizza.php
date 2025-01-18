<?php 
$pageTitle = 'Pizzas';
include ("../src/includes/header.php");
include ("../src/includes/navbar.php");
// Database Connection
include("../src/includes/db.php");

// Fetching the categories from menu based on whether it is a pizza
$sqlCategories = "SELECT DISTINCT category FROM menu WHERE type = 'pizza'";
$resultCategories = $conn->query($sqlCategories);

if ($resultCategories->num_rows > 0) {
  // Using while loop to get the name of the category to name the section and populate the menu
  while ($categoryRow = $resultCategories->fetch_assoc()) {
    $categoryName = $categoryRow['category'];
    echo '<section class="bg-background px-4 pb-5">';
    echo '<div class="container mx-auto">';
    echo "<h2 class='text-3xl font-bold pt-5 text-primary text-center'>$categoryName</h2>";
    echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">';

    // Fetching pizza data from the database
    $sqlPizzas = "SELECT * FROM menu WHERE category = '$categoryName'"; 
    $resultPizzas = $conn->query($sqlPizzas);

    if ($resultPizzas->num_rows > 0) {
      while ($pizzaRow = $resultPizzas->fetch_assoc()) {
        $pizzaName = $pizzaRow['item_name'];
        $pizzaDescription = $pizzaRow['item_description'];
        $pizzaPrice = $pizzaRow['price'];
        $pizzaImage = $pizzaRow['image_url'];

        // Populate the pizza sections based on the content from the database
        echo "<div class='rounded-lg shadow-2xl shadow-white-900 p-4 flex flex-col h-full'>";
        echo "<img src='$pizzaImage' alt='$pizzaName' class='w-full h-40 object-cover rounded'>";
        echo "<h3 class='text-lg text-primary font-bold mt-4'>$pizzaName</h3>";
        echo "<p class='mt-2 text-secondary flex-grow'>$pizzaDescription</p>";
        echo "<div class='flex justify-center mt-5'>";
        echo "<button type='submit' class='bg-primary text-white rounded-lg px-4 py-2'>Add to Cart - Rs $pizzaPrice</button>";
        echo "</div></div>";
      }
      echo '</div></div></section>';
    } else {
      echo '<h2 class="text-3xl font-bold pt-5 text-primary text-center">No Pizzas Available</h2>';
    }
  }
} else {
  echo '<h2 class="text-3xl font-bold pt-5 text-primary text-center">No categories found for pizzas</h2>';
}

include ("../src/includes/footer.php");
?>
