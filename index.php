<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-16-czech">
    <title>MyPage</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-products.css">
  </head>
  <body>

  <div class="wrapper-page">

    <div class="left-menu">
      <center><h1>Menu</h1></center>
      <a href="#neco"><div class="menu-item"> Něco </div></a>
      <div class="menu-item"> Něco </div>
      <div class="menu-item"> Něco </div>
      <div class="menu-item"> Něco </div>
      <div class="menu-dropdown"> Něco
        <div class="dropdown-content">
          <div class="menu-item"> Něco </div>
          <div class="menu-item"> Něco </div>
        </div>
      </div>
      <div class="menu-dropdown"> Něco
        <div class="dropdown-content">
          <div class="menu-item"> Něco </div>
          <div class="menu-item"> Něco </div>
        </div>
      </div>
    </div>

    <div class="main">
      <div class="products-wrapper">
        <?php
          $servername = "localhost";
          $username = "Naxi";
          $password = "tajneheslo";
          $dbname = "myshop";
          $conn = mysqli_connect($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT name, image, description, price FROM Products";
          $result = mysqli_query($conn, $sql);


          if (mysqli_num_rows($result) > 0)
          {
            while($row = mysqli_fetch_assoc($result))
            {
              echo "<div class='product'><br>";
              echo "<img src='data/images/".$row["image"]."'></img>";
              echo "<h4><b>".$row["name"]."</b></h4>";
              echo "<p>".$row["description"]."</p>";
              echo "<p id='cena'><b>Cena: ".$row["price"]." Kč</b></p>";
              echo "</div>";
            }
          } else
          {
           echo "0 results";
          }

        ?>
      </div>
    </div>

  </div>

  </body>
</html>
