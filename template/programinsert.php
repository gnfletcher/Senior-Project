<?php
error_reporting(E_ALL);
include 'connect.php';
$user_id = $_GET['user_id'];

if(isset($_POST)) {
    var_dump($_POST);

    $sql = "SELECT building_id FROM resident_assistants ra " .
        "WHERE ra.user_id = '$user_id'";
    $res = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($res);
    $building_id = $row["building_id"];

    //$area = $_POST['area'];
    //$building = $_POST['building'];
    $program_title = mysqli_real_escape_string($link, $_POST['program_title']);
    $program_type = $_POST['program_type'];
    $program_date = $_POST['program_date'];
    $location = mysqli_real_escape_string($link, $_POST['location']);
    $collaborators = $_POST['collaborators'];
    $goals = mysqli_real_escape_string($link, $_POST['goals']);
    $attendance = mysqli_real_escape_string($link, $_POST['attendance']);
    $funds = mysqli_real_escape_string($link, $_POST['requested_funds']);
    $advertisements = $_POST['advertisements'];
    $stepup = $_POST['stepup'];
    $proflink = $_POST['proflink'];

    $a = 1;
    for ($i = 0; $i < count($advertisements); $i++) {
        $ads .= $advertisements[$i];
        if ($a < count($advertisements)) {
            $ads .= ', ';
        }
        $a++;
    }

    $b = 1;
    for ($i = 0; $i < count($stepup); $i++) {
        $st .= $stepup[$i];
        if ($b < count($stepup)) {
            $st .= ', ';
        }
        $b++;
    }

    $c = 1;
    for ($i = 0; $i < count($proflink); $i++) {
        $pl .= $proflink[$i];
        if ($c < count($proflink)) {
            $pl .= ', ';
        }
        $c++;
    }
    
    $query = "INSERT INTO programs (user_id, program_date, proposal_date, program_title, program_type, building_id, location, goals, expected_attendance, requested_funds, advertisements, stepup, proflink) " .
        "VALUES ('$user_id', '$program_date', curdate(), '$program_title', '$program_type', '$building_id', '$location', '$goals', '$attendance', '$funds', '$ads', '$st', '$pl')";
    $result3 = mysqli_query($link, $query);
    if(!$result3) {
        echo mysqli_error($link);
    } else {
        echo '<h3> Success! </h3>';
    }
}
?>
