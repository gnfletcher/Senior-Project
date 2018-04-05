<?php
error_reporting(E_ALL);

define('DB_NAME', 'rluh_website');
define('DB_USER', 'root');
define('DB_PASS', 'swang');
define('DB_HOST', 'localhost');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

if(!$link) {
    die('Error: ' . mysqli_error($link));
}

$db_select = mysqli_select_db($link, DB_NAME);

if(!$db_select) {
    die('Cannot use ' . DB_NAME . ': ' . mysqli_error($link));
}

if(isset($_POST)) {
    var_dump($_POST);

    $area = $_POST['area'];
    $building = $_POST['building'];
    $program_title = mysqli_real_escape_string($link, $_POST['program_title']);

    $sql1 = "SELECT area_id FROM areas WHERE (area_name = '$area')";
    $result1 = mysqli_query($link, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while($row = mysqli_fetch_assoc($result1)) {
            $area_id = $row["area_id"];
        }
    } else {
        echo "0 results areas";
    }

    $sql2 = "SELECT building_id FROM buildings WHERE (building_name = '$building')";
    $result2 = mysqli_query($link, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        while($row = mysqli_fetch_assoc($result2)) {
            $building_id = $row["building_id"];
        }
    } else {
        echo "0 results builds";
    }
    
    $query = "INSERT INTO programs (program_title, area_id, building_id) VALUES ('$program_title', '$area_id', '$building_id')";
    $result3 = mysqli_query($link, $query);
}
?>
