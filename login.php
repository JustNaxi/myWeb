<?php
  session_start();

  $servername = "localhost";
  $username = "Naxi";
  $password = "tajneheslo";
  $dbname = "myshop";
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $errors = array();

  // receive all input values from the form
  $login = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }

  $user_check_query = "SELECT username, email, password FROM users WHERE username='$username' OR email='$username' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['password'] === password_hash($password, PASSWORD_DEFAULT)) {


    	$_SESSION['username'] = $username;

    	header('location: index.php');
    }
  }

?>
