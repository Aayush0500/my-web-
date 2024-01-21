<?php include('layouts/header.php') ?>



    <section class="page-header p-1">
        <h2>#StayHome</h2>
        <p>save more with coupons & up to 70% off!</p>
    </section>
    <section id="product1" class="p-1">
        <div class="pro-container">
        <?php include('server/get_product.php'); ?>

        <?php while ($row = $products->fetch_assoc()) { ?>
    <div class="pro" onclick="redirectToProduct(<?php echo $row['product_id']; ?>)">
                <img src="<?php echo $row['product_image']; ?>"
                    alt="">
                <div class="des">
                    <span><?php echo $row['product_brand']; ?></span>
                    <h5><?php echo $row['product_name']; ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4><?php echo $row['product_price']; ?></h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            <?php } ?>
        </div>
    </section>
    <section id="pagination" class="section-p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fal fa-long-arrow-alt-right"></i></a>
    </section>


    <?php include('layouts/footer.php') ?>
