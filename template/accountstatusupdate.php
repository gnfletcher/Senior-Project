<?php
error_reporting(E_ALL);

include 'connect.php';

//$user_id = $_GET['user_id'];

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $new_status = "";
    if ($_POST['action'] == 'Approve') {
        $new_status = 'Active';
    } else {
        $new_status = 'Deactivated';
    }

    echo $new_status;

    $sql = "UPDATE users u SET u.account_status = '$new_status' WHERE u.user_id = '$user_id'";
    $res = mysqli_query($link, $sql);
    if (!$res) {
        echo mysqli_error($link);
    }
}

header("Location: accountapproval.php");


?>