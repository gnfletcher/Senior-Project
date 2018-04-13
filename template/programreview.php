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
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="usersettings.html">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">Settings</span>
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

    $sql1 = "SELECT rd.rd_id FROM resident_directors rd WHERE rd.user_id = '$user_id'";
    $result1 = mysqli_query($link, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            $rd_id = $row["rd_id"];
        }
    }

    $sql2 = "SELECT DISTINCT p.program_id, p.program_title, p.proposal_date, p.program_date, p.goals, p.status FROM programs p " .
        "JOIN program_proposers pp ON (p.program_id = pp.program_id) " .
        "JOIN resident_assistants ra ON (pp.ra_id = ra.ra_id) " .
        "WHERE ra.rd_id = '$rd_id'";
    $result2 = mysqli_query($link, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        echo '<table style = "width: 100%" class = "info-text">';
        echo '<tr>';
        echo '<th style = "font-size: 1.1em"> Program Title </th>';
        echo '<th style = "font-size: 1.1em"> Proposal Date </th>';
        echo '<th style = "font-size: 1.1em"> Program Date </th>';
        echo '<th style = "font-size: 1.1em"> Goals/Objectives </th>';
        echo '<th style = "font-size: 1.1em"> Status </th>';
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($result2)) {
            array_push($program_ids, $row["program_id"]);
            array_push($program_names, $row["program_title"]);
            echo '<tr>';
            echo '<td>' . $row["program_title"] . '</td>';
            echo '<td>' . $row["proposal_date"] . '</td>';
            echo '<td>' . $row["program_date"] . '</td>';
            echo '<td>' . $row["goals"] . '</td>';
            echo '<td>' . $row["status"] . '</td>';
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
