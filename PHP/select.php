<?php
include 'conect.php';
$sql ="SELECT * FROM users WHERE Role ='customer'";
$customers = mysqli_query($conn,$sql);

$sql ="SELECT * FROM users WHERE Role ='admin'";
$admins = mysqli_query($conn,$sql);

$sql =
"SELECT * FROM messages ";
// "SELECT m.M_Id Id, u.Name Name, u.Email Email, m.content Content
// FROM messages m
// JOIN users u
// ON m.User_id = u.User_id
// ";
$messages = mysqli_query($conn,$sql);

$sql = "SELECT * FROM products";
$products = mysqli_query($conn,$sql);
$sql ="SELECT 
o.O_Id AS `Order_Id`,
u.Name AS `Customer_Name`,
b.Phone_Number AS `Phone`,
o.Status AS `Status`,
o.Total AS `Total`
FROM `order` o
JOIN users u 
ON o.User_Id = u.User_Id
JOIN billingdetails b 
ON o.O_Id = b.O_Id
";
$orders = mysqli_query($conn,$sql);
?>