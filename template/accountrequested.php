<?php
session_start();
include 'connect.php';
$user_id = $_GET['user_id'];
$user_type = $_SESSION["user_type"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>RLUH Website</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body>

<?php
if (isset($_POST)) {
    $fname = mysqli_real_escape_string($link, $_POST['fname']);
    $lname = mysqli_real_escape_string($link, $_POST['lname']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $building = $_POST['building'];
    $position = $_POST['position'];

    $sql1 = "SELECT building_id FROM buildings WHERE (building_name = '$building')";
    $result1 = mysqli_query($link, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while($row = mysqli_fetch_assoc($result1)) {
            $building_id = $row["building_id"];
        }
    }

    $sql2 = "INSERT INTO users (fname, lname, email, account_status) VALUES ('$fname', '$lname', '$email', 'Pending Approval')";
    $res2 = mysqli_query($link, $sql2);
    if (!$res2) {
        echo '<h3> Unsuccessful Submission.' . mysqli_error($link);
        die();
    } else {
        $sql3 = "INSERT INTO resident_assistants (user_id, building_id) VALUES (LAST_INSERT_ID(), '$building_id')";
        $res3 = mysqli_query($link, $sql3);
    }
}
?>


<h3>Successful Request!</h3>
<p> You will be notified as soon as possible on your request</p>
<a class="d-block small" href="login.html"> Back to Login </a>
</body>
</html>