<?php
$servername = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ebazar";

$conn = mysqli_connect($servername, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: ". $conn->connect_error);
}

?>