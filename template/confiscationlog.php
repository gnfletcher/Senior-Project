<?php
include 'connect.php';
$user_id = $_GET['user_id'];
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
    <link rel='icon' href='favicon.ico' type='image/x-icon'/ >
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
    <a class="navbar-brand" href="rahome.php">RA Main</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="rahome.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Home</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">Programs</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <li>
                        <a href="programproposal.php">Program Proposal</a>
                    </li>
                    <li>
                        <a href="programscheduling.php">Program Scheduling</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseDutyComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Duty</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseDutyComponents">
                    <li>
                        <a href="dutyschedule.php">Duty Scheduling</a>
                    </li>
                    <li>
                        <a href="switchrequest.php">Switch Duty Request</a>
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
                        <a href="confiscationform.php?user_id=<?php echo $_GET['user_id']; ?>"> Submit an Incident </a>
                    </li>
                    <li>
                        <a href="confiscationlog.php?user_id=<?php echo $_GET['user_id']; ?>"> View Past Incidents </a>
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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-envelope"></i>
                <span class="d-lg-none">Messages
                  <span class="badge badge-pill badge-primary">12 New</span>
                </span>
                <span class="indicator text-primary d-none d-lg-block">
                  <i class="fa fa-fw fa-circle"></i>
                </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">New Messages:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>David Miller</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">Hey there!
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>Jane Smith</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I was wondering if you could meet for an appointment
                            at 3:00 instead of 4:00. Thanks!
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>John Doe</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I've sent the final files over to you for review. When
                            you're able to sign off of them let me know and we can discuss distribution.
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="#">View all messages</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                <span class="d-lg-none">Alerts
                  <span class="badge badge-pill badge-warning">6 New</span>
                </span>
                <span class="indicator text-warning d-none d-lg-block">
                  <i class="fa fa-fw fa-circle"></i>
                </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">New Alerts:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                  <span class="text-success">
                    <strong>
                        <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                  </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message.
                            All systems are online.
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                  <span class="text-danger">
                    <strong>
                        <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                  </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message.
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                  <span class="text-success">
                    <strong>
                        <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                  </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message.
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="#">View all alerts</a>
                </div>
            </li>
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0 mr-lg-2">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for...">
                  <span class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                  </span>
                    </div>
                </form>
            </li>
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
                <h2> Confiscation Log </h2>
                <p> View information regarded confiscated items & incidents. </p>
                <a href="confiscationlog.php?user_id=<?php echo $user_id ?>&view=all"> View All </a>
                <a href="confiscationlog.php?user_id=<?php echo $user_id ?>&view=recent"> View Last 30 Days </a>
            </div>
        </div>
    </div>

    <?php
    $rd_id = 0;

    $sql1 = "SELECT rd.rd_id FROM resident_directors rd WHERE rd.user_id = '$user_id'";
    $result1 = mysqli_query($link, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while($row = mysqli_fetch_assoc($result1)) {
            $rd_id = $row["rd_id"];
        }
    }

    if (isset($_GET['view'])) {
        if ($_GET['view'] == "all") {
            $sql = "SELECT CONCAT(u.fname, ' ', u.lname) AS ra_name, c.student_name, CONCAT(b.building_name, ' ', c.room) AS building, c.date, c.item_description, c.item_location, c.notes FROM confiscation_log c " .
                "JOIN buildings b ON (c.building_id = b.building_id) " .
                "JOIN resident_assistants ra ON (c.ra_id = ra.ra_id) " .
                "JOIN users u ON (ra.user_id = u.user_id)";
        } elseif ($_GET['view'] == "recent") {
            $sql = "SELECT CONCAT(u.fname, ' ', u.lname) AS ra_name, c.student_name, CONCAT(b.building_name, ' ', c.room) AS building, c.date, c.item_description, c.item_location, c.notes FROM confiscation_log c " .
                "JOIN buildings b ON (c.building_id = b.building_id) " .
                "JOIN resident_assistants ra ON (c.ra_id = ra.ra_id) " .
                "JOIN users u ON (ra.user_id = u.user_id) " .
                "WHERE c.date >= (curdate() - 30)";
        }
    } else {
        $sql = "SELECT CONCAT(u.fname, ' ', u.lname) AS ra_name, c.student_name, CONCAT(b.building_name, ' ', c.room) AS building, c.date, c.item_description, c.item_location, c.notes FROM confiscation_log c " .
            "JOIN buildings b ON (c.building_id = b.building_id) " .
            "JOIN resident_assistants ra ON (c.ra_id = ra.ra_id) " .
            "JOIN users u ON (ra.user_id = u.user_id) " .
            "WHERE ra.rd_id = '$rd_id'";
    }

    $result = mysqli_query($link, $sql);
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
        while($row = mysqli_fetch_assoc($result)) {
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
</body>
</html>
