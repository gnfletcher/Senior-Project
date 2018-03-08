<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Start Bootstrap Template</title>
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

<body class="fixed-nav  bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">RA Main</a>
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
              <a href="programproposal.html">Program Proposal</a>
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
              <a href="dutyschedule.html">Duty Scheduling</a>
            </li>
            <li>
              <a href="switchrequest.html">Switch Duty Request</a>
            </li>
          </ul>
        </li>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="confiscationlog.html">
                <i class="fa fa-fw fa-file"></i>
                <span class="nav-link-text">Confiscation Log</span>
            </a>
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

<!-- Main Content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2> RA Home Page </h2>
                <p> Welcome to the RLUH Portal! </p>
            </div>
        </div>
    </div>

    <div class = "header-container">
        <?php
        $user_id = $_GET["user_id"];
        $name = "";
        $sql = "SELECT fname, lname, building_name, area_name FROM users u " .
            "JOIN resident_assistants ra ON (ra.user_id = u.user_id) " .
            "JOIN buildings b ON (b.building_id = ra.building_id) " .
            "JOIN areas a ON (a.area_id = b.area_id) " .
            "WHERE u.user_id = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<h3 class = "text-center"> User Details </h3>';
            while($row = $result->fetch_assoc()) {
                $name = $row["fname"] . " " . $row["lname"];
                echo '<p class = "info-text">' . $name . '</p>';
                echo '<p class = "info-text"> Area: ' .  $row["area_name"] . ", Building: " . $row["building_name"] . '</p>';
                echo '<p class = "info-text"> Position: Resident Assistant</p>';
            }
        } else {
            echo '<h5 class = "text-center"> This user is not an RA. Access denied. </h5>';;
        }
        ?>
    </div>

    <div class = "calendar-container">
        <iframe src="https://calendar.google.com/calendar/embed?src=soistmant5%40students.rowan.edu&ctz=America%2FNew_York"
            style="border: 0; float:right;" width="700" height="400" frameborder="0" scrolling="no"></iframe>
    </div>

    <div class = "main-container">
        <div class = "content-container">
            <!-- Program Information -->
            <div class = "row">
                <div class = "yellow-bar">
                    <h3 class = "header-text"> Your Programs </h3>
                </div>
            </div>

            <div class = "container">
                <?php
                $user_id = $_GET["user_id"];
                    $sql = "SELECT p.program_date, p.program_name, p.status FROM programs p " .
                        "JOIN program_proposers pp ON (pp.program_id = p.program_id) " .
                        "JOIN resident_assistants ra ON (ra.ra_id = pp.ra_id) " .
                        "JOIN users u ON (u.user_id = ra.user_id) " .
                        "WHERE u.user_id = '$user_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<table style = "width: 100%" class = "info-text">';
                    echo '<tr>';
                        echo '<th style = "font-size: 1.1em"> Program Date </th>';
                        echo '<th style = "font-size: 1.1em"> Title</th>';
                        echo '<th style = "font-size: 1.1em"> Approval Status </th>';
                    echo '</tr>';
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["program_date"] . '</td>';
                        echo '<td>' . $row["program_name"] . '</td>';
                        echo '<td>' . $row["status"] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p class = info-text> No program information to show. </p>';
                }
                ?>
            </div>
        </div>

        <div class = "margin"> </div>

        <!-- Useful Links -->
        <div class = "content-container">
            <div class = "row">
                <div class = "yellow-bar">
                    <h3 class = "header-text"> Useful Links </h3>
                </div>
            </div>
            <div class = "container">
                <p class = "info-text"><a href = "rahome.php"> Duty Schedule </a></p>
                <p class = "info-text"><a href = "programproposal.html"> Create a New Program </a></p>
                <p class = "info-text"><a href = "rahome.php"> Switch </a></p>
            </div>
        </div>
    </div>

    <div class = "right-main-container">
        <div class = "content-container">
            <!-- Program Information -->
            <div class = "row">
                <div class = "yellow-bar">
                    <h3 class = "header-text"> Announcements </h3>
                </div>
            </div>
            <div class = "container">
                <p class = "info-text"> Spring Break! </p>
                <p class = "info-text"> Apply to Graduate by 2/28! </p>
                <p class = "info-text"> Switch </p>
            </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
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
