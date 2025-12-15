<?php
include 'connection.php'; 
if(isset($_POST['save'])){
$phone   = $_POST['phone'];
$address = $_POST['address'];
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
$order_id = $_POST['order_id']; 


$sql = "INSERT INTO billingdetails (Phone_Number, Address, Comment, O_Id) 
        VALUES ('$phone', '$address', '$comment', '$order_id')";

if (mysqli_query($conn, $sql)) {
    $sql = "UPDATE `order` SET `Status`='Submitted' WHERE O_Id = $order_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../HTML/product.php?order");
    }
} else {
    echo "Error: " . mysqli_error($conn);
}
}
?>