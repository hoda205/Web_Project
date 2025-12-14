<?php
session_start();
include 'connection.php';

if (isset($_POST['register'])) {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
         header("Location: ../HTML/register.php?error=password");
        exit;
    }

    // Check if email is already registered
    $checkQuery = "SELECT Email FROM users WHERE Email = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);
        header("Location: ../HTML/register.php?error=email");
        exit;
    }
    mysqli_stmt_close($stmt);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into the database
    $query = "INSERT INTO `users`(`Name`, `Email`, `Password`) VALUES ( ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        // Log the user in immediately after successful registration
        $user_id = mysqli_insert_id($conn);
        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'customer';

        // Create a pending order for this new user (if not created elsewhere)
        $orderSql = "INSERT INTO `order` (Total, User_Id, Status) VALUES (0, ?, 'Pending')";
        $orderStmt = mysqli_prepare($conn, $orderSql);
        mysqli_stmt_bind_param($orderStmt, "i", $user_id);
        mysqli_stmt_execute($orderStmt);
        mysqli_stmt_close($orderStmt);

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../HTML/home.php?registered=1");
        exit;
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../HTML/register.php?error=unknown");
        exit;
    }
}
?>
