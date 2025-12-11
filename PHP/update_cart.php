<?php
session_start();
include 'connection.php';
include 'CartFunctions.php';

$cart_id = $_POST['cart_id'];
$action = $_POST['action']; // 'increase' أو 'decrease'
$user_id = $_SESSION['user_id'];


$sql = "SELECT Quantity FROM carts WHERE C_Id = $cart_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$current_qty = $row['Quantity'];


if ($action == 'increase') {
    $new_qty = $current_qty + 1;
} else {
    $new_qty = $current_qty - 1;
    if ($new_qty < 1) $new_qty = 1;
}


updateCartQuantity($cart_id, $new_qty, $user_id);


header("Location: ../HTML/Cart.php");
exit();
?>