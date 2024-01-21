<?php
include('server/connection.php');

/*
not paid
shipped
delivered


*/


if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id =?");

    $stmt->bind_param("i", $order_id);

    $stmt->execute();

    $order_details = $stmt->get_result();
} else {
    header("location: account.php");
    exit;
}


?>




<?php include('layouts/header.php') ?>











    <section id="your-order-table" class="p-1">
        <table>
            <thead class="thead-dark">
                <tr>
                    <td>Image</td>
                    <td style="width: 20%;">product</td>
                    <td style="width: 50%;">price</td>
                    <td style="width: 30%;">quantity</td>
                </tr>
            </thead>
            <?php while ($row = $order_details->fetch_assoc()) { ?>
                <tr>
                    <td><img style="width: 70px;" src="<?php echo $row['product_image']; ?>" alt=""></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['product_price']; ?></td>
                    <td><?php echo $row['product_quantity']; ?></td>
                <?php } ?>
        </table>

        <?php if ($order_status == "not paid") { ?>
            <form style="float: center; margin-top: 20px;" action="payment.php" method="post">
                <input style="margin: 0 auto; width: 125px;" type="submit" class="btn btn-primary" value="Pay Now" />
            </form>
        <?php } ?>
        

    </section>






    <?php include('layouts/footer.php') ?>
