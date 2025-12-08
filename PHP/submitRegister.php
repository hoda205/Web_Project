<?php
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
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../HTML/home.html?registered=1");
        exit;
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../HTML/register.php?error=unknown");
        exit;
    }
}
?>
