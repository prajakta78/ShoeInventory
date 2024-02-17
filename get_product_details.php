<?php
// Connect to the database
include('include/conn.php');
session_start();
$username = $_SESSION['name'];

if (isset($_POST['product_code'])) {
    $productCode = $_POST['product_code'];
    
    $sql = "SELECT * FROM products WHERE product_code = '$productCode' AND created_by = '$username'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo json_encode($product);
    } else {
        http_response_code(400);
        die("Product not found");
    }
}

// Close the database connection
// $conn->close();
?>
