<?php
session_start();
$admin = $_SESSION['user'];

if ($admin != 'admin_yoshi') {
    header("Location: login_page.php");
    exit();
}

require_once "DBconnect.php";

$p_username = $_GET['acc'];
$product_name = $_GET['prod'];

// Fetch product details
$sql = "SELECT * FROM products WHERE product_name = '$product_name' AND username = '$p_username'";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "Product not found.";
    exit();
}

// Fetch product images
$sql_images = "SELECT * FROM product_images WHERE product_name = '$product_name' AND p_username = '$p_username'";
$result_images = mysqli_query($conn, $sql_images);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/img_pg.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap"
      rel="stylesheet"
    />
    <title>Product Images</title>
    <link rel="stylesheet" href="css/style_over.css">
</head>
<body>
    <header>
        <nav>
            <div class="nav_logo">
                <h1><a href="admin_dashboard.php">eBazar</a></h1>
            </div>
            <ul class="nav_link">
                <li><a style="text-decoration:none;" href="admin_dashboard.php">
                    <img src="img/home.png" alt="home" width="50" height="50"/>
                </a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="product-images">
            <div class="product-images_box">
                <h1>Images for <?php echo $product_name; ?></h1>
                <table class="product-images_table">
                    <thead>
                        <tr>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result_images) > 0) {
                            while ($row = mysqli_fetch_array($result_images)) {
                                $image_path = $row["image"];
                        ?>
                        <tr>
                            <td>
                                <?php if (!empty($row["image"])) { ?>
                                    <img src="<?php echo $image_path; ?>" alt="product" width="auto" height="auto";/>
                                <?php } else { ?>
                                    <p>Image not found</p>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="admin_delete_image.php?&acc=<?php echo $p_username;?>&prod=<?php echo $product_name; ?>&img=<?php echo $row['image']; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td>No images.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>