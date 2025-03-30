<?php
session_start();
require_once "DBconnect.php";

$username1 = $_SESSION["user"];
$product_name = $_POST["product_name"];
$p_username = $_POST["p_username"];
$c_quantity = $_POST["c_quantity"];

// Fetch the available quantity from the products table
$sql_product = "SELECT quantity FROM products WHERE product_name = '$product_name' AND username = '$p_username'";
$result_product = mysqli_query($conn, $sql_product);
$product = mysqli_fetch_assoc($result_product);

if ($product) {
    $available_quantity = $product['quantity'];

    // Check if the requested quantity exceeds the available quantity
    if ($c_quantity > $available_quantity) {
        echo "<script>alert('Requested quantity exceeds available stock.'); window.location.href='cart_page.php';</script>";
    } else {
        // Update the cart with the new quantity
        $sql_update = "UPDATE cart SET c_quantity = '$c_quantity' WHERE u_username = '$username1' AND product_name = '$product_name' AND p_username = '$p_username'";
        if (mysqli_query($conn, $sql_update)) {
            header("Location: cart_page.php");
        } else {
            echo "Error updating cart: " . mysqli_error($conn);
        }
    }
} else {
    echo "Product not found.";
}

mysqli_close($conn);
?>