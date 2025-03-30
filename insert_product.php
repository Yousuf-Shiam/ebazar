<?php
session_start();
require_once('DBconnect.php');

if(isset($_POST['product_name']) && isset($_POST['type']) && isset($_POST['price']) && isset($_POST['quantity'])){
    $product_name = $_POST['product_name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $username = $_SESSION['user']; // Assuming the username is stored in the session

    // Insert product details into the products table
    $sql = "INSERT INTO products (product_name, type, price, quantity, username) VALUES ('$product_name', '$type', '$price', '$quantity', '$username')";
    $result = mysqli_query($conn, $sql);

    if($result){
        // Handle file uploads
        if(isset($_FILES['images'])){
            foreach($_FILES['images']['tmp_name'] as $key => $tmp_name){
                $file_name = $_FILES['images']['name'][$key];
                $file_tmp = $_FILES['images']['tmp_name'][$key];
                $file_path = "./product_images/" . $file_name;

                // Move the uploaded file to the desired directory
                if(move_uploaded_file($file_tmp, $file_path)){
                    // Insert image path into the product_images table
                    $sql = "INSERT INTO product_images (p_username, product_name, image) VALUES ('$username', '$product_name', '$file_path')";
                    $image_result = mysqli_query($conn, $sql);

                    if(!$image_result){
                        echo "Error inserting image: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error moving uploaded file.";
                }
            }
        }

        header("Location: student_home_page.php");
    } else {
        echo "Error inserting product: " . mysqli_error($conn);
    }
} else {
    echo "Required fields are missing.";
}
?>