<?php
session_start();
$username = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('DBconnect.php');
    $password = $_POST['password'];

    // Fetch the user's password from the database
    $sql = "SELECT password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // Verify the password
    if (password_verify($password, $user['password'])) {
        // First, delete from the product_images table
        $sql1 = "DELETE FROM product_images WHERE p_username = '$username'";
        $result1 = mysqli_query($conn, $sql1);

        // Then, delete from the products table
        $sql2 = "DELETE FROM products WHERE username = '$username'";
        $result2 = mysqli_query($conn, $sql2);

        // Finally, delete from the users table
        $sql3 = "DELETE FROM users WHERE username = '$username'";
        $result3 = mysqli_query($conn, $sql3);

        if (mysqli_affected_rows($conn) > 0) {
            session_destroy();
            header("Location: login_page.php");
            exit();
        } else {
            echo "Error deleting account: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Incorrect password. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/reg_alt.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap"
      rel="stylesheet"
    />
    <title>Profile Update</title>
    <link rel="stylesheet" href="css/del_alt.css">

</head>
<body>
    <header>
        <nav>
            <div class="nav_logo">
                <h1><a href="home_page.php">eBazar</a></h1>
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
                <h1>Delete Account</h1>
                <form action="delete_account.php" method="post">
                    <label for="password">Enter your password to confirm:</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit" class='return-link'>Delete Account</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>