<?php
session_start();
require_once "DBconnect.php";

$username1 = $_SESSION["user"];
$product_name = $_POST["product_name"];
$p_username = $_POST["p_username"];

// Remove the product from the cart
$sql_remove = "DELETE FROM cart WHERE u_username = '$username1' AND product_name = '$product_name' AND p_username = '$p_username'";
if (mysqli_query($conn, $sql_remove)) {
    header("Location: cart_page.php");
} else {
    echo "Error removing item from cart: " . mysqli_error($conn);
}

mysqli_close($conn);
?>