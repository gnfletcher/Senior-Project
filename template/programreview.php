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
    <title>RLUH - Program Review </title>
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top" id="mainNav">
    <a class="navbar-brand" href="rdhome.php?user_id=<?php echo $user_id; ?>">RLUH RD MAIN</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="rdhome.php?user_id=<?php echo $user_id; ?>">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Home</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">Programs</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <li>
                        <a href="programreview.php?user_id=<?php echo $user_id; ?>">Program Approval</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseConfComponents"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text"> Confiscation Logs </span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseConfComponents">
                    <li>
                        <a href="confiscationlog.php?user_id=<?php echo $user_id; ?>"> View Past Incidents </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Management">
                <a class="nav-link" href="usermanagement.php?user_id=<?php echo $user_id; ?>">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">User Management</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2> RD Program Approval </h2>
                <p> Approve or deny submitted programs here. </p>
            </div>
        </div>
    </div>

    <?php
    $rd_id = 0;
    $program_ids = array();
    $program_names = array();

    $rd_grouping_id = 0;

    $sql = "SELECT rd.grouping_id FROM resident_directors rd " .
        "WHERE rd.user_id = '$user_id'";
    $res = mysqli_query($link, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $rd_grouping_id = $row["grouping_id"];
    }

    $query = "SELECT DISTINCT p.program_id, p.program_title, CONCAT(u.fname, ' ', u.lname) AS name, p.program_date, p.status FROM programs p " .
	"JOIN users u ON (p.user_id = u.user_id) " .
    "WHERE (u.user_id IN ( " .
        "SELECT ra.user_id FROM resident_assistants ra " .
			"JOIN buildings b ON (ra.building_id = b.building_id) " .
		"WHERE b.grouping_id = '$rd_grouping_id') " .
	"OR u.user_id IN ( " .
        "SELECT ard.user_id FROM assistant_rds ard " .
		"WHERE ard.grouping_id = '$rd_grouping_id')) " .
    "AND p.status = 'Pending'";
    $result = mysqli_query($link, $query);


    if (mysqli_num_rows($result) > 0) {
        echo '<table style = "width: 100%" class = "info-text">';
        echo '<tr>';
        echo '<th style = "font-size: 1.1em"> Program Title </th>';
        echo '<th style = "font-size: 1.1em"> Submitted By </th>';
        echo '<th style = "font-size: 1.1em"> Program Date </th>';
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($program_ids, $row["program_id"]);
            array_push($program_names, $row["program_title"]);
            echo '<tr>';
            echo '<td>' . $row["program_title"] . '</td>';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>' . $row["program_date"] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p class = info-text> No program information to show. </p>';
    }

    echo '<h4> Actions </h4>';
    echo '<form action="programstatusupdate.php' . "?user_id=$user_id" . '" method="POST">';

    echo '<select name="program_id">';
    echo '<option value="" disabled selected hidden> Select a program... </option>';
    for ($i = 0; $i < count($program_ids); $i++) {
        echo '<option value="' . $program_ids[$i] . '"> ' . $program_ids[$i] . ' - ' . $program_names[$i] . ' </option>';
    }
    echo '</select>';

    echo '<select name="action">';
    echo '<option value="Approve"> Approve </option>';
    echo '<option value="Deny"> Deny </option>';
    echo '</select>';

    echo '<input name="submit" type="submit">';

    echo '</form>';

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
