<?php
session_start();
$username1 = $_SESSION['user'];

require_once('DBconnect.php');

// Fetch the first name from the database
$sql = "SELECT * FROM users WHERE username = '$username1'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/reg.css" />
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
          <h1>Edit your profile</h1>
          <form class="login_form" action="edit_profile_internal.php" method="post">
            <input
              type="text"
              id="first_name"
              name="first_name"
              value ="<?php echo $first_name; ?>"
              placeholder="First Name"
            />
            <input
              type="text"
              id="last_name"
              name="last_name"
              value ="<?php echo $last_name; ?>"
              placeholder="Last Name"
            />
            <input 
              type="email"
              id="email"
              name="email"
              value ="<?php echo $email; ?>"
            />
            <input
              type="password"
              id="password"
              name="password"
              placeholder ="Change Password"
            />
            <input
              type="password"
              id="password"
              name="confirm"
              placeholder ="Confirm New Password"
            />
            <input type="submit" value="Update" />
          </form>
        </div>
      </section>
    </main>
  </body>
</html>