<?php
include 'connection.php';
$ids = [
    'users' => 'User_id',
    'products' => 'P_Id',
    'order' => 'O_Id',
    'messages' => 'M_Id',
    'carts' => 'O_Id'
];
if(isset($_GET['id'])&& isset($_GET['table'])){
    $sql = "DELETE FROM " . $_GET['table'] . " WHERE " . $ids[$_GET['table']] . " = " . $_GET['id'];
    if(mysqli_query($conn,$sql)){
        header("Location: ../HTML/" . $_GET['page']);
        exit;
    }
}
?>