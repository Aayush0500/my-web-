<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gm store</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="css files/account.css">
    <link rel="stylesheet" href="css files/cart.css">
    <link rel="stylesheet" href="css files/checkout.css">
    <link rel="stylesheet" href="css files/extra.css">
    <link rel="stylesheet" href="css files/home.css">
    <link rel="stylesheet" href="css files/login.css">
    <link rel="stylesheet" href="css files/media query.css">
    <link rel="stylesheet" href="css files/order_details.css">
    <link rel="stylesheet" href="css files/payment.css">
    <link rel="stylesheet" href="css files/product.css">
    <link rel="stylesheet" href="css files/register.css">
    <link rel="stylesheet" href="css files/shop.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<script src="script.js"></script>

<body>
    <section id="header" class="flex">
        <a href="#"><img src="img/logo 2.jpg" class="logo" alt="logo"></a>
        <div>
            <ul id="navbar" class="flexcenter">
                <li class="close-icon" onclick="closeNavbar()"><i class="fal fa-times"></i></li>
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <!-- <li><a href="blog.html">Blog</a></li> -->
                <!-- <li><a href="about.html">About</a></li> -->
                <!-- <li><a href="contact.html">Contact us</a></li> -->
                <li><a href="cart.php"><i class="fal fa-shopping-cart"></i></a></li>
                <li><a href="account.php"><i class="fal fa-user"></i></a></li>

            </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent" onclick="toggleNavbar()"></i>
            <a href="cart.php"><i class="fal fa-shopping-cart cart2"></i></a>
        </div>
    </section>