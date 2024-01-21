<?php
include('connection.php');

function getProductDetails($productId) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $productId);
    $stmt->execute();

    if ($stmt->error) {
        die("Error in executing statement: " . $stmt->error);
    }

    $result = $stmt->get_result();
    
    // Check if a row is fetched
    if ($result->num_rows > 0) {
        $productDetails = $result->fetch_assoc();
        return $productDetails;
    } else {
        // Handle the case when the product is not found
        return null;
    }
}

// Fetch all products
$stmt = $conn->prepare("SELECT * FROM products");

if (!$stmt) {
    die("Error in preparing statement: " . $conn->error);
}

$stmt->execute();

if ($stmt->error) {
    die("Error in executing statement: " . $stmt->error);
}

$products = $stmt->get_result();

// Check if any products are fetched
if ($products->num_rows > 0) {
    // You can handle the fetched products as needed
    // Example: $allProducts = $products->fetch_all(MYSQLI_ASSOC);
} else {
    // Handle the case when no products are found
}
?>
