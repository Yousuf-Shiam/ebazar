<?php
session_start();
$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/product.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet" />
    <title>eBazar</title>
</head>

<style>
        .nav_link a {
            text-decoration: none;
        }
        .add_student_box form input[type="text"],
        .add_student_box form input[type="file"] {
            width: calc(100% - 20px);
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 40px;
        }
        .add_student_box form input[type="submit"] {
            background-color: rgb(51, 94, 135);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 15px;
            padding: 5px;
            width: 30%;
            border-radius: 100px;
            font-family: "Fredoka", sans-serif;
        }
        .add_student_box form input[type="submit"]:hover {
            background-color: rgb(6, 45, 81);
        }

        .add_student_box form label {
            display: block;
            margin: 5px auto 5px auto; /* Center the label */
            font-size: 15px;
            font-weight: 400;
            color: rgb(19, 25, 30);
            background-color: rgb(135, 141, 174);
            padding: 3px;
            border-radius: 5px;
            border: 1px solid rgb(25, 33, 64);
            width: 150px; 
        }
    </style>

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
        <section class="add_student">
            <div class="add_student_box">
                <h1>Add New Product</h1>
                <form action="insert_product.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="product_name" placeholder="Product Name" required>
                    <input type="text" name="type" placeholder="Product Type" required>
                    <input type="text" name="price" placeholder="Price" required>
                    <input type="text" name="quantity" placeholder="Quantity" required>
                    <label for="images">Select Image Files:</label>
                    <input type="file" name="images[]" multiple>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </section>
    </main>
</body>
</html>