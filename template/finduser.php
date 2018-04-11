<?php
session_start();
include 'connect.php';


$email = $_GET["email"];
$user_id = "";

$sql = "SELECT user_id FROM users u WHERE u.email = '$email'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["user_id"];
} else {
    //header("Location: https://swang.devspace.link/dev/register.php");
    header("Location: register.php");
    die();
}

$sql1 = "SELECT ra.ra_id FROM resident_assistants ra WHERE (ra.user_id = '$user_id')";
$res1 = mysqli_query($link, $sql1);
$sql2 = "SELECT rd.rd_id FROM resident_directors rd WHERE (rd.user_id = '$user_id')";
$res2 = mysqli_query($link, $sql2);
$sql3 = "SELECT ard.ard_id FROM assistant_rds ard WHERE (ard.user_id = '$user_id')";
$res3 = mysqli_query($link, $sql3);

if (mysqli_num_rows($res1) > 0) {
    //header("Location: https://swang.devspace.link/dev/rahome.php?user_id=" . $user_id);
    $_SESSION["user_type"] = "ra";
    header("Location: rahome.php?user_id=" . $user_id);
} elseif (mysqli_num_rows($res2) > 0) {
    //header("Location: https://swang.devspace.link/dev/rdhome.php?user_id=" . $user_id);
    $_SESSION["user_type"] = "rd";
    header("Location: rdhome.php?user_id=" . $user_id);
}  elseif (mysqli_num_rows($res3) > 0) {
    //header("Location: https://swang.devspace.link/dev/ardhome.php?user_id=" . $user_id);
    $_SESSION["user_type"] = "ard";
    header("Location: ardhome.php?user_id=" . $user_id);
}

//header("Location: https://swang.devspace.link/dev/rahome.php?user_id=" . $user_id);
die();
?>