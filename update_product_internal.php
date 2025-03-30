<?php
session_start();
$username = $_SESSION['user'];

require_once "DBconnect.php";
$product_name1 = $_GET['prod'];

// Check if the user owns the product
$check_ownership_sql = "SELECT * FROM products WHERE product_name='$product_name1' AND username='$username'";
$check_ownership_result = mysqli_query($conn, $check_ownership_sql);

if (mysqli_num_rows($check_ownership_result) == 0) {
    echo "<script>alert('You do not own this product.'); window.location.href='student_home_page.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST["product_name"];
    $type = $_POST["type"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    // Validate that none of the fields are empty
    if (empty($product_name) || empty($type) || empty($price) || empty($quantity)) {
        echo "<script>alert('Error: All fields are required.'); window.location.href='update_product.php?prod=$product_name1';</script>";
        exit();
    }

    // Check if the new product name already exists
    $check_sql = "SELECT * FROM products WHERE product_name='$product_name' AND product_name != '$product_name1'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Error: Product name already exists.'); window.location.href='update_product.php?prod=$product_name1';</script>";
    } else {
        $update_sql = "UPDATE products SET product_name='$product_name', type='$type', price='$price', quantity='$quantity' WHERE product_name='$product_name1' AND username='$username'";
        if (mysqli_query($conn, $update_sql)) {
            echo "<script>alert('Product updated successfully.'); window.location.href='your_products.php';</script>";
        } else {
            echo "<script>alert('Error updating record: " . mysqli_error($conn) . "'); window.location.href='update_product.php?prod=$product_name1';</script>";
        }
    }
    mysqli_close($conn);
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/reg_alt.css" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap"
  rel="stylesheet"
/>
<title>Product Update</title>
<link rel="stylesheet" href="css/reg_alt.css">
</head>
<body>
    <header>
        <nav>
            <div class="nav_logo">
                <h1><a href="student_home_page.php">eBazar</a></h1>
            </div>
        </nav>
    </header>
    <main>
        <section class="login">
            <div class="login_box">

            </div>
        </section>
    </main>
</body>
</html>