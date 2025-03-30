<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style_over.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap"
      rel="stylesheet"
    />
    <title>eBazar</title>
  </head>
  <body>
    <header>
      <nav>
        <div class="nav_logo">
          <h1><a href="index.php">eBazar</a></h1>
        </div>
        <ul class="nav_link">
          <li>
          <style>
            .dropbtn {
              background-color:rgb(52, 82, 121);
              color: white;
              padding: 7px;
              font-family: "Fredoka", sans-serif;
              font-optical-sizing: auto;
              font-size: 1rem;
              font-style: dotted;
              border: none;
              cursor: pointer;
            }
            .dropbtn1  {
              background-color:rgb(52, 82, 121);
              color: white;
              padding: 7px;
              font-family: "Fredoka", sans-serif;
              font-optical-sizing: auto;
              font-size: 1rem;
              font-style: dotted;
              border-top-style: hidden;
              border-bottom-style: hidden;
              border-right-style: hidden;
              border-left-style: solid;
              border-width: 3px;
              cursor: pointer;
            }

            .dropdown {
              position: relative;
              display: inline-block;
            }

            .dropdown-content {
              display: none;
              position: absolute;
              min-width: 140px;
              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
              z-index: 1;
            }

            .dropdown-content a {
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
            }

            .dropdown-content a:hover {background-color:rgb(198, 220, 224)}

            .dropdown:hover .dropdown-content {
              display: block;
              background-color:rgb(172, 214, 214);
            }

            .dropdown:hover .dropbtn {
              background-color:rgb(62, 134, 142);
            }
            .dropbtn1:hover{
              background-color:rgb(62, 134, 142)
            }
            </style>
  
            <div class="dropdown">
              <button class="dropbtn">Register</button>
              <div class="dropdown-content">
              <a href="student_register_page.php">Student</a>
              <a href="register_page.php">Non-Student</a>
              </div>
            </div>

          </li>
          <li><a href="login_page.php"><button class = "dropbtn1">Log in</button></a></li>
      </ul>
      </nav>
    </header>
    <main>
    <section class="students">
            <div class="student_box">
                <h1>Explore the Products made by Students</h1>
                <table class="student_table">
                    <thead>
                        <tr>
                            <th>Seller</th>
                            <th>Product Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Images</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        require_once("DBconnect.php");
                        $sql = "SELECT * FROM products order by product_name asc";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $row["username"]; ?></td>
                            <td><?php echo $row["product_name"]; ?></td>
                            <td><?php echo $row["type"]; ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td><?php echo $row["quantity"]; ?></td>
                            <td><a href="idx_images_page.php?usr=<?php echo $row["username"]; ?>&prd=<?php echo $row["product_name"]; ?>"><button class = "dropbtn1">Show Images</button></a></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
      </section>
    </main>
  </body>
</html>