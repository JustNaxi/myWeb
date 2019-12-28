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

$sql = "SELECT category, name FROM categories";
$result = mysqli_query($conn, $sql);

$json = array();
while($row = mysqli_fetch_assoc($result)) {

/* VERSION
  $is = false;

    foreach ($json as $key => $val)
    {
        if ($val['category'] == $row["category"])
        {
            $json[$key]['value'][] = $row["name"];
            $is = true;
            continue;
        }
    }

 if (!$is)
 {
    $json[] = array(
      'category' => $row["category"],
      'value' => array($row["name"])

    );
  }
  */


  /* VERSION 2
  if(array_key_exists($row['category'], $json))
  {
    $json[$row['category']][] = $row["name"];
  }
  else
  {
    $json[] = array(
      $row["category"] => array($row["name"])
    );
  }
  */
  $json[$row['category']][] = $row["name"];
}

echo json_encode($json);

//echo "{ \"name\":\"John\" }";
?>
