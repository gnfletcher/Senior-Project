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
                <h2> New User Account Approval </h2>
                <p> Approve or deny submitted account requests here. </p>
            </div>
        </div>
    </div>

    <?php
    $user_ids = array();
    $fnames = array();
    $lnames = array();

    $sql = "SELECT u.user_id, u.fname, u.lname, u.email, b.building_name FROM users u " .
        "JOIN resident_assistants ra ON (u.user_id = ra.user_id) " .
        "JOIN buildings b ON (ra.building_id = b.building_id) " .
        "WHERE u.account_status = 'Pending Approval'";
    $res = mysqli_query($link, $sql);
    if (mysqli_num_rows($res) > 0) {
        echo '<table style = "width: 75%" class = "info-text">';
        echo '<tr>';
        echo '<th style = "font-size: 1.1em"> First Name </th>';
        echo '<th style = "font-size: 1.1em"> Last Name </th>';
        echo '<th style = "font-size: 1.1em"> Email Address </th>';
        echo '<th style = "font-size: 1.1em"> Assigned Building </th>';
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($res)) {
            array_push($user_ids, $row["user_id"]);
            array_push($fnames, $row["fname"]);
            array_push($lnames, $row["lname"]);
            echo '<tr>';
            echo '<td>' . $row["fname"] . '</td>';
            echo '<td>' . $row["lname"] . '</td>';
            echo '<td>' . $row["email"] . '</td>';
            echo '<td>' . $row["building_name"] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p class = info-text> No pending users to show. </p>';
    }

    echo '<h4> Actions </h4>';
    echo '<form action="accountstatusupdate.php?user_id="' . $user_id  . '" method="POST">';
    echo '<select name="user_id">';
    echo '<option value="" disabled selected hidden> Select a user... </option>';
    for ($i = 0; $i < count($fnames); $i++) {
        echo '<option value="' . $user_ids[$i] . '"> ' . $fnames[$i] . ' ' . $lnames[$i] . ' </option>';
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
</body>
</html>
