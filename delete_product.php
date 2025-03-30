<?php
session_start();
$username = $_SESSION['user'];
$product_name = $_GET['prod'];

require_once('DBconnect.php');

// First, delete from the product_images table
// $sql1 = "DELETE FROM product_images WHERE p_username = '$username' AND product_name = '$product_name'";
// $result1 = mysqli_query($conn, $sql1);

// //Then, delete from the cart table
// $sql2 = "DELETE FROM cart WHERE p_username = '$username' AND product_name = '$product_name'";
// $result2 = mysqli_query($conn, $sql2);

// Finally, delete from the products table
$sql3 = "DELETE FROM products WHERE username = '$username' AND product_name = '$product_name'";
$result3 = mysqli_query($conn, $sql3);

if(mysqli_affected_rows($conn) > 0) {
    header("Location: edit_products.php");
} else {
    echo "Error deleting product: " . mysqli_error($conn);
}
?>