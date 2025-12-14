<?php
    session_start();
    include '../PHP/connection.php';
    include '../PHP/CartFunctions.php';

     $user_id = $_SESSION['user_id'];

    $cart_data = getCartItems($user_id);
    $cart_count = getCartCount($user_id);
    $cart_total = getCartTotal($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../CSS/cartstyle.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">

    <script src="https://kit.fontawesome.com/3f7db2a477.js" crossorigin="anonymous"></script>

</head>
<body>

    <header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>

        <a href="#" class="logo">fleurina.</a>
        <nav class="nav1">
            <a href="../HTML/home.html">home</a>
            <a href="../HTML/product.php">shop</a>
            <a href="../HTML/contact.php">contact</a>
            <a href="../HTML/Cart.php"><i class="fa-solid fa-bag-shopping" ></i> 
            <?php if($cart_count > 0): ?>
                <span class="cart-badge"><?php echo $cart_count; ?></span>
            <?php endif;?> </a>  
        </nav>
    </header>
    
</body>
</html>

