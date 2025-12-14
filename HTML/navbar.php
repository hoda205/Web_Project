<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$cart_count = 0;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $cart_count = getCartCount($user_id);
}

echo '<header>
    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="#" class="logo">fleurina.</a>
    <nav class="nav1">
        <a href="../HTML/home.php">home</a>
        <a href="../HTML/product.php">shop</a>
        <a href="../HTML/contact.php">contact</a>
        <a href="../HTML/Cart.php">
            <span class="cart-part">
                <i class="fa-solid fa-bag-shopping"></i>';

if ($cart_count > 0) {
    echo '<span class="cart-badge">'.$cart_count.'</span>';
}

echo '</span>
        </a>';

if (!isset($_SESSION['user_id'])) {
    echo '<a href="../HTML/login.php" class="login">Login</a>';
} else {
    echo '<a href="../PHP/logout.php" class="logout">Logout</a>';
}

echo '</nav>
</header>';
?>
