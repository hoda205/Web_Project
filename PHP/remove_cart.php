<?php
    session_start();
    include 'connection.php';
    include 'CartFunctions.php';

    // TEMP: set a test user if not logged in (remove in production)
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['user_id'] ;
        header('Location: ../HTML/login.html');
        exit();
    }

    // Validate input
    if (!isset($_POST['cart_id'])) {
        header('Location: ../HTML/Cart.php?error=no_cart_id');
        exit();
    }

    $cart_id = mysqli_real_escape_string($conn, $_POST['cart_id']);
    $user_id = $_SESSION['user_id'];

    $result = removeFromCart($cart_id, $user_id);

    // removeFromCart returns "Success" or an error message
    if ($result === "Success") {
        header('Location: ../HTML/Cart.php?success=removed');
        exit();
    } else {
        // Return the error text for debugging (url-encoded)
        header('Location: ../HTML/Cart.php?error=' . urlencode($result));
        exit();
    }
?>