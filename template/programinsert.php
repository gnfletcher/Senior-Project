<?php
session_start();

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

var_dump($_POST);

$program_title = mysqli_real_escape_string($link, $_POST['program_title']);

$query = "INSERT INTO programs (program_title) VALUES ('$program_title')";

if(!mysqli_query($link, $query)) {
    die('Error!!!');
} else {
    echo "Records added successfully.";
}

?>
