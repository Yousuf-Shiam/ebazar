<?php
session_start();
$username1 = $_SESSION["user"];
require_once "DBconnect.php";

// Fetch user details
$sql_user = "SELECT account_type FROM users WHERE username = '$username1'";
$result_user = mysqli_query($conn, $sql_user);
$user = mysqli_fetch_assoc($result_user);

// Determine the home page based on account type
$home_page = ($user['account_type'] == 'student') ? 'student_home_page.php' : 'home_page.php';

// Fetch cart items for the logged-in user, excluding items with payment status 'Paid'
$sql = "SELECT c.*, p.price FROM cart c JOIN products p ON c.product_name = p.product_name WHERE c.u_username = '$username1' AND c.payment_status != 'Paid'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_over.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap"
      rel="stylesheet"
    />
    <title>Cart</title>
    <link rel="stylesheet" href="css/style_over.css">
    <script>
        function confirmRemove() {
            return confirm('Are you sure you want to remove this item from the cart?');
        }
    </script>
</head>
<body>
    <header>
        <nav>
            <div class="nav_logo">
                <h1><a href="<?php echo $home_page; ?>">eBazar</a></h1>
            </div>
        </nav>
    </header>
    <main>
        <section class="students">
            <div class="student_box">
                <h1>Your Cart</h1>
                <table class="student_table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Seller</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $total_price = $row["price"] * $row["c_quantity"];
                        ?>
                        <tr>
                            <td><?php echo $row["product_name"]; ?></td>
                            <td><?php echo $row["p_username"]; ?></td>
                            <td><?php echo $row["c_quantity"]; ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td><?php echo $total_price; ?></td>
                            <td>
                                <form action="update_cart.php" method="post" style="display: inline-block;">
                                    <input type="hidden" name="product_name" value="<?php echo $row["product_name"]; ?>">
                                    <input type="hidden" name="p_username" value="<?php echo $row["p_username"]; ?>">
                                    <input type="number" name="c_quantity" value="<?php echo $row["c_quantity"]; ?>" min="1">
                                    <button type="submit">Update</button>
                                </form>
                                <form action="remove_from_cart.php" method="post" onsubmit="return confirmRemove();" style="display: inline-block;">
                                    <input type="hidden" name="product_name" value="<?php echo $row["product_name"]; ?>">
                                    <input type="hidden" name="p_username" value="<?php echo $row["p_username"]; ?>">
                                    <button type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='6'>Your cart is empty.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                <form action="checkout.php" method="post" onsubmit="return confirm('Are you sure you want to proceed with the payment?');">
                    <button type="submit" class="return-link" style="margin-top: 10px;">Confirm Payment</button>
                </form>
                <?php } ?>
            </div>
        </section>
    </main>
</body>
</html>