<?php

require 'connect.php';

$area = $_POST['area'];
$program_title = $_POST['program_title'];

echo $area;
echo $program_title;

//$sql = "INSERT INTO rluh_website.programs (program_title) VALUES ('$program_title')";

//if (mysqli_query($conn, $sql)) {
  //  echo "Records added successfully";
    //echo $program_title;
//} else {
  //  echo "you suck!";
//}

mysqli_close($conn);

?>