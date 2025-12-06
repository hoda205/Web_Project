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
    $sqlSelect = "SELECT * FROM `" . $_GET['table'] . "` WHERE " . $ids[$_GET['table']] . " = " . $_GET['id'];
    $result = mysqli_query($conn,$sqlSelect);
    $row = mysqli_fetch_assoc($result);
    $sql = "DELETE FROM `" . $_GET['table'] . "` WHERE " . $ids[$_GET['table']] . " = " . $_GET['id'];
    if(mysqli_query($conn,$sql)){
        if($_GET['table'] == 'products'){
            if(file_exists("../Images/".$row['pImg'])){
                    unlink("../Images/".$row['pImg']);
                }
        }
        header("Location: ../HTML/" . $_GET['page']);
        exit;
    }
}
?>