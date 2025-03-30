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
          <h1><a href="index.php">eBazar</a></h1>
        </div>
      </nav>
    </header>
    <main>
      <section class="login">
        <div class="login_box">
          <h1>Student Register</h1>
          <form class="login_form" action="student_register.php" method="post">
            <input
              type="text"
              id="username"
              name="username"
              placeholder="username"
            />
            <input
              type="text"
              id="first_name"
              name="first_name"
              placeholder="first name"
            />
            <input
              type="text"
              id="last_name"
              name="last_name"
              placeholder="last name"
            />
            <input 
              type="email"
              id="email"
              name="email"
              placeholder="student email"
            />
            <input
              type="password"
              id="password"
              name="password"
              placeholder="password"
            />
            <input
              type="password"
              id="password"
              name="confirm"
              placeholder="confirm password"
            />
            <input type="submit" value="submit" />
          </form>
        </div>
      </section>
    </main>
  </body>
</html>