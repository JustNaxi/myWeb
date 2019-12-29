<?php
  $servername = "localhost";
  $username = "Naxi";
  $password = "tajneheslo";
  $dbname = "myshop";
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $username = "";
  $email    = "";
  $errors = array();

  // receive all input values from the form
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
  $secondName = mysqli_real_escape_string($conn, $_POST['secondName']);
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $PSC = mysqli_real_escape_string($conn, $_POST['PSC']);
  $street = mysqli_real_escape_string($conn, $_POST['street']);
  $telephone = mysqli_real_escape_string($conn, $_POST['telepohone']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }

  $user_check_query = "SELECT username, email FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0)
  {
  	$password = password_hash($password, PASSWORD_DEFAULT);//encrypt the password before saving in the database

  	//$query = $conn->prepare("INSERT INTO users (username, email, password, firstname, secondname, city, PSC, street, telephone) VALUES(?, ?, ?, ?, ?, ? , ?, ?, ?)");
    //$query->bind_param("sssssssss", $username, $email, $password, $firstName, $secondName, $city, $PSC, $street, $telephone);
    //$query->execute();
    //$query->close();

    $query = "INSERT INTO users (username, email, password, firstname, secondname, city, PSC, street, telephone) VALUES('$username', '$email', '$password', '$firstName', '$secondName', '$city', '$PSC', '$street', '$telephone')";
    mysqli_query($conn, $query);

    //session_start();
  	//$_SESSION['username'] = $username;
  	//header('location: index.php');
  }
  else {
    header('location: registerForm.php');
  }


 ?>
