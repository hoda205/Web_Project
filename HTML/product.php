<?php
include '../PHP/select.php';
session_start();
    include '../PHP/connection.php';
    include '../PHP/CartFunctions.php';

    if (!isset($_SESSION['user_id'])) {
            $_SESSION['user_id'];
            header('Location: ../HTML/login.php');
            exit();
        }
     $user_id = $_SESSION['user_id'];
    $cart_count = getCartCount($user_id);

// Check if user is logged in

$message = '';
$error = '';
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
}
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fleurina - Shop</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <script src="https://kit.fontawesome.com/3f7db2a477.js" crossorigin="anonymous"></script>
    <link href="../CSS/product.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/navStyle.css">
</head>
<body>

<!-- Nav Bar -->
<!-- <nav class="navbar shadow-sm py-3 position-relative">
  <div class="container d-flex justify-content-center align-items-center">
    <ul class="navbar-nav d-flex flex-row gap-5 fw-semibold m-0">
      <li class="nav-item"><a class="nav-link" href="../HTML/home.html">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="../HTML/product.php">Shop</a></li>
      <li class="nav-item"><a class="nav-link" href="../HTML/contact.php">Contact</a></li>
      <li class="nav-item"><a class="nav-link" href="../HTML/Cart.php">Cart</a></li>
    </ul>
    <h1 class="text-success m-0 position-absolute start-0 ps-3">Fleurina</h1>
  </div>
</nav> -->
<?php 
include 'navbar.php';
?>

<!-- Page Title -->
<div class="container text-center my-4">
  <!-- <h2 class="fw-bold text-success">Shop All Flowers</h2> -->
   <h2 class="fw-bold" style="color:#f7b3b3;">Shop All Flowers</h2>
    <?php if ($message): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $message; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      <?php endif; ?>
      
      <?php if ($error): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $error; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      <?php endif; ?>
</div>

<!-- Products Grid -->
<div class="container my-4">
  <div class="row g-4">

    <?php while($row = mysqli_fetch_assoc($products)): ?>

      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card card-product">
          
          <div class="img-box">
            <img src="../images/<?php echo $row['pImg']; ?>" alt="<?php echo $row['Name']; ?>">
          </div>

          <div class="card-body text-center">
            <h5 class="card-title fs-1"><?php echo $row['Name']; ?></h5>

            <!-- <div class="mb-2">
              <span class="price fs-3">$<?php echo $row['Price']; ?></span>
            </div> -->
            <div class="mb-2">
              <span class="price fs-3 text-dark fw-bold">
                $<?php echo $row['Price']; ?>
              </span>
            </div>


            <form action="../PHP/addToCart.php" method="POST" class="add-to-cart-form">
              <input type="hidden" name="product_id" value="<?php echo $row['P_Id']; ?>">
              <!-- <button type="submit" class="btn btn-success w-100 fs-3">Add to Cart</button> -->
               <button 
                type="submit" 
                class="btn w-100 fs-3"
                style="background-color:#f7b3b3; color:white;"
                onmouseover="this.style.backgroundColor='#f39aa5'"
                onmouseout="this.style.backgroundColor='#f7b3b3'">
                Add to Cart
              </button>

            </form>

             <!-- Details Button -->
            <a href="productDetails.php?id=<?php echo $row['P_Id']; ?>" 
               class="btn btn-outline-secondary w-100 fs-3 mt-1">
              View Details
            </a>

          </div>

        </div>
      </div>

    <?php endwhile; ?>

  </div>
</div>

<!-- Footer -->
<footer class="footer2 d-flex justify-content-center align-items-center">
  <p class="mb-0 py-3"> &copy; 2024 Fleurina. All rights reserved.</p>
</footer>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>