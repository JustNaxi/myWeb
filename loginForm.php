<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MyPage</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-login.css">

  </head>
  <body>

  <div class="wrapper-page">

    <?php
      include("menu.php");
    ?>

    <div class="main">
      <?php
        session_start();
        if (isset($_SESSION['username'])) header('location: index.php');
      ?>

      <center>
        <h1>Login</h1>
          <form action="login.php" method="post" id="form">
              <table>
                  <tr><th>Name:</th><th><input type="text" name="username"></th>
                  <tr><th>Password:</th><th><input type="password" name="password" ></th>
              </table>

              <h2><input type="submit" value="Login"></h2>
              <h4><a href="register.php">Register</a></h4>
          </form>
      </center>


    </div>

  </div>

  </body>
</html>
