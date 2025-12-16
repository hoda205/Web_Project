<?php
session_start();
    include '../PHP/connection.php';
    include '../PHP/CartFunctions.php';
    
    if (!isset($_SESSION['user_id'])) {
            header('Location: ../HTML/login.php');
            exit();
    }

    $user_id = $_SESSION['user_id'];
    $cart_count = getCartCount($user_id);
    $cart_data = getCartItems($user_id);
    $cart_total = getCartTotal($user_id);
    $order_id = getOrCreatePendingOrder($user_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fleurina | Checkout</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="../CSS/CheckBillStyle.css">
<link rel="stylesheet" href="../CSS/navStyle.css">
    <script src="https://kit.fontawesome.com/3f7db2a477.js" crossorigin="anonymous"></script>

</head>
<body>

<!-- Header -->
<!-- <header class="container">
    <a href="#" class="logo">Fleurina</a>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
</header> -->
<?php 
    include 'navbar.php';
    ?>

<!-- Page Title -->
<h1 class="page-title">Billing Details</h1>

<!-- Checkout Grid -->
<div class="container checkout-container">

    <!-- Billing Form -->
    <div class="billing-section">
        <h2 class="section-title">Billing Info</h2>
        <form action="../PHP/sendOrder.php" method="post">
            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>" />
            
            <div class="form-group">
                <label class="fs-3">Phone</label>
                <input type="text" name="phone" placeholder="Enter phone number" required>
            </div>
            <div class="form-group">
                <label class="fs-3">Address</label>
                <input type="text" name="address" placeholder="Enter address" required>
            </div>
            <div class="form-group">
                <label class="fs-3">Comment</label>
                <textarea type="text" name="comment" placeholder="Enter Comment" class="form-control fs-4" rows="4"></textarea>
            </div>

    </div>

    <!-- Order Summary -->
    <div class="order-section">
        <h2 class="section-title">Your Order</h2>
        <?php if (!empty($cart_data['items'])): ?>
        <?php foreach ($cart_data['items'] as $item): ?>
            <?php $item_total = $item['Price'] * $item['Quantity']; ?>
            <div class="order-item">
                <span><?php echo htmlspecialchars($item['Name']); ?> x <?php echo (int)$item['Quantity']; ?></span>
                <span>$<?php echo number_format($cart_data['subtotal'], 2); ?></span>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <div class="order-item">
            <span>Shipping</span>
            <span>Free</span>
        </div>
        <div class="order-total">
            <span>Total</span>
            <span>$<?php echo number_format($cart_data['subtotal'], 2); ?></span>
        </div>
        <button type="submit" class="place-order-btn w-100" name="save">Place Order</button>
        </form>
    </div>
</div>

<!-- Footer -->
<footer>
    &copy; 2025 Fleurina. All rights reserved.
</footer>

</body>
</html>
