<?php
    session_start();
    include '../PHP/connection.php';
    include '../PHP/CartFunctions.php';

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['user_id'] ;
        header('Location: ../HTML/login.php');
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $cart_data = getCartItems($user_id);
    $cart_count = getCartCount($user_id);
    $cart_total = getCartTotal($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="../CSS/cartstyle.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">

    <script src="https://kit.fontawesome.com/3f7db2a477.js" crossorigin="anonymous"></script>
</head>
<body>


    <header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>

        <a href="#" class="logo">fleurina.</a>
        <nav class="nav1">
            <a href="../HTML/home.html">home</a>
            <a href="../HTML/product.php">shop</a>
            <a href="../HTML/contact.php">contact</a>
            <a href="../HTML/Cart.php"><i class="fa-solid fa-bag-shopping" ></i> 
            <?php if($cart_count > 0): ?>
                <span class="cart-badge"><?php echo $cart_count; ?></span>
            <?php endif;?> </a>
             
        </nav>
    </header>



    <section class="cart">
        <?php if ($cart_data['item_count'] == 0): ?>
            <div class="empty-cart">
            <h1>Your Shopping Cart is Empty</h1>
            <p>You haven't added any products to your cart yet.</p>
            <a href="product.php" class="btn-shop">Start Shopping</a>
            </div>

        <?php else: ?>
            <div id="cart-item">
                <h1>Your Shopping Cart</h1>
                <table id="item-table" >
                    <thead class="item-header">
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>

                    <tbody id="items">

                        <?php foreach ($cart_data['items'] as $item): ?>
                            <?php 
                                $item_total = $item['Price'] * $item['Quantity'];
                                $image_path = "../images/" . $item['pImg'];
                                ?>
                            
                            <tr data-cart-id="<?php echo $item['C_Id']; ?>">

                                <td id="item" ><img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($item['Name']); ?>"><p style="color: black;"><?php echo htmlspecialchars($item['Name']);?></p></td>
                                <td id="item-price">$<?php echo number_format($item['Price'], 2);?> </td>
                                
                                <td id="item-quantity">
                                    <form method="post" action="../PHP/update_cart.php" class="quantity-form">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['C_Id']; ?>">
                                    <input type="hidden" name="new_quantity" value="3">
                                    <div class="counter-container">
                                                            <button id="decrement-btn" class="counter-btn minus" type="submit" name="action" value="decrease">-</button>
                                                            <input type="number" name="quantity" id="quantity-<?php echo $item['C_Id']; ?>" class="counter-input" value="<?php echo $item['Quantity']; ?>" min="1">
                                                            <button id="increment-btn" class="counter-btn plus" type="submit" name="action" value="increase">+</button>
                                                        </div>
                                                        <button type="submit" style="display:none;">Update</button>
                                    </form>
                                </td>

                                <td id="item-total-<?php echo $item['C_Id']; ?>" class="item-total"> $<?php echo number_format($item_total, 2);?> </td>
                                <td id="item-delete">
                                    <form method="post" action="../PHP/remove_cart.php" class="delete-form">
                                        <input type="hidden" name="cart_id" value="<?php echo $item['C_Id']; ?>">
                                        <button type="submit"  onclick="return confirm('Are you sure you want to remove this item?')" class="delete-btn">
                                            <i class="fa-regular fa-trash-can" style="color: #c19c68;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach;?>
            </tbody>
            </table>       
            </div>

        <div id="cart-total">
            <h1>Cart Totals</h1>
            <table id="total-table">
                <tr>
                    <td>Subtotal:</td>
                    <td id="subtotal">$<?php echo number_format($cart_data['subtotal'], 2); ?>
                </td>
            </tr>

                <tr>
                    <td>Shipping:</td>
                    <td>Free</td>
                </tr>

                <tr id="total">
                    <td>Total:</td>
                    <td id="total-amount">$<?php echo number_format($cart_data['subtotal'], 2); ?></td>
                </tr>
            </table>

            <form action="../PHP/CheckBill.php" method="POST" class="add-to-cart-form">
            <input type="hidden" name="product_id" value="<?php echo $row['P_Id']; ?>">
            <button id="CheckoutBtn" >Proceed to Checkout</button>
            </form>

        </div>
    <?php endif; ?>
    </section>




    <section class="last">
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
    <div class="rights" align="center"><br> &copf; 2025 the flourina shop all rights reserved </div>
</section>

<script src="../JS/quantityButton.js"></script>
</body>
</html>