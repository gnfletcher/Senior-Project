<?php
session_start();
include 'connect.php';
$user_id = $_GET['user_id'];
$user_type = $_SESSION["user_type"];

if(isset($_POST)) {
 $program_title = mysqli_real_escape_string($link, $_POST['program_title']);
    $program_type = $_POST['program_type'];
    $program_date = $_POST['program_date'];
    $building_id = $_POST['building_id'];
    $location = mysqli_real_escape_string($link, $_POST['location']);
    $collaborators = $_POST['collaborators'];
    $goals = mysqli_real_escape_string($link, $_POST['goals']);
    $attendance = mysqli_real_escape_string($link, $_POST['attendance']);
    $funds = mysqli_real_escape_string($link, $_POST['cost']);
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
    $program_id = mysqli_insert_id($link);

    $pp_query = "INSERT INTO program_proposers (program_id, user_id) VALUES ('$program_id', '$user_id')";
    $pp_res = mysqli_query($link, $pp_query);
    
    if (!$result3) {
        echo mysqli_error($link);
    } else {
        echo '<h3> Success! Your program has been submitted. </h3>';
        header("Refresh:5; url=programproposal.php?user_id='$user_id'");
    }
}
?>
