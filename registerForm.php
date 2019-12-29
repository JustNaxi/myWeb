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

    <?php
      include("menu.php");
    ?>

    <div class="main">

      <?php
        session_start();
        if (isset($_SESSION['username'])) header('location: index.php');
      ?>

      <center>
        <h1>Register form</h1>
          <form action="register.php" method="post" id="form">
              <table>
                  <tr><th>Username:</th><th><input type="text" name="username"></th>
                  <tr><th>Email:</th><th><input type="text" name="email"></th>
                  <tr><th>Password:</th><th><input onInput="controlPassword()" type="password" name="password" id="password"></th>
                  <tr><th>Confirm password:</th><th><input onInput="controlPassword()" type="password" name="password2" id="password2"></th><th width="30" align="left" id="pswdWarning"></th>
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
