<?php include('layouts/header.php') ?>


    <section class="hero p-1">
        <h4>Trades-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>on all products</h1>
        <p>save more with coupons & up to 70% off!</p>
        <button><a href="shop.html">shop now</a></button>
    </section>
    <section class="feature flexcenter p-1 m-1 ">
        <div class="fe-box p-1 m-1">
            <img src="" alt="feature 1">
            <h6>abour feature</h6>
        </div>
        <div class="fe-box p-1 m-1">
            <img src="" alt="feature 2">
            <h6>abour feature</h6>
        </div>
        <div class="fe-box p-1 m-1">
            <img src="" alt="feature 3">
            <h6>abour feature</h6>
        </div>
        <div class="fe-box p-1 m-1">
            <img src="" alt="feature 4">
            <h6>abour feature</h6>
        </div>
        <div class="fe-box p-1 m-1">
            <img src="" alt="feature 5">
            <h6>abour feature</h6>
        </div>
        <div class="fe-box p-1 m-1">
            <img src="" alt="feature 6">
            <h6>abour feature</h6>
        </div>
    </section>
    <section id="product1" class="p-1">
        <h2>Featured product</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">

            <?php include('server/featured_products.php'); ?>

            <?php while ($row = $featured_products->fetch_assoc()) { ?>
                
                <div class="pro" onclick="window.location.href='<?php echo 'product.php?product_id=' . $row['product_id']; ?>';">
                    <img src="<?php echo $row['product_image']; ?>" alt="">
                    <div class="des">
                        <span><?php echo $row['product_brand']; ?></span>
                        <h5><?php echo $row['product_name']; ?></h5>
                        <div class="star">
                            <!-- ... (your existing star rating code) ... -->
                        </div>
                        <h4><?php echo $row['product_price']; ?></h4>
                    </div>
                    <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
                </div>
            <?php } ?>
        </div>
    </section>
    <script>
   function redirectToProduct(productId) {
        window.location.href = 'product.php?id=' + productId;
    }
    </script>
    <section id="banner" class="m-1 flexcenter">
        <h4>Repair Services</h4>
        <h2>Up to <span> 70% off</span> - All t-shirts & accessories</h2>
        <button class="normal">Explore More</button>
    </section>
    

    <?php include('layouts/footer.php') ?>