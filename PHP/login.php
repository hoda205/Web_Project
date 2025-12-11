<?php
session_start();
include 'connection.php';

if(isset($_POST['mail']) && isset($_POST['pass'])) {
    
    $email = mysqli_real_escape_string($conn, trim($_POST['mail']));
    $password = $_POST['pass'];
    
    // استخدام prepared statements لمنع SQL Injection
    $sql = "SELECT * FROM users WHERE Email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // التحقق من كلمة المرور باستخدام password_verify (إذا كانت مشفرة)
        // إذا كانت كلمة المرور غير مشفرة في قاعدة البيانات:
        // if($password === $row['Password']) {
        
        // الأفضل: إذا كانت مشفرة بـ password_hash()
        if(password_verify($password, $row['Password'])) {
            
            $_SESSION['User_id'] = $row['User_id'];
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['Role'] = $row['Role'];
            
            // توجيه المستخدم حسب الدور
            if($row['Role'] === 'admin' || $row['Role'] === 'Admin') {
                header("Location: ../HTML/dashboard.php");
            } else {
                header("Location: ../HTML/home.html"); // أو صفحة المتجر
            }
            exit();
            
        } else {
            header("Location: ../HTML/login.php?error=1");
            exit();
        }
        
    } else {
        header("Location: ../HTML/login.php?error=1");
        exit();
    }
    
    mysqli_stmt_close($stmt);
    
} else {
    header("Location: ../HTML/login.php");
    exit();
}

mysqli_close($conn);
?>