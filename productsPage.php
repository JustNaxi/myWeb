<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MyPage</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-products.css">
  </head>
  <body>

  <div class="wrapper-page">

    <?php
    include("menu.php");
    ?>

    <div class="main">
      <div class="products-wrapper">
        <?php

          $sql = "SELECT name, image, description, price FROM guns";
          $result = mysqli_query($conn, $sql);


          if (mysqli_num_rows($result) > 0)
          {
            while($row = mysqli_fetch_assoc($result))
            {
              echo "<div class='product'><br>";
              echo "<img src='data/images/".$row["image"]."'></img>";
              echo "<h4><b>".$row["name"]."</b></h4>";
              echo "<p>".$row["description"]."</p>";
              echo "<p id='cena'><b>Cena: ".$row["price"]." $</b></p>";
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
