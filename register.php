<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebazar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

if(($_POST['username'] != NULL) && ($_POST['first_name'] != NULL) && ($_POST['last_name'] != NULL) && ($_POST['password'] != NULL) && ($_POST['confirm'] != NULL) && ($_POST['email'] != NULL) && ($_POST['password'] == $_POST['confirm'])){
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password1 = $_POST['password'];
    $confirm = $_POST['confirm'];
    $email = $_POST['email'];
    $passwordHash = password_hash($password1, PASSWORD_DEFAULT);

    $sql1 = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $sql1);
    if(mysqli_num_rows($result) > 0){
        // echo "Let him enter";
        echo "username or email already exists. Try again";
        //header("Location: student_register_page.php");

    } else{
        $sql = "INSERT INTO users VALUES ('$username', '$first_name', '$last_name', '$passwordHash', '$email', 'non-student')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            echo "<h1><a href='login_page.php'>Log in now</a></h1>";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
    }

} else {
    header("Location: register_page.php");
}
  
  $conn->close();

?>