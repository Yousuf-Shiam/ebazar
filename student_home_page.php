<?php
session_start();
$username1 = $_SESSION["user"];
require_once "DBconnect.php";
$sql = "SELECT * FROM users WHERE username = '$username1'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ((!isset($_SESSION["user"])) or ($user["account_type"] == "non-student")) {
   header("Location: login_page.php");
}
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style_over.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap"
      rel="stylesheet"
    />
    <title>eBazar</title>
  </head>
  <body>
    <header>
      <nav>
        <div class="nav_logo">
          <h1><a href="student_home_page.php">eBazar</a></h1>
        </div>
        <ul class="nav_link">
          <li>
          <style>
            .dropbtn {
              background-color:rgb(52, 82, 121);
              color: white;
              padding: 7px;
              font-family: "Fredoka", sans-serif;
              font-optical-sizing: auto;
              font-size: 1rem;
              font-style: dotted;
              border: none;
              cursor: pointer;
            }
            .dropbtn1  {
              background-color:rgb(52, 82, 121);
              color: white;
              padding: 7px;
              font-family: "Fredoka", sans-serif;
              font-optical-sizing: auto;
              font-size: 1rem;
              font-style: dotted;
              border-top-style: hidden;
              border-bottom-style: hidden;
              border-right-style: hidden;
              border-left-style: solid;
              border-width: 3px;
              cursor: pointer;
            }

            .dropdown {
              position: relative;
              display: inline-block;
            }

            .dropdown-content {
              display: none;
              position: absolute;
              min-width: 160px;
              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
              z-index: 1;
            }

            .dropdown-content a {
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
            }

            .dropdown-content a:hover {background-color:rgb(198, 220, 224)}

            .dropdown:hover .dropdown-content {
              display: block;
              background-color:rgb(172, 214, 214);
            }

            .dropdown:hover .dropbtn {
              background-color:rgb(62, 134, 142);
            }
            .dropbtn1:hover{
              background-color:rgb(62, 134, 142)
            }
            </style>
  
            <div class="dropdown">
              <button class="dropbtn">Account</button>
              <div class="dropdown-content">
              <a href="your_products.php">Your Products</a>
              <a href="cart_page.php">Your Cart</a>
              <a href="edit_profile.php">Edit Profile</a>
              <a href="delete_account.php"; onclick="return confirm('Are you sure, you want to delete your account?');">Delete Account</a>
              </div>
            </div>

          </li>
          <li><a href="logout.php"; onclick="return confirm('Confirm Log out?')"><button class = "dropbtn1">Log Out</button></a></li>
      </ul>
      </nav>
    </header>
    <main>
      <section class="students">
            <div class="student_box">
                <h1><?php echo $_SESSION['user'];?><h1>
                <h1>Explore the Products</h1>
                <table class="student_table">
                    <thead>
                        <tr>
                        <th>Seller</th>
                        <th>Product Name</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Images</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        require_once("DBconnect.php");
                        $sql = "SELECT * FROM products where username != '$username1' order by product_name asc";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $row["username"]; ?></td>
                            <td><?php echo $row["product_name"]; ?></td>
                            <td><?php echo $row["type"]; ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td><?php echo $row["quantity"]; ?></td>
                            <td><a href="images_page.php?usr=<?php echo $row["username"]; ?>&prd=<?php echo $row["product_name"]; ?>"><button class = "dropbtn1">Show Images</button></a></td>
                            <td>
                            <form action="add_to_cart.php" method="post">
                                    <input type="hidden" name="product_name" value="<?php echo $row["product_name"]; ?>">
                                    <input type="hidden" name="p_username" value="<?php echo $row["username"]; ?>">
                                    <input type="number" name="c_quantity" value="1" min="1" max="<?php echo $row["quantity"]; ?>">
                                    <button type="submit" class="dropbtn1">Add to Cart</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
      </section>
    </main>
  </body>
</html>