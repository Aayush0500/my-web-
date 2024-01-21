<?php
// Include the connection script to establish a connection to the database
include('connection.php');

// Prepare a query to select all records from the "featured_products" table
$stmt = $conn->prepare("SELECT * FROM featured_products ");

// Execute the prepared statement
$stmt->execute();

// Get the result set
$featured_products = $stmt->get_result();
?>


