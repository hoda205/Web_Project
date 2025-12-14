
<?php
// PHP block at the top to handle messages
$errorMessage = "";
$successMessage = "";

if (isset($_GET['error'])) {
    if ($_GET['error'] == "password") {
        $errorMessage = "Passwords do not match!";
    } elseif ($_GET['error'] == "email") {
        $errorMessage = "Email already registered!";
    } else {
        $errorMessage = "Something went wrong. Please try again.";
    }
}

if (isset($_GET['registered']) && $_GET['registered'] == 1) {
    $successMessage = "Registration successful!";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleurina Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3f7db2a477.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../CSS/login.css">
</head>

<body>

<header>
    <div class="header-left">
        <a href="#" class="logo">Fleurina</a>
        <a href="../HTML/home.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Back to Home</a>
    </div>
</header>

<section class="login-container">
    <div class="login-box">
        <h1>Create An Account</h1>
        <p class="subtitle">join the Fleurina family</p>


         <!-- Display PHP messages -->
        <?php if($errorMessage): ?>
            <p style="color:red; font-size:1.3rem;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <?php if($successMessage): ?>
            <p style="color:green; font-size:1.3rem;"><?php echo $successMessage; ?></p>
        <?php endif; ?>


        <form action="../PHP/submitRegister.php" method="post">
            <div class="input-group">
                <i class="fa-regular fa-user"></i>
                <input type="text" placeholder="Full Name" name="username" required>
            </div>
            <div class="input-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" placeholder="Email Address" name="email" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Password" name="password" required>
                
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Confirm Password" name="confirm_password" required>
                
            </div>

            <button type="submit" name="register" class="login-btn">Register</button>

            <p class="register-text">
                Already have an account? <a href="login.php">Login</a>
            </p>
        </form>
    </div>
</section>



    <footer class="footer">
    <div class="footer-content">
        <p>Copyright © 2022 Fleurina – noors</p>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
    </div>
</footer>
 
</body>
</html>