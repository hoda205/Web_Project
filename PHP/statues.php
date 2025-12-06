<?php
include 'connection.php';
if($_GET['status']&& $_GET['orderId']){
    $status = $_GET['status'];
    $orderId = $_GET['orderId'];
    $sql = "UPDATE `order` SET `Status`='$status' WHERE O_Id = $orderId";
    if(mysqli_query($conn,$sql)){
        header("Location: ../HTML/dashboard.php");
        exit;
    }

}
?>