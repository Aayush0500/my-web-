<?php

include('server/connection.php');

if (isset($_GET['product_id'])) {


  $product_id = $_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM featured_products WHERE product_id = ?");
  $stmt->bind_param("i", $_GET['product_id']);

  $stmt->execute();

  $product = $stmt->get_result();


  //no product id is given
} else {

  header('location: index.php');
}
?>





  <?php include('layouts/header.php') ?>










  <section id="prodetails" class="p-1">
  <?php while ($row = $product->fetch_assoc()) { ?>

<div>
      <div class="single-pro-image">
        <img src="<?php echo $row['product_image']; ?>" width="100%" id="MainImg" alt="">
        <div class="small-img-group">
          <div class="small-img-col">
            <img src="<?php echo $row['product_image']; ?>" width="100%" class="small-img" alt="">
          </div>
          <div class="small-img-col">
            <img src="<?php echo $row['product_image']; ?>" width="100%" class="small-img" alt="">
          </div>
          <div class="small-img-col">
            <img src="<?php echo $row['product_image']; ?>" width="100%" class="small-img" alt="">
          </div>
          <div class="small-img-col">
            <img src="<?php echo $row['product_image']; ?>" width="100%" class="small-img" alt="">
          </div>
        </div>
      </div>
<div>
      <div class="single-pro-details">
        <h6><?php echo $row['product_name']; ?></h6>
        <h4>Men's Fashion T Shirt</h4>
        <h2><?php echo $row['product_price']; ?></h2>
        <div class="pro-media-query">
         
          <form method="POST" action="cart.php">
    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
    <select name="product_size">
            <option value="XL" selected>Select Size</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
            <option value="Small">Small</option>
            <option value="Large">Large</option>
          </select>

          <input type="number" name="product_quantity" value="1">
          <button class="normal buy-btn" type="submit">Add To Cart</button>
        </div>
  
        <h4>Product Details</h4>
        <span><?php echo $row['product_description']; ?></span>
      </div>
      </div>
    </form>
    <?php } ?>
  </section>
  <section id="product1" class="p-1">

    <section id="product1" class="p-1">
      <h2>New Arrivals</h2>
      <p>Summer Collection New Mordern Design</p>
      <div class="pro-container">
        <div class="pro">
          <img src="https://github.com/tech2etc/Build-and-Deploy-Ecommerce-Website/blob/main/img/products/f1.jpg?raw=true" alt="">
          <div class="des">
            <span>adidas</span>
            <h5>Cartoon Astronaut T-Shirts</h5>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h4>$78</h4>
          </div>
          <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
        </div>
        <div class="pro">
          <img src="https://github.com/tech2etc/Build-and-Deploy-Ecommerce-Website/blob/main/img/products/f1.jpg?raw=true" alt="">
          <div class="des">
            <span>adidas</span>
            <h5>Cartoon Astronaut T-Shirts</h5>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h4>$78</h4>
          </div>
          <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
        </div>
        <div class="pro">
          <img src="https://github.com/tech2etc/Build-and-Deploy-Ecommerce-Website/blob/main/img/products/f1.jpg?raw=true" alt="">
          <div class="des">
            <span>adidas</span>
            <h5>Cartoon Astronaut T-Shirts</h5>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h4>$78</h4>
          </div>
          <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
        </div>
        <div class="pro">
          <img src="https://github.com/tech2etc/Build-and-Deploy-Ecommerce-Website/blob/main/img/products/f1.jpg?raw=true" alt="">
          <div class="des">
            <span>adidas</span>
            <h5>Cartoon Astronaut T-Shirts</h5>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h4>$78</h4>
          </div>
          <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
        </div>
      </div>
    </section>





    <?php include('layouts/footer.php') ?>
