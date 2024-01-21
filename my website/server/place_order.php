<?php

session_start();

include("connection.php"); // Add missing semicolon and correct include statement

// if user has not logged in
if(!isset($_SESSION['logged_in'])) {
        header("location: ../checkout.php?message=please login/register to place order");
        

        //if user has logged in
}else {

            if (isset($_POST['place_order'])) {

                // 1. get user info and store it in the database

                $name = $_POST['name']; // Remove extra $ symbol
                $email = $_POST['email'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $phone = $_POST['phone'];
                $order_cost = $_SESSION['total'];
                $order_status = "not paid";
                $user_id = $_SESSION['user_id'];
                $order_date = date("Y-m-d H:i:s");

                $stmt = $conn->prepare("INSERT INTO orders(order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) 
                                    VALUES(?,?,?,?,?,?,?)");

                $stmt->bind_param("issssss", $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date); // Correct parameter types

                $stmt_status =  $stmt->execute();

                if (!$stmt_status) {
                header('location: index.php');
                exit;
                }

                // 2. issue a new order and store order info in the database
                $order_id = $stmt->insert_id;

                // 3. get products from the cart and store them in the database

                foreach ($_SESSION['cart'] as $key => $value) {

                    $product = $_SESSION['cart'][$key];
                    $product_id = $product['product_id']; // Correct variable name
                    $product_name = $product['product_name'];
                    $product_price = $product['product_price'];
                    $product_quantity = $product['product_quantity'];
                    $product_image = $product['product_image'];

                    // 4. store each single item in the order_item database
                    $stmt1 = $conn->prepare("INSERT INTO order_items(order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) VALUES(?,?,?,?,?,?,?,?)");

                    $stmt1->bind_param("iissiiis", $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);

                    $stmt1->execute();
                }





                

                // 5. remove everything for this order from the cart delay until payment is done
                // unset($_SESSION['cart']);// Remove the cart from the session

                // 6. inform the user whether everything is fine or there is a problem


                header('location: ../payment.php?order_status="order placed successfully"');









            }
}

?>
