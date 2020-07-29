<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MyPage</title>

    <link rel="stylesheet" href="style.css">



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

    <?php
      include("menu.php");
    ?>

    <div class="main">
        <?php if(true) : ?>
          <center>
            <h1>New product</h1>
          <form action="newProduct.php" method="post" id="form" enctype="multipart/form-data">
              <table>
                  <tr><th>Name:</th><th><input type="text" name="name"></th>
                  <tr><th>Price:</th><th><input type="number" name="price"></th>
                  <tr><th>Pieces:</th><th><input type="number" name="pcs"></th>
                  <tr><th>Image:</th><th><input type="file" name="productImage" id="productImage" accept="image/*" size="500000"></th>
              </table>
              <br>

              <div style="transform: translate(-180px, 0%)">Description:</div>
              <textarea name="message" rows="10" cols="60" name="description"></textarea><br><br><br>

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
