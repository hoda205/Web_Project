<?php
include 'connection.php';
$sql ="SELECT * FROM users WHERE Role ='customer'";
$customers = mysqli_query($conn,$sql);

$sql ="SELECT * FROM users WHERE Role ='admin'";
$admins = mysqli_query($conn,$sql);

$sql =
"SELECT m.M_Id Id, u.Name Name, u.Email Email, m.content Content
FROM messages m
JOIN users u
ON m.User_id = u.User_id
";
$messages = mysqli_query($conn,$sql);

?>