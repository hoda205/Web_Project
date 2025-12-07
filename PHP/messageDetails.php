<?php
include 'connection.php';
$sql ="SELECT * FROM messages WHERE M_Id ='$messageId'";
$messageDetails = mysqli_query($conn,$sql);
?>