<?php
include 'connection.php';
$sql = "SELECT 
    o.O_Id, 
    o.Total, 
    o.Status, 
    u.Name, 
    u.Email,
    b.Phone_Number,
    b.Address,
    b.Comment
FROM `order` o
JOIN billingdetails b 
    ON o.O_Id = b.O_Id
JOIN users u 
    ON o.User_Id = u.User_Id
WHERE o.O_Id = '$orderId'";
$orderDetails = mysqli_query($conn,$sql);
$sql = "SELECT 
    c.P_Id,
    p.pImg,
    p.Name,
    p.Price,
    c.Quantity,
    (p.Price * c.Quantity) AS Subtotal
FROM carts c
JOIN products p ON c.P_Id = p.P_Id
WHERE c.O_Id = '$orderId'";
$cart = mysqli_query($conn,$sql);
?>