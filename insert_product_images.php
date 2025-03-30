<?php
session_start();
require_once('DBconnect.php');

$p_username = $_SESSION["user"];
$product_name = $_GET["prod"];

if(isset($_FILES['images'])){
    // Check if any files were selected
    if(empty($_FILES['images']['name'][0])) {
        echo "<script>alert('No files selected.'); window.location.href='edit_images_page.php?prod=$product_name';</script>";
        exit();
    }

    foreach($_FILES['images']['tmp_name'] as $key => $tmp_name){
        $file_name = $_FILES['images']['name'][$key];
        $file_tmp = $_FILES['images']['tmp_name'][$key];
        $file_path = "./product_images/" . $file_name;

        // Check if the image already exists in the database
        $sql_check = "SELECT * FROM product_images WHERE p_username = '$p_username' AND product_name = '$product_name' AND image = '$file_path'";
        $check_result = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Image already exists: $file_name'); window.location.href='edit_images_page.php?prod=$product_name';</script>";
            continue;
        }

        // Move the uploaded file to the desired directory
        if(move_uploaded_file($file_tmp, $file_path)){
            // Insert image path into the product_images table
            $sql = "INSERT INTO product_images (p_username, product_name, image) VALUES ('$p_username', '$product_name', '$file_path')";
            $image_result = mysqli_query($conn, $sql);

            if(!$image_result){
                echo "Error inserting image: " . mysqli_error($conn);
            }
        } else {
            echo "Error moving uploaded file.";
        }
    }
    echo "<script>alert('Images uploaded successfully.'); window.location.href='edit_images_page.php?prod=$product_name';</script>";
} else {
    echo "<script>alert('No files selected.'); window.location.href='edit_images_page.php?prod=$product_name';</script>";
}
?>