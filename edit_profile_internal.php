<?php
session_start();
$username1 = $_SESSION['user'];

require_once('DBconnect.php');

// Fetch the current user details from the database
$sql = "SELECT * FROM users WHERE username = '$username1'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$current_first_name = $row['first_name'];
$current_last_name = $row['last_name'];
$current_email = $row['email'];
$account_type = $row['account_type']; // Assuming account_type is stored in the users table

// Get the new values from the form
$new_first_name = $_POST['first_name'];
$new_last_name = $_POST['last_name'];
$new_email = $_POST['email'];
$new_password = $_POST['password'];
$confirm_password = $_POST['confirm'];

// Check if all values are unchanged or all boxes are empty
if (($new_first_name == $current_first_name && $new_last_name == $current_last_name && $new_email == $current_email && empty($new_password) && empty($confirm_password)) ||
    (empty($new_first_name) && empty($new_last_name) && empty($new_email) && empty($new_password) && empty($confirm_password))) {
    echo "<script>alert('No changes detected.'); window.location.href='edit_profile.php';</script>";
    exit();
}

// Check if the email address is empty
if (empty($new_email)) {
    echo "<script>alert('Email address cannot be empty.'); window.location.href='edit_profile.php';</script>";
    exit();
}

// Check if the account type is student and validate the email domain
if ($account_type == 'student' && !(str_ends_with($new_email, '.edu') || str_ends_with($new_email, '.ac.bd') || str_ends_with($new_email, '.edu.bd'))) {
    echo "<script>alert('Student email domain invalid'); window.location.href='edit_profile.php';</script>";
    exit();
}

// Update the user details in the database
$update_sql = "UPDATE users SET first_name = '$new_first_name', last_name = '$new_last_name', email = '$new_email'";

if (!empty($new_password) && $new_password == $confirm_password) {
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_sql .= ", password = '$hashed_password'";
}

$update_sql .= " WHERE username = '$username1'";

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
                <?php
                if (mysqli_query($conn, $update_sql)) {
                    echo "<p class='success-message'>Profile updated successfully.</p>";
                    echo "<a class='return-link' href='student_home_page.php'>Return to Home Page</a>";
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
                mysqli_close($conn);
                ?>
            </div>
        </section>
    </main>
</body>
</html>