<?php
error_reporting(E_ALL);
include 'connect.php';

if(isset($_POST)) {
    var_dump($_POST);

    //$area = $_POST['area'];
    //$building = $_POST['building'];
    $program_title = mysqli_real_escape_string($link, $_POST['program_title']);
    $program_date = $_POST['program_date'];
    $collaborators = $_POST['collaborators'];
    $goals = $_POST['goals'];
    $attendance = $_POST['attendance'];
    $funds = $_POST['requested_funds'];

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
    
    $query = "INSERT INTO programs (program_title, program_date, proposal_date, goals, expected_attendance) " .
        "VALUES ('$program_title', '$program_date', curdate(), '$goals', '$attendance')";
    $result3 = mysqli_query($link, $query);
    if(!$result3) {
        echo mysqli_error($link);
    }
}
?>
