<?php
    session_start();
    include '../PHP/connection.php';
    include '../PHP/CartFunctions.php';

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
    <title>Document</title>

    <link rel="stylesheet" href="../CSS/bootstrap.min.css">

    <script src="https://kit.fontawesome.com/3f7db2a477.js" crossorigin="anonymous"></script>

</head>
<body>

    <style>
        *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-size: 16px;
        font-family:  'playfair display',serif; 
        outline: none;
        border: none;
        text-transform: capitalize;
        text-decoration: none;
        transition: .5s linear;
        
    }
    button {
                background: none;
                border: none;
                outline: none;
                box-shadow: none;
    }
    html{
        font-size: 62.5%;
        scroll-behavior: smooth;
        scroll-padding-top:6rem;
        overflow-x: hidden;
    }

    header { 
        position: fixed;
        top: 0; left:0; right: 0;
        padding: 2rem 9% ;
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: space-between;
        z-index: 1000;
        box-shadow: 0.5rem 1rem rgba(177, 122, 122, 0.1);
        background-color:white;  
    }
    .logo{
        font-size: 3rem;
        color:#f08888a0;
        font-weight: bolder;
        text-decoration: none;
    }

    header .nav1 a , i{ 
        font-size: 2rem;
        text-decoration: none;
        color: black;
        padding: 0 1.5rem;
    }

    .nav1  a:hover{
        color: #f3abab;
        text-decoration: underline #f3abab;
    }


    .nav1 .icon i{
            font-size: 3rem;
            color:#f08888a0;
            font-weight: bolder;
            text-decoration: none;
        }

    header i {
        font-size: 1.8rem;
        color: #e6a8a1;    
        margin-left: 1.5rem;
        cursor: pointer;
        transition: 0.3s ease;
        padding: .6rem;
        border-radius: 50%;
        background-color: #f9e7e7;
    }

    header i:hover {
        color: #d99089;
        transform: scale(1.1);
    }
    .home .content p {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: #fff;
        line-height: 1.6;
        text-shadow: 0 3px 6px rgba(0,0,0,0.3);
        display: block;
        margin-top: 1rem;
    }


    header #toggler{
        display: none;
    }
    header .fa-bars{
        font-size: 3rem;
        color:#f08888a0;
        border-radius: .5rem;
        padding: .5rem 1.5rem;
        cursor: pointer;
        border:.1rem solid rgba(205, 57, 57, 0.3);
        display: none;
    }

    @media (max-width: 991px) {
        html{
            font-size: 55%;
        }
        header{
            padding: 2rem;
        }
        
    }
    @media (max-width:800px) {
        header .fa-bars{
            display: block;
        }
        
        header .nav1{
            position:absolute;
            top: 100%; left:0; right: 0;
            border-top: .1rem solid rgb(0, 0,0,.1);
            clip-path: polygon(0 0,100% 0,100% 0,0 0);
        }
        header #toggler:checked ~ .nav1{
            clip-path: polygon(0 0,100% 0,100% 100%, 0% 100%);
        }
        header .nav1  a{
                margin: 1.5rem;
                padding: 1.5rem;
                border: .1rem solid rgb(0, 0,0,.1);  ;
                display: block;
                background-color: #fae9e0;
                border-radius: 1rem;
            }
        
    }
    .cart-badge {
    background-color: #f3abab;;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    position: absolute;
    top: 20px;
    right: 120px;
}

@media (max-width:470px) {
    
    html{
            font-size: 50%;
        }
        header{
            padding: 2rem;
            .cart-badge{
                display: none;
            }
        }
        #icon{
    padding:  1rem; 
    
    }}
    </style>

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
    
</body>
</html>

