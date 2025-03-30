<?php
session_start();
if (isset($_SESSION["user"])) {
    $username1 = $_SESSION["user"];
    require_once "DBconnect.php";
    $sql = "SELECT * FROM users WHERE username = '$username1'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user["account_type"] == "non-student"){
        header("Location: home_page.php");
    } else{
        header("Location: student_home_page.php");}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap"
      rel="stylesheet"
    />
    <title>eBazar log in</title>
  </head>
  <body>
    <header>
      <nav>
        <div class="nav_logo">
          <h1><a href="index.php">eBazar</a></h1>
        </div>
      </nav>
    </header>
    <main>
      <section class="login">
        <div class="login_box">
          <h1>Login</h1>
            <?php
            if (isset($_POST["login"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                require_once "DBconnect.php";
                $sql = "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        session_start();
                        $_SESSION["user"] = "$username";
                        if ($user["account_type"] == "non-student"){
                            header("Location: home_page.php");
                        } else{
                            header("Location: student_home_page.php");}
                        die();
                    }else{
                        echo "<div style ='color: rgb(131, 11, 11); text-shadow: 0.5px 0.5px #000000; margin-bottom: 5px; text-align: center; font-weight: 400;'>Password does not match</div>";
                    }
                }else{
                    echo "<div style ='color: rgb(131, 11, 11); text-shadow: 0.5px 0.5px #000000; margin-bottom: 5px; text-align: center; font-weight: 400;'>User does not exist</div>";
                }
            }
            ?>
          <form class="login_form" action="login_page.php" method="post">
            <input
              type="text"
              id="username"
              name="username"
              placeholder="username"
            />
            <input
              type="password"
              id="password"
              name="password"
              placeholder="password"
            />
            <input type="submit" value="Login" name = "login"/>
          </form>
        </div>
      </section>
    </main>
  </body>
</html>