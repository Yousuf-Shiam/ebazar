<?php
session_start();
$username1 = $_SESSION['user'];

if ($username1 != 'admin_yoshi') {
    header("Location: login_page.php");
    exit();
}

require_once('DBconnect.php');

$username = $_GET['acc'];
$product_name = $_GET['prod'];

$sql3 = "DELETE FROM products WHERE username = '$username' AND product_name = '$product_name'";
$result3 = mysqli_query($conn, $sql3);

if(mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Product deleted successfully.'); window.location.href='admin_dashboard.php';</script>";
} else {
    echo "<script>alert('Error deleting product: " . mysqli_error($conn) . "'); window.location.href='admin_dashboard.php';</script>";
}

mysqli_close($conn);
?>