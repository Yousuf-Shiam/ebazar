<?php
session_start();
$username1 = $_SESSION['user'];

require_once('DBconnect.php');
$product_name = $_GET['prod'];
$product_name1 = $_GET['prod'];

$check_ownership_sql = "SELECT * FROM products WHERE product_name='$product_name1' AND username='$username1'";
$check_ownership_result = mysqli_query($conn, $check_ownership_sql);

if (mysqli_num_rows($check_ownership_result) == 0) {
    echo "<script>alert('You do not own this product.'); window.location.href='student_home_page.php';</script>";
    exit();
}

// Fetch the first name from the database
$sql = "SELECT * FROM products WHERE username = '$username1' and product_name = '$product_name'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$type = $row['type'];
$price = $row['price'];
$quantity = $row['quantity'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/update_prod.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap"
      rel="stylesheet"
    />
    <title>eBazar Register</title>
  </head>
  <body>
    <header>
      <nav>
        <div class="nav_logo">
          <h1><a href="student_home_page.php">eBazar</a></h1>
        </div>
        <ul class="nav_link">
                <li><a style="text-decoration:none;" href="student_home_page.php">
                    <img src="img/home.png" alt="home" width="50" height="50"/>
                </a></li>
        </ul>
        
      </nav>
    </header>
    <main>
      <section class="login">
        <div class="login_box">
          <h1>Update Your Product Details</h1>
            <p></p>
          <form class="login_form" action="update_product_internal.php?prod=<?php echo $product_name1; ?>" method="post">
          <p>Change Product Name</p>
            <input
              type="text"
              id="product_name"
              name="product_name"
              value ="<?php echo $product_name;?>"
              placeholder="First Name"
            />
            <p>Change Product Type</p>
            <input
              type="text"
              id="type"
              name="type"
              value ="<?php echo $type;?>"
              placeholder="Change Product Type"
            />
            <p>Change the Price</p>
            <input 
              type="int"
              id="price"
              name="price"
              value ="<?php echo $price;?>"
              placeholder = "Change Price"
            />
            <p>Change Quantity</p>
            <input 
              type="int"
              id="quantity"
              name="quantity"
              value ="<?php echo $quantity;?>"
              placeholder = "Change Quantity"
            />
            <input type="submit" value="Update"/>
          </form>
          <form class="login_form" action="edit_images_page.php" method="get">
            <input type="hidden" name="prod" value="<?php echo $product_name1; ?>"/>
            <input type="submit" value="Edit Images"/>
          </form>
        </div>
      </section>
    </main>
  </body>
</html>