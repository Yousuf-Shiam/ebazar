<?php
session_start();
$username1 = $_SESSION['user'];

if ($username1 != 'admin_yoshi') {
    header("Location: login_page.php");
    exit();
}

require_once('DBconnect.php');

$username_to_delete = $_GET['username'];

$sql_delete_user = "DELETE FROM users WHERE username = '$username_to_delete'";
$result_delete_user = mysqli_query($conn, $sql_delete_user);

if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('User deleted successfully.'); window.location.href='admin_dashboard.php';</script>";
} else {
    echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "'); window.location.href='admin_dashboard.php';</script>";
}

mysqli_close($conn);
?>