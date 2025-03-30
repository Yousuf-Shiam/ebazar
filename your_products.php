<?php
session_start();
$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style_over.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet" />
    <title>eBazar</title>
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
                </a>
            </li>
        </ul>
      </nav>
    </header>
    <main>
        <section class="students">
            <div class="student_box">
                <h1>Your Products</h1>
                <table class="student_table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        require_once("DBconnect.php");
                        $sql = "SELECT * FROM products WHERE username = '$username' order by product_name";
                        $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?php echo $row["product_name"]; ?></td>
                            <td><?php echo $row["type"]; ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td><?php echo $row["quantity"]; ?></td>
                            <td style="background-color:rgba(255, 255, 255, 0.2);">
                                <a style="text-decoration:none;" href="#">
                                    <img src="img/update.png" alt="update" width="20" height="20"/>
                                </a>
                                <a style="text-decoration:none;" href="delete_product.php?prod=<?php echo $row["product_name"]; ?>" onclick="return confirm('Confirm deletion?');">
                                    <img src="img/delete.png" alt="delete" width="20" height="20"/>
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add_products.php" class="btn">Add Products</a>

            </div>
        </section>
    </main>
</body>
</html>