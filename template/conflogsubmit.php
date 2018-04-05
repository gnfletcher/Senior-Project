<?php
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

if ((isset($_POST)) || (isset($POST['submit']))) {
    $student_name = mysqli_real_escape_string($link, $_POST['name']);
    $building = $_POST['building'];
    $room = mysqli_real_escape_string($link, $_POST['room']);
    $date = $_POST['date'];
    $item_desc = mysqli_real_escape_string($link, $_POST['item']);
    $item_loc = mysqli_real_escape_string($link, $_POST['location']);
    $notes = mysqli_real_escape_string($link, $_POST['notes']);

    $sql1 = "SELECT building_id FROM buildings WHERE (building_name = '$building')";
    $result1 = mysqli_query($link, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while($row = mysqli_fetch_assoc($result1)) {
            $building_id = $row["building_id"];
        }
    } else {
        echo "0 results";
    }

    $query = "INSERT INTO confiscation_log (student_name, building_id, room, date, item_description, item_location, notes) " .
        "VALUES ('$student_name', '$building_id', '$room', '$date', '$item_desc', '$item_loc', '$notes')";
    $final_result = mysqli_query($link, $query);
    if(!$final_result) {
        echo mysqli_error($link);
    }
}
?>