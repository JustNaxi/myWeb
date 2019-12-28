<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MyPage</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-products.css">



    <script>
    var inputsCount = 0;
    var result;

    function getCategories()
    {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function()
      {
        if (this.readyState == 4 && this.status == 200)
        {
          //result = this.responseText;
          result = JSON.parse(this.responseText);
          addInput();

          /*
          for (var i in result) {
            console.log(i);
            for (var j in result[i]) {
              console.log("  "+result[i][j]);
            }
          }
          */

          var form = document.getElementById("dynamicInputs");

          var tmp="";

          tmp+="<datalist id=\"categories\">";
          for (var i in result) {tmp+="<option value=\""+i+"\">";}
          tmp+= "</datalist>";

          for (var i in result) {
            tmp+="<datalist id=\""+i+"\">";
            for (var j in result[i]) {
              tmp+="<option value=\""+result[i][j]+"\">";
            }
            tmp+= "</datalist>";
          }
          form.innerHTML+=tmp;


        }


      };
      xhttp.open("GET", "categoriesData.php", true);
      xhttp.send();


    }

    function addInput()
    {

      var form = document.getElementById("dynamicInputs");


        form.innerHTML+="Category:"+
         "<input list=\"categories\" oninput=\"onInput("+inputsCount+")\" name=\"category_"+inputsCount+"\" id=\"datalist1_"+inputsCount+"\">"+
         "&nbsp;&nbsp; Name: "+
         "<input list=\"none\" name=\"name_"+inputsCount+"\" id=\"datalist2_"+inputsCount+"\"><br>";


      inputsCount++;
    }


    function onInput(elemID)
    {
      var datalist1 = document.getElementById("datalist1_"+elemID);
      var datalist2 = document.getElementById("datalist2_"+elemID);

      datalist2.setAttribute('list', datalist1.value);
      console.log("jup");

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
        <?php if(true) : ?>
          <center>
            <h1>New product</h1>
          <form action="addProduct.php" method="post" id="form">
              <table>
                  <tr><th>Name:</th><th><input type="text" name="name"></th>
                  <tr><th>Image:</th><th><input type="text" name="image"></th>
                  <tr><th>Description:</th><th><input cols="40" rows="5" type="textbox" name="description"></th>
              </table>
              <br>

              <div id="dynamicInputs">
              </div>

              <h4><input type="button" onClick="addInput()" value="Add category"></h4>

              <h2><input type="submit" value="Submit"></h2>
          </form>
        </center>
        <script>
        getCategories();
        </script>

        <?php endif; ?>

    </div>

  </div>

  </body>
</html>
