<?php
session_start();
include 'connect.php';
$user_id = $_GET['user_id'];
$user_type = $_SESSION["user_type"];

if (!isset($_SESSION["user_type"])) {
    echo '<p> You do not have access to this page! </p>';
    header("refresh:5; url=login.html");
    die();
}
?>
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>RLUH - Confiscation Log </title>
    <link rel='icon' href='favicon.ico' type='image/x-icon'
    / >
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/rahomestyles.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,800" rel="stylesheet">
</head>

<body class="sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php
if ($user_type == "ra") {
    include 'ranav.php';
} elseif ($user_type == "rd") {
    include 'rdnav.php';
} elseif ($user_type == "ard") {
    include 'ardnav.php';
}
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p> " "</p>
                <h2> Confiscation Log </h2>
                <p> View information regarded confiscated items & incidents. </p>
                <a href="confiscationlog.php?user_id=<?php echo $user_id ?>&view=all"> View All </a>
                <a href="confiscationlog.php?user_id=<?php echo $user_id ?>&view=recent"> View Last 30 Days </a>
            </div>
        </div>
    </div>

    <?php
    $ra_id = 0;
    $grouping_id = 0;
    $area_id = 0;

    if ($user_type == "ra") {
        $sql = "SELECT ra.ra_id FROM resident_assistants ra WHERE ra.user_id = '$user_id'";
        $res = mysqli_query($link, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $ra_id = $row["ra_id"];
            }
        }
        $info_query = "SELECT CONCAT(u.fname, ' ', u.lname) AS ra_name, c.student_name, CONCAT(b.building_name, ' ', c.room) AS building, c.date, c.item_description, c.item_location, c.notes FROM confiscation_log c " .
            "JOIN buildings b ON (c.building_id = b.building_id) " .
            "JOIN users u ON ('$user_id' = u.user_id) " .
            "WHERE c.ra_id = '$ra_id'";
    } elseif ($user_type == "ard") {
        $info_query = "SELECT CONCAT(u.fname, ' ', u.lname) AS ra_name, c.student_name, CONCAT(b.building_name, ' ', c.room) AS building, c.date, c.item_description, c.item_location, c.notes FROM confiscation_log c " .
            "JOIN resident_assistants ra ON (c.ra_id = ra.ra_id) " .
            "JOIN buildings b ON (ra.building_id = b.building_id) " .
            "JOIN users u ON (ra.user_id = u.user_id) " .
            "WHERE b.grouping_id = (SELECT grouping_id FROM assistant_rds WHERE user_id = '$user_id')";
    } elseif ($user_type == "rd") {
        $sql = "SELECT rd.rd_id, rd.grouping_id FROM resident_directors rd WHERE rd.user_id = '$user_id'";
        $res = mysqli_query($link, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $rd_id = $row["rd_id"];
                $grouping_id = $row["grouping_id"];
            }
        }
        $info_query = "SELECT CONCAT(u.fname, ' ', u.lname) AS ra_name, c.student_name, CONCAT(b.building_name, ' ', c.room) AS building, c.date, c.item_description, c.item_location, c.notes FROM confiscation_log c " .
            "JOIN resident_assistants ra ON (c.ra_id = ra.ra_id) " .
            "JOIN buildings b ON (ra.building_id = b.building_id) " .
            "JOIN users u ON (ra.user_id = u.user_id) " .
            "WHERE b.grouping_id = '$grouping_id'";
    } elseif ($user_type = "rlc") {
        $sql = "SELECT rlc.rlc_id, rlc.area_id FROM rlcs rlc WHERE rlc.user_id = '$user_id'";
        $res = mysqli_query($link, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $rlc_id = $row["rlc_id"];
                $area_id = $row["area_id"];
            }
        }
        $info_query = "SELECT CONCAT(u.fname, ' ', u.lname) AS ra_name, c.student_name, CONCAT(b.building_name, ' ', c.room) AS building, c.date, c.item_description, c.item_location, c.notes FROM confiscation_log c " .
            "JOIN resident_assistants ra ON (c.ra_id = ra.ra_id) " .
            "JOIN buildings b ON (ra.building_id = b.building_id) " .
            "JOIN groupings g ON (b.grouping_id = g.grouping_id) " .
            "JOIN users u ON (ra.user_id = u.user_id) " .
            "WHERE g.area_id = '$area_id'";
    }

    $result = mysqli_query($link, $info_query);

    if (mysqli_num_rows($result) > 0) {
        echo '<table style = "width: 100%; table-layout: auto" class = "info-text">';
        echo '<tr>';
        echo '<th style = "font-size: 1.1em"> RA on Duty </th>';
        echo '<th style = "font-size: 1.1em"> Student Name </th>';
        echo '<th style = "font-size: 1.1em"> Building/Room </th>';
        echo '<th style = "font-size: 1.1em"> Incident Date </th>';
        echo '<th style = "font-size: 1.1em"> Item(s) Description </th>';
        echo '<th style = "font-size: 1.1em"> Item(s) Location </th>';
        echo '<th style = "font-size: 1.1em"> Additional Notes </th>';
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row["ra_name"] . '</td>';
            echo '<td>' . $row["student_name"] . '</td>';
            echo '<td>' . $row["building"] . '</td>';
            echo '<td>' . $row["date"] . '</td>';
            echo '<td>' . $row["item_description"] . '</td>';
            echo '<td>' . $row["item_location"] . '</td>';
            echo '<td style="width:22em">' . $row["notes"] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p class = info-text> No confiscation information to show. </p>';
    }
    
    ?>
</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>
</body>
</html>
