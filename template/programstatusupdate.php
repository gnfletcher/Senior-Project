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

$user_id = $_GET['user_id'];

if (isset($_POST['submit'])) {
    $program_id = $_POST['program_id'];
    $new_status;
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

header("Location: programapproval.php?user_id=$user_id");


?>