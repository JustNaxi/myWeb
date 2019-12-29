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
