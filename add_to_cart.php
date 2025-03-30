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
        echo "<script>alert('Requested quantity exceeds available stock.'); window.location.href='home_page.php';</script>";
    } else {
        // Check if the product is already in the cart
        $sql_check = "SELECT * FROM cart WHERE u_username = '$username1' AND product_name = '$product_name' AND p_username = '$p_username'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Fetch the current quantity in the cart
            $row = mysqli_fetch_assoc($result_check);
            $current_quantity = $row['c_quantity'];
            $new_quantity = $current_quantity + $c_quantity;

            // Check if the new quantity exceeds the available quantity
            if ($new_quantity > $available_quantity) {
                echo "<script>alert('Requested quantity exceeds available stock.'); window.location.href='home_page.php';</script>";
            } else {
                // Update the quantity if the product is already in the cart
                $sql_update = "UPDATE cart SET c_quantity = '$new_quantity' WHERE u_username = '$username1' AND product_name = '$product_name' AND p_username = '$p_username'";
                if (mysqli_query($conn, $sql_update)) {
                    header("Location: cart_page.php");
                } else {
                    echo "Error updating cart: " . mysqli_error($conn);
                }
            }
        } else {
            // Insert the product into the cart
            $sql_insert = "INSERT INTO cart (u_username, p_username, product_name, c_quantity, payment_status) VALUES ('$username1', '$p_username', '$product_name', '$c_quantity', 'Pending')";
            if (mysqli_query($conn, $sql_insert)) {
                header("Location: cart_page.php");
            } else {
                echo "Error adding to cart: " . mysqli_error($conn);
            }
        }
    }
} else {
    echo "Product not found.";
}

mysqli_close($conn);
?>