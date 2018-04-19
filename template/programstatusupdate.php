<?php
session_start();
include 'connect.php';
$user_id = $_GET['user_id'];
$user_type = $_SESSION["user_type"];


if (isset($_POST['submit'])) {
    $program_id = $_POST['program_id'];
    $new_status = "";
    if ($_POST['action'] == 'Approve') {
        $new_status = 'Approved';
    } else {
        $new_status = 'Denied';
    }

    echo $new_status;

    $sql3 = "UPDATE programs p SET p.status = '$new_status' WHERE p.program_id = '$program_id'";
    $result3 = mysqli_query($link, $sql3);
    if (!$result3) {
        echo mysqli_error($link);
    }
}

header("Location: programreview.php?user_id=$user_id");


?>