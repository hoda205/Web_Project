<?php
include 'connection.php';
if(isset($_POST['save'])){

    $id =$_POST['Id'];
    if(empty($id)){
        var_dump($_FILES); 
        $pName = $_POST['pName'];
        $pDisc = $_POST['pDisc'];
        $pPrice = $_POST['pPrice'];
        $pImg = $_FILES['pImg'];
        $fileName = $pImg['name'];
        $fileTmpName = $pImg['tmp_name'];

        $sql = "SELECT * FROM products WHERE pImg = '$fileName'";
        $result =mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)){
            header("Location: ../HTML/addAndEditeProducts.php?nameImg=1");
            exit;
        }
        $sql = "SELECT * FROM products WHERE Name = '$pName'";
        $result =mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)){
            header("Location: ../HTML/addAndEditeProducts.php?nameProduct=1");
            exit;
        }

        $sql = "INSERT INTO products ( pImg, Name, Describtion, Price) VALUES ('$fileName' , '$pName' , '$pDisc' , '$pPrice')";
        if (mysqli_query($conn, $sql)) {
            $folder = "../Images/". $fileName;
            move_uploaded_file($fileTmpName, $folder);
            header("Location: ../HTML/addAndEditeProducts.php?successAdd=1");
            exit;
        } 
        else {
            header("Location: ../HTML/addAndEditeProducts.php?successAdd=0");
            exit;
        }
    }
    else{
        $sql = "SELECT * FROM products WHERE P_Id = '$id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        var_dump($_FILES); 
        $pName = $_POST['pName'] ?: $row['Name'];
        $pDisc = $_POST['pDisc'] ?: $row['Describtion'];
        $pPrice = $_POST['pPrice'] ?: $row['Price'];
        $pImg = $_FILES['pImg'];
        $fileName = $pImg['name'] ?: $row['pImg'];
        if($fileName != $row['pImg'] && !empty($fileName)){
            $sql = "SELECT * FROM products WHERE pImg = '$fileName'";
            $result =mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)){
                header("Location: ../HTML/addAndEditeProducts.php?nameImg=1&id=$id");
                exit;
            }
        }
        if($pName != $row['Name'] && !empty($pName)){
            $sql = "SELECT * FROM products WHERE Name = '$pName'";
            $result =mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)){
                header("Location: ../HTML/addAndEditeProducts.php?nameProduct=1&id=$id");
                exit;
            }
        }
        $sql = "UPDATE products SET Name='$pName' ,Describtion= '$pDisc', Price ='$pPrice', pImg ='$fileName' WHERE p_Id = '$id'";
        if(mysqli_query($conn,$sql)){
            if(!empty($pImg['name'])){
                $folder = "../Images/". $fileName;
                $fileTmpName = $pImg['tmp_name'];
                move_uploaded_file($fileTmpName, $folder);
                // امسح الصوره القديمه
                if(file_exists("../Images/".$row['pImg'])){
                    unlink("../Images/".$row['pImg']);
                }
            }
        header("Location: ../HTML/dashboard.php");
        exit;
    } 
    else {
        header("Location: ../HTML/addAndEditeProducts.php?successUpdate=0");
        exit;
    }
    
}
}
?>