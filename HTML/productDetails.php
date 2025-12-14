<?php
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
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE P_Id = '$id'";
    $desc = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($desc);
    $sql = "SELECT * FROM products WHERE P_Id != '$id' LIMIT 3";
    $result = mysqli_query($conn, $sql);

}
else header('Location: product.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fleurina - Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3f7db2a477.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS/bootstrap.min.css"></head>
    <link rel="stylesheet" href="../CSS/productDetailsStyle.css">
    <link rel="stylesheet" href="../CSS/navStyle.css">

<body>

<!-- ===== NAVBAR ===== -->
<!-- <header class="nav">
  <h2 class="logo">Fleurina</h2>
  <ul class="menu">
    <li>Home</li>
    <li>Product</li>
    <li class="active">Fleurina</li>
    <li>Shop</li>
    <li>Contact</li>
  </ul>
</header> -->
<?php 
include 'navbar.php';
?>


<!-- ===== MAIN ===== -->
<div class="container main">

  <div class="row">

    <!-- صورة المنتج -->
    <div class="col-md-6">
      <div class="image-box">
        <img src="../images/<?php echo $row['pImg']; ?>" alt="<?php echo $row['Name']; ?>">
      </div>
    </div>

    <!-- تفاصيل المنتج -->
    <div class="col-md-6">
      <h1 class="title"><?php echo $row['Name']; ?></h1>
      <p class="price">$<?php echo $row['Price']; ?></p>

      <p class="desc">
        <?php echo $row['Describtion']; ?>
      </p>
        <form action="../PHP/addToCart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $row['P_Id']; ?>">
            <input type="hidden" name="details" value="1">
            <button class="cart-btn">Add to Cart</button>
        </form>
        
    <?php if (mysqli_num_rows($result) > 0) { ?>
    
    <h3 class="like-title">You May Also Like</h3>
    <div class="row">

    <?php while ($product = mysqli_fetch_assoc($result)) { ?>
        
        <div class="col-md-4">
            <div class="card mb-3">
                <img src="../images/<?php echo $product['pImg']; ?>" class="card-img-top" alt="<?php echo $product['Name']; ?>">
                
                <div class="card-body text-center">
                    <h5 class="card-title fs-1"><?php echo $product['Name']; ?></h5>
                    <p class="card-text fs-3">$<?php echo $product['Price']; ?></p>
                    
                    <a href="productDetails.php?id=<?php echo $product['P_Id']; ?>" 
                        class="btn btn-outline-dark btn-sm fs-3">
                        View Product
                    </a>
                </div>
            </div>
        </div>

    <?php } ?>

    </div>

<?php } ?>

       </div>
</div>
</div>
<!-- ===== FOOTER ===== -->
<footer class="footer">
  © 2023 Fleurina. All rights reserved
</footer>

</body>
</html>