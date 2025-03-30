<?php
session_start();
session_destroy();
header("Location: login_page.php");
header("Location: index.php")
?>