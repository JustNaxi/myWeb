<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MyPage</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-register.css">

    <script>

    function controlPassword()
    {
      var pswd1 = document.getElementById("password");
      var pswd2 = document.getElementById("password2");

      if (pswd1.value!=pswd2.value)
      {
        document.getElementById("pswdWarning").innerHTML="<div style=\"color:#c21000;\">!!!</div>";
      }
      else {
        document.getElementById("pswdWarning").innerHTML="<div style=\"color:#52db37;\">Ok</div>";
      }

    }


    </script>


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
      <center>
        <h1>Register form</h1>
          <form action="addProduct.php" method="post" id="form">
              <table>
                  <tr><th>Username:</th><th><input type="text" name="name"></th>
                  <tr><th>Password:</th><th><input onInput="controlPassword()" type="password" name="password" id="password"></th>
                  <tr><th>Repeate password:</th><th><input onInput="controlPassword()" type="password" name="password2" id="password2"></th><th width="30" align="left" id="pswdWarning"></th>
              </table>
              <br>
              <table>
                  <tr><th>First name:</th><th><input type="text" name="firstName"></th>
                  <tr><th>Second name:</th><th><input type="text" name="secondName"></th>
                  <tr><th>City:</th><th><input type="text" name="city"></th>
                  <tr><th>PSČ:</th><th><input type="text" name="PSC"></th>
                  <tr><th>Street adress:</th><th><input type="text" name="street"></th>
                  <tr><th>Telephone:</th><th><input type="text" name="telepohone"></th>
              </table>

              <h2><input type="submit" value="Register"></h2>
          </form>
      </center>

    </div>

  </div>

  </body>
</html>
