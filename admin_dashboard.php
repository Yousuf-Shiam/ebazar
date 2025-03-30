<?php
session_start();
$username1 = $_SESSION['user'];

if ($username1 != 'admin_yoshi') {
    header("Location: login_page.php");
    exit();
}

require_once('DBconnect.php');

// Fetch all users
$sql_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $sql_users);

// Fetch all products
$sql_products = "SELECT * FROM products";
$result_products = mysqli_query($conn, $sql_products);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_over.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>
<body>
    <header>
        <nav>
            <div class="nav_logo">
                <h1><a href="admin_dashboard.php">eBazar Admin</a></h1>
            </div>
            <ul class="nav_link">
                <li><a href="logout.php"><button class="dropbtn1">Log Out</button></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="students">
            <div class="student_box">
                <h1>Admin Dashboard</h1>
                <h2>Manage Users</h2>
                <table class="student_table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Account Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result_users) > 0) {
                            while ($row = mysqli_fetch_assoc($result_users)) {
                                echo "<tr>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['first_name'] . "</td>";
                                echo "<td>" . $row['last_name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['account_type'] . "</td>";
                                echo "<td><a href='admin_delete_account.php?username=" . $row['username'] . "' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <h2>Manage Products</h2>
                <table class="student_table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Product Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Images</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result_products) > 0) {
                            while ($row = mysqli_fetch_assoc($result_products)) {
                                echo "<tr>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td><a href='admin_edit_images.php?acc=" . $row['username'] . "&prod=" . $row['product_name'] . "'>Show Images</a></td>";
                                echo "<td><a href='admin_delete_product.php?acc=" . $row['username'] . "&prod=" . $row['product_name'] . "' onclick=\"return confirm('Are you sure you want to delete this product?');\">Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No products found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>

<?php
mysqli_close($conn);
?>