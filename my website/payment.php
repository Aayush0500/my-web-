<?php


session_start();


?>

<?php include('layouts/header.php') ?>














<div class="separator"></div>

<div id="payments">
    <p class="text-align"><?php if (isset($_GET['order_status'])) {
                                echo $_GET['order_status'];
                            } ?></p>
</div>
<div class="separator"></div>

<div class="container p-0">
    <div class="card px-4">
        <p class="h8 py-3" style="text-decoration: underline;">Payment Details</p>
        <div class="row gx-3">
            <div class="col-12">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Person Name</p>
                    <input class="form-control mb-3" type="text" placeholder="Name" value="Barry Allen">
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Card Number</p>
                    <input class="form-control mb-3" type="text" placeholder="1234 5678 435678">
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Expiry</p>
                    <input class="form-control mb-3" type="text" placeholder="MM/YYYY">
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex flex-column">
                    <p class="text mb-1">CVV/CVC</p>
                    <input class="form-control mb-3 pt-2 " type="password" placeholder="***">
                </div>
            </div>

            <div class="col-12">
                <p class="text-align">
                    <?php if (isset($_GET['order_status'])) {
                        echo $_GET['order_status'];
                    } ?>
                </p>
                <div class="btn btn-primary mb-3">

                    <span class="ps-3">pay:<?php if (isset($_SESSION['total'])) {echo $_SESSION['total'];} ?>
                        <?php if (isset($_SESSION['total']) && $_SESSION['total'] != 0 ){ ?>
                           <?php }else { ?>
                            <p>you don't have an order</p>







                            <?php } ?>
                    </span>
                 
                    
                    
                    
                        <?php if (isset($_GET['order_status']) && $_GET['order_status'] == "not paid") {?>
                            <?php }?>
                            <span class="fas fa-arrow-right"></span>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('layouts/footer.php') ?>