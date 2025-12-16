<?php 
session_start();
    include '../PHP/connection.php';
    include '../PHP/CartFunctions.php';
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $cart_count = getCartCount($user_id); 
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport">
    <title>florine website</title>
    <link rel="stylesheet" href="../CSS/homeStyle.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/navStyle.css">
    <link rel="stylesheet" href="../CSS/contectStyle.css">
    

    <script src="https://kit.fontawesome.com/3f7db2a477.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- <header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>

        <a href="#" class="logo">fleurina.</a>
        <nav class="nav1">
            <a href="home.html">home</a></li>
            <a href="../HTML/product.php">shop</a></li>
            <a href="contact.php"> contact</a></li>
            <a href="../HTML/Cart.php">cart</a></li>
            <a href="../HTML/login.php">login/sign up</a></li>
            <i class="fa-solid fa-bag-shopping"></i>
        </nav>
    </header> -->
    <?php 
include 'navbar.php';
?>
    <section class="home">
        <div class="content">
            <h3>Fresh Flowers,<br> Delivered with Love</h3>
            <p>Discover the bueauty of nature with our exquisite flower arrangements, perfect for every occasion.</p>
            <form action="./product.php" method="post">
                <button class="btn" >Shop Now</button>
            </form>

        </div>
    </section>
    </section>
    <section class="favorites py-5 text-center">
        <h6 class="text-muted mb-2">Featured Collections / Best Sellers</h6>
        <h2 class="section-title mb-5">Our Favorites</h2>

        <div class="container">
            <div class="row g-4">

                <!-- Card 1 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="fav-card p-3">
                        <img src="../images/home1.jpg" class="img-fluid rounded" alt="">
                        <h5 class="mt-3">Blush Radiance Bouquet</h5>
                        <p class="price">$65.00</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="fav-card p-3">
                        <img src="../images/home2.jpg" class="img-fluid rounded" alt="">
                        <h5 class="mt-3">Classic Elegance Box</h5>
                        <p class="price">$80.00</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="fav-card p-3">
                        <img src="../images/home3.jpg" class="img-fluid rounded" alt="">
                        <h5 class="mt-3">Spring Awakening Basket</h5>
                        <p class="price">$75.00</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="fav-card p-3">
                        <img src="../images/home4.jpg" class="img-fluid rounded" alt="">
                        <h5 class="mt-3">Sweetheart Surprise Arrangement</h5>
                        <p class="price">$78.00</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="about-section py-5" id="about">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6 mb-4">
                    <h2 class="section-title">About Fleurina</h2>
                    <p class="about-text">
                        At Fleurina, we believe in the language of flowers.
                        Our mission is to craft exquisite, hand-tied bouquets
                        that convey your deepest emotions and brighten every occasion.
                        We source the freshest blooms and arrange them with love and care,
                        ensuring a touch of elegance in every delivery.
                    </p>
                </div>

                <div class="col-md-6 text-center">
                    <img src="../images/about.jpg" class="img-fluid rounded shadow" alt="flowers" id="about">
                </div>

            </div>
        </div>
    </section>

    <section class="testimonials-section py-5">
        <div class="container text-center">

            <h2 class="section-title mb-5">What Our Customers Say</h2>

            <div class="row justify-content-center">

                <div class="col-md-5 mb-4">
                    <div class="testimonial-card pink-card p-4 shadow rounded">
                        <div class="d-flex align-items-center mb-3">
                            <img src="../images/login_g.jpg" class="user-img rounded-circle" alt="">
                            <h5 class="ms-3">Emily S.</h5>
                        </div>

                        <p>
                            Absolutely stunning arrangements! The flowers were incredibly fresh and arrived
                            on time for my anniversary. Fleurina exceeded my expectations. Highly recommend!
                        </p>

                        <div class="stars">★★★★★</div>
                    </div>
                </div>

                <div class="col-md-5 mb-4">
                    <div class="testimonial-card green-card p-4 shadow rounded">
                        <div class="d-flex align-items-center mb-3">
                            <img src="../images/login3.jpg" class="user-img rounded-circle" alt="">
                            <h5 class="ms-3">David and Sarah L.</h5>
                        </div>

                        <p>
                            Fleurina made our wedding day even more special with their beautiful floral designs.
                            Every detail was perfect, from the bouquets to the table centerpieces.
                            Thank you for adding a touch of magic!
                        </p>

                        <div class="stars">★★★★★</div>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <!-- <section class="last">
        <footer>
            <div>
                <h4> flourina</h4>
                <pre>123 flower lane, flower city,10001
    contact@fleurina shop.org
  </pre>
            </div>

            <div id="box">

                <h4>quick links</h4>
                <ul>
                    <li><a href="#">about</a></li>
                    <li><a href="#">cart</a></li>
                    <li><a href="#">shop</a></li>
                    <li><a href="#">contact Us</a></li>
                </ul>
            </div>

            <div id="icon">
                <h4>follow us</h4>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-square-facebook"></i>
            </div>
        </footer>
        <div class="rights" align="center"> <br> &copf; 2025 the flourina shop all rights reserved </div>
    </section> -->
    <?php
    include 'footer.php';
    ?>
    <script src="../JS/bootstrap.bundle.min.js"></script>
</body>