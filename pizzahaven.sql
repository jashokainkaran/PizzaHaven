-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 11:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzahaven`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(25) NOT NULL,
  `item_description` varchar(1000) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`item_id`, `item_name`, `item_description`, `price`, `category`, `image_url`, `type`) VALUES
(1, 'Margherita Magic', 'A simple yet classic pizza topped with fresh mozzarella, vibrant tomatoes, and a hint of basil for that perfect Italian touch.', 3200.00, 'Classic Comforts', '../assets/uploads/1737367138_marghareita.jpg', 'pizza'),
(2, 'BBQ Chicken Delight', 'A smoky barbecue sauce base with grilled chicken, red onions, and a mix of cheese, creating a savory sensation in every bite.', 3600.00, 'Classic Comforts', '../assets/uploads/1737313623_bbq.jpg', 'pizza'),
(3, 'Cheese Lover\'s Dream', 'For the true cheese connoisseur, this pizza is a gooey delight with mozzarella, cheddar, parmesan, and ricotta.', 3200.00, 'Classic Comforts', '../assets/uploads/1737367170_cheese.jpg', 'pizza'),
(4, 'Veggie Supreme', 'A medley of fresh vegetables, with bell peppers and mushrooms, all on a bed of melted cheese for the ultimate vegetarian indulgence.', 2800.00, 'Classic Comforts', '../assets/uploads/1737364922_veggie.jpg', 'pizza'),
(5, 'Hawaiian Paradise', 'Sweet and savory with a perfect balance of pineapple, ham, and cheese, transporting you to a tropical flavor journey.', 4400.00, 'Classic Comforts', '../assets/uploads/1737367181_hawaiian.jpg', 'pizza'),
(6, 'Pepperoni Perfection', 'A timeless classic, loaded with premium pepperoni slices and smothered in rich, melted mozzarella cheese, all on a perfectly crispy crust. Every bite is packed with bold, savory flavor!', 3850.00, 'Flavour Fusion', '../assets/uploads/1737364936_pepperoni.jpg', 'pizza'),
(7, 'Pesto Perfection', 'A basil pesto base with grilled chicken, sun-dried tomatoes, and goat cheese, offering a fresh, herby experience.', 3600.00, 'Flavour Fusion', '../assets/uploads/1737367284_pesto.jpg', 'pizza'),
(8, 'Meat Lover\'s Paradise', 'Loaded with generous portions of pepperoni, smoky sausage, crispy bacon, and savory ham, this pizza is a dream come true for meat lovers.', 3200.00, 'Flavour Fusion', '../assets/uploads/1737367190_meat_lovers.jpg', 'pizza'),
(9, 'Truffle Temptation', 'A luxurious combination of truffle oil, wild mushrooms, and creamy ricotta cheese, bringing rich, earthy flavors to every bite.', 2800.00, 'Flavour Fusion', '../assets/uploads/1737367203_truffle.jpg', 'pizza'),
(10, 'Buffalo Chicken Explosion', 'A spicy buffalo sauce base topped with crispy chicken, celery, and a drizzle of ranch, perfect for fans of bold and tangy flavors.', 4200.00, 'Flavour Fusion', '../assets/uploads/1737367213_buffalo_chicken.jpg', 'pizza'),
(18, 'Classic Cola', 'A timeless favorite with a fizzy kick and a refreshing sweetness.', 600.00, 'Classic Sodas', '../assets/uploads/1737370299_cola.jpg', 'drink'),
(19, 'Lemon Lime Fizz', 'A zesty blend of citrusy lime and lemon with a bubbly finish.', 650.00, 'Classic Sodas', '../assets/uploads/1737370308_lemon fizz.jpg', 'drink'),
(20, 'Orange Burst', 'A tangy orange soda, perfect for a refreshing complement to pizza.', 700.00, 'Classic Sodas', '../assets/uploads/1737370316_orange burst.jpg', 'drink'),
(21, 'Ginger Ale Twist', 'A smooth, slightly spicy ginger soda for a unique flavor experience.', 750.00, 'Classic Sodas', '../assets/uploads/1737370324_ginger ale.jpg', 'drink'),
(22, 'Velvety Vanilla Shake', 'A rich and creamy vanilla milkshake with a smooth, velvety texture, perfect for a classic indulgence.', 800.00, 'Classic Sodas', '../assets/uploads/1737370331_vanilla milkshake.jpg', 'drink'),
(23, 'Sparkling Mojito Mocktail', 'A non-alcoholic twist with mint, lime, and a touch of fizz.', 2100.00, 'Signature Blends', '../assets/uploads/1737370703_sparklingmojito.jpg', 'drink'),
(24, 'Berry Bliss Smoothie', 'A creamy blend of mixed berries and yogurt, rich in flavor.', 1800.00, 'Signature Blends', '../assets/uploads/1737370693_berrysmoothie.jpg', 'drink'),
(25, 'Choco Mint Shake', 'Decadent chocolate shake with a refreshing hint of mint.', 2400.00, 'Signature Blends', '../assets/uploads/1737370372_choco mint.jpg', 'drink'),
(26, 'Caramel Coffee Cooler', 'Iced coffee blended with caramel syrup for a sweet caffeine fix.', 2200.00, 'Signature Blends', '../assets/uploads/1737370384_Caramel Coffee.jpg', 'drink'),
(27, 'Tropical Paradise Punch', 'A mix of pineapple, mango, and coconut for a tropical escape.', 2300.00, 'Signature Blends', '../assets/uploads/1737370393_tropical.jpg', 'drink');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(25) DEFAULT 'user',
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `role`, `address`, `phone_number`) VALUES
(10, 'admin', 'admin', 'admin@gmail.com', '$2y$10$acOH4a1r3KH2dO0vtDYL1e6aUOeg0JFaBVO3No9dDcOCgrEJupsjK', 'admin', NULL, NULL),
(11, 'desman', 'desman', 'desman@gmail.com', '$2y$10$ch9CXdCPnAP5.mXVKXFUSuggRfNJr3WDgXZex2Frb4DX1yn0fZK.m', 'user', 'colombo', '999999999'),
(14, 'admin1', 'admin1', 'admin1@gmail.com', '$2y$10$Lx8p8Pp6oroJJnJML6SHt.bFsO8507BAc8m5WvwYLjJ9VI/n5OdHy', 'admin', 'colombo', '1123456789'),
(17, 'ashok', 'ainkaran', 'ashok@gmail.com', '$2y$10$QfuyWK.ojn8xnPByTqwEMuiesNCOLpBvmHfxUPtoi384n.14l0emG', 'user', 'colombo', '767232402');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
