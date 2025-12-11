<?php
    session_start();
    include 'connection.php';
    include 'CartFunctions.php';

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['user_id'] ;
        header('Location: ../HTML/login.html');
        exit();
    }

    // Check if product_id is provided
    if (!isset($_POST['product_id'])) {
        header('Location: ../HTML/product.php');
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

    // Add to cart using the function from CartFunctions.php
    $result = addToCart($user_id, $product_id, 1);
    if ($result) {
        // Redirect back to products page or cart
        header('Location: ../HTML/product.php?success=added');
        exit();
    } else {
        header('Location: ../HTML/product.php?error=failed');
        exit();
    }
?>