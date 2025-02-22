<?php 
$pageTitle = 'Shopping Cart';
include ("../src/includes/header.php");
include ("../src/includes/navbar.php");

// Retrieve cart items from session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$totalPrice = 0;
?>

<section>
    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <header class="text-center">
                <h1 class="text-xl font-bold text-primary sm:text-3xl">Your Cart</h1>
            </header>

            <?php if (isset($_SESSION['message'])): ?>
                <p class="text-green-600 text-center font-bold" id="session-message"><?= $_SESSION['message']; ?></p>
                <?php unset($_SESSION['message']); ?>

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

            <div class="mt-8">
                <?php if (!empty($cart)): ?>
                    <ul class="space-y-4">
                        <?php 
                        foreach ($cart as $key => $item):
                            $subtotal = $item['price'] * $item['quantity'];
                            $totalPrice += $subtotal;
                        ?>
                        <li class="flex items-center gap-4">
                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="" class="size-16 rounded object-cover" />

                            <div>
                                <h3 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($item['name']) ?></h3>
                                <dl class="mt-0.5 space-y-px text-md text-gray-600">
                                    <div>
                                        <dt class="inline">Price:</dt>
                                        <dd class="inline">Rs <?= number_format($item['price'], 2) ?></dd>
                                    </div>
                                    <div>
                                        <dt class="inline">Subtotal:</dt>
                                        <dd class="inline">Rs <?= number_format($subtotal, 2) ?></dd>
                                    </div>
                                </dl>
                            </div>

                            <div class="flex flex-1 items-center justify-end gap-2">
                                <span class="text-gray-900 font-semibold text-lg">x<?= $item['quantity'] ?></span>
                                
                                <form action="../process/remove_from_cart.php" method="POST">
                                    <input type="hidden" name="item_key" value="<?= $key ?>">
                                    <button type="submit" class="text-gray-600 transition hover:text-red-600">
                                        <span class="sr-only">Remove item</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="mt-8 flex justify-end border-t border-gray-100 pt-8">
                        <div class="w-screen max-w-lg space-y-4">
                            <dl class="space-y-0.5 text-sm text-gray-700">
                                <div class="flex justify-between text-lg font-bold">
                                    <dt>Total</dt>
                                    <dd>Rs <?= number_format($totalPrice, 2) ?></dd>
                                    <?php $_SESSION['total_price'] = $totalPrice; ?>
                                </div>
                            </dl>

                            <div class="flex justify-end mt-5">
                                <a href="../process/checkout.php" class="block rounded font-semibold text-lg bg-secondary px-5 py-3 text-gray-100 transition hover:bg-red-700">
                                    Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-center text-gray-600">Your cart is empty.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include ("../src/includes/footer.php"); ?>
