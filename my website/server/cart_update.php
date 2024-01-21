<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_cart') {
    // Check if necessary parameters are set
    if (isset($_POST['product_id'], $_POST['product_quantity'], $_POST['product_price'], $_POST['product_name'], $_POST['product_image'])) {
        // Update the cart on the server
        updateCartOnServer();
    } else {
        // Return an error response if parameters are missing
        echo json_encode(['error' => 'Missing parameters']);
    }
}

function updateCartOnServer() {
    // Your existing CalculateTotalCart() and any other necessary functions go here

    // Example: Recalculate the cart total
    CalculateTotalCart();

    // Example: Send back the updated cart total as a response
    echo json_encode(['status' => 'success', 'cart_total' => getCartTotal()]);
}
?>
