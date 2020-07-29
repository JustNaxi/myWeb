<?php
function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}


?>




<?php

echo getName(30);
echo $_FILES["productImage"]["name"];
$check = getimagesize($_FILES["productImage"]["tmp_name"]);
if($check !== false)
{
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
}
else
{
    echo "File is not an image.";
    $uploadOk = 0;
}





?>
