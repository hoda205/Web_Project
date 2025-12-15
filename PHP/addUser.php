<?php
include 'connection.php';
if(isset($_POST['save'])){

    $id =$_POST['Id'];
    if(empty($id)){
        $username = $_POST['Username'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $role = $_POST['Role'];

        $sql = "SELECT * FROM users WHERE Email = '$email'";
        $result =mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)){
            header("Location: ../HTML/addAdminAndCustomer.php?samEmail=1");
            exit;
        }

        
        $sql = "INSERT INTO users ( Name, Email, Password, Role) VALUES ('$username' , '$email' , '$hashedPassword' , '$role')";
        if (mysqli_query($conn, $sql)) {
            header("Location: ../HTML/addAdminAndCustomer.php?successAdd=1");
            exit;
        } 
        else {
            header("Location: ../HTML/addAdminAndCustomer.php?successAdd=0");
            exit;
        }
    }
    else{
        $sql = "SELECT * FROM users WHERE User_id = '$id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

        $username = $_POST['Username'] ?: $row['Name'];
        $email = $_POST['Email'] ?: $row['Email'];
        $role = $_POST['Role'] ?: $row['Role'];
        if (!empty($_POST['Password'])) {
            $hashedPassword = password_hash($_POST['Password'], PASSWORD_BCRYPT);
        }
        else $hashedPassword = $row['Password'];

        if($_POST['Email'] != $row['Email'] && !empty($_POST['Email'])){
            $sql = "SELECT * FROM users WHERE Email = '$email'";
            $result =mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)){
                $email = $row['Email'];
                header("Location: ../HTML/addAdminAndCustomer.php?samEmail=1&id=$id");
                exit;
            }
        }
        $sql = "UPDATE users SET Name='$username' ,Email= '$email', Password ='$hashedPassword', Role ='$role' WHERE User_id = '$id'";
        if(mysqli_query($conn,$sql)){
            header("Location: ../HTML/dashboard.php");
            exit;
        } 
        else {
            header("Location: ../HTML/addAdminAndCustomer.php?successUpdate=0");
            exit;
        }

    }
}
?>