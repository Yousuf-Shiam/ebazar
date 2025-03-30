<?php
session_start();
require_once "DBconnect.php";

$username1 = $_SESSION["user"];

// Start transaction
mysqli_begin_transaction($conn);

try {
    // Fetch cart items for the logged-in user
    $sql = "SELECT c.*, p.price, p.quantity AS available_quantity FROM cart c JOIN products p ON c.product_name = p.product_name WHERE c.u_username = '$username1'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $product_name = $row["product_name"];
        $p_username = $row["p_username"];
        $c_quantity = $row["c_quantity"];
        $available_quantity = $row["available_quantity"];

        if ($c_quantity > $available_quantity) {
            throw new Exception("Insufficient stock for product: $product_name");
        }

        // Update product quantity
        $new_quantity = $available_quantity - $c_quantity;
        $sql_update_product = "UPDATE products SET quantity = '$new_quantity' WHERE product_name = '$product_name' AND username = '$p_username'";
        if (!mysqli_query($conn, $sql_update_product)) {
            throw new Exception("Error updating product quantity: " . mysqli_error($conn));
        }

        // Update payment status in cart
        $sql_update_cart = "UPDATE cart SET payment_status = 'Paid' WHERE u_username = '$username1' AND product_name = '$product_name' AND p_username = '$p_username'";
        if (!mysqli_query($conn, $sql_update_cart)) {
            throw new Exception("Error updating cart payment status: " . mysqli_error($conn));
        }
    }

    // Commit transaction
    mysqli_commit($conn);
    echo "<script>alert('Checkout successful!'); window.location.href='home_page.php';</script>";
} catch (Exception $e) {
    // Rollback transaction
    mysqli_rollback($conn);
    echo "<script>alert('Checkout failed: " . $e->getMessage() . "'); window.location.href='cart_page.php';</script>";
}

mysqli_close($conn);
?>