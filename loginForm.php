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
    <div class="left-menu">
      <center><h1>Menu</h1></center>

      <?php

        $servername = "localhost";
        $username = "Naxi";
        $password = "tajneheslo";
        $dbname = "myshop";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        mysqli_query($conn, "SET CHARACTER SET utf8");

        $sql = "SELECT type FROM guns GROUP BY type";
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0)
        {
          while($row = mysqli_fetch_assoc($result))
          {
            $sql = "SELECT manufacture FROM guns WHERE type=\"".$row["type"]."\" GROUP BY manufacture";
            $result_inner = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result_inner) > 1)
            {
              echo "<a href=\"#neco\"><div class=\"menu-dropdown\">".$row["type"];
              echo "<div class=\"dropdown-content\">";
              while($row_inner = mysqli_fetch_assoc($result_inner))
              {
                echo "<a href=\"#neco\"><div class=\"menu-item\">".$row_inner["manufacture"]."</div></a>";
              }
              echo "</div>";
              echo "</div></a>";
            }
            else
            {
              echo "<a href=\"#neco\"><div class=\"menu-item\">".$row["type"]."</div></a>";
            }

          }
        }

      ?>
    </div>
    <div class="main">
      <?php
        session_start();
        if (is_set($_SESSION['username'])) header('location: index.php');
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
