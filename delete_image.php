<?php
session_start();
require_once('DBconnect.php');

$p_username = $_SESSION["user"];
$image = $_GET["img"];
$product_name = $_GET["prod"];

// Fetch the image path from the database
$sql_fetch = "SELECT image FROM product_images WHERE image = '$image' AND p_username = '$p_username' AND product_name = '$product_name'";
$result_fetch = mysqli_query($conn, $sql_fetch);

if (mysqli_num_rows($result_fetch) > 0) {
    $row = mysqli_fetch_assoc($result_fetch);
    $image_path = $row['image'];

    // Delete the image from the database
    $sql_delete = "DELETE FROM product_images WHERE image = '$image' AND p_username = '$p_username' AND product_name = '$product_name'";
    if (mysqli_query($conn, $sql_delete)) {
        // Delete the image file from the server
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        echo "<script>alert('Image deleted successfully.'); window.location.href='edit_images_page.php?prod=$product_name';</script>";
    } else {
        echo "<script>alert('Error deleting image: " . mysqli_error($conn) . "'); window.location.href='edit_images_page.php?prod=$product_name';</script>";
    }
} else {
    echo "<script>alert('Image not found.'); window.location.href='edit_images_page.php?prod=$product_name';</script>";
}

mysqli_close($conn);
?>