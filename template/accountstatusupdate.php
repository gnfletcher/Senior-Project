<?php
error_reporting(E_ALL);

include 'connect.php';

//$user_id = $_GET['user_id'];

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $new_status = "";
    if ($_POST['action'] == 'Approve') {
        $new_status = 'Active';
        $sql = "UPDATE users u SET u.account_status = '$new_status' WHERE u.user_id = '$user_id'";
        $res = mysqli_query($link, $sql);
    } else {
        $sql1 = "DELETE FROM resident_assistants WHERE user_id = '$user_id'";
        $sql2 = "DELETE FROM users WHERE user_id = '$user_id'";
        $res1 = mysqli_query($link, $sql1);
        $res2 = mysqli_query($link, $sql2);
        
        if (!$res1 || !$res2) {
            echo mysqli_error($link);
        }
    }
}

header("Location: accountapproval.php");

?>
