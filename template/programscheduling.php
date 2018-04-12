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
    <title>RLUH - Programs</title>
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
    <a class="navbar-brand" href="rahome.php?user_id=<?php echo $user_id; ?>">RLUH RA MAIN</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="rahome.php?user_id=<?php echo $user_id; ?>">
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
                        <a href="programproposal.php?user_id=<?php echo $user_id; ?>">Program Proposal</a>
                    </li>
                    <li>
                        <a href="programscheduling.php?user_id=<?php echo $user_id; ?>">Program Scheduling</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseDutyComponents"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Duty</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseDutyComponents">
                    <li>
                        <a href="dutyschedule.php?user_id=<?php echo $user_id; ?>">Duty Scheduling</a>
                    </li>
                    <li>
                        <a href="switchrequest.php?user_id=<?php echo $user_id; ?>">Switch Duty Request</a>
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
                        <a href="confiscationform.php?user_id=<?php echo $user_id; ?>"> Submit an Incident </a>
                    </li>
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

<!-- Main Content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2> RA Program Scheduling </h2>
                <p> Welcome to RA Program Scheduling Page! </p>
            </div>
        </div>
    </div>

    <div class="header-container">

    </div>

    <div class="calendar-container">
        <iframe
            src="https://calendar.google.com/calendar/embed?src=soistmant5%40students.rowan.edu&ctz=America%2FNew_York"
            style="border: 0; float:right;" width="700" height="400" frameborder="0" scrolling="no"></iframe>
    </div>

    <div class="main-container">
        <div class="content-container">
            <div class="row">
                <div class="yellow-bar">
                    <h3 class="header-text"> Community Builder Programs </h3>
                </div>
            </div>
            <table style="width: 100%" class="info-text">
                <tr>
                    <th style="font-size: 1.1em"> Program Date</th>
                    <th style="font-size: 1.1em"> Title</th>
                    <th style="font-size: 1.1em"> Points</th>
                </tr>
                <tr>
                    <td> 2018-01-24</td>
                    <td> Paint the Hood</td>
                    <td> 3 pts.</td>
                </tr>
                <tr>
                    <td> 2018-02-14</td>
                    <td> Love is in the air</td>
                    <td> 3 pts.</td>
                </tr>
            </table>
        </div>

        <div class="margin"></div>

        <div class="content-container">
            <div class="row">
                <div class="yellow-bar">
                    <h3 class="header-text"> Campus Outreach Programs </h3>
                </div>
            </div>
            <table style="width: 100%" class="info-text">
                <tr>
                    <th style="font-size: 1.1em"> Program Date</th>
                    <th style="font-size: 1.1em"> Title</th>
                    <th style="font-size: 1.1em"> Points</th>
                </tr>
                <tr>
                    <td> 2018-04-01</td>
                    <td> Prank Your Residents!</td>
                    <td> 100 pts.</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="right-main-container">
        <div class="content-container">
            <!-- Program Information -->
            <div class="row">
                <div class="yellow-bar">
                    <h3 class="header-text"> Announcements </h3>
                </div>
            </div>
            <div class="container">
                <p class="info-text"> Spring Break! </p>
                <p class="info-text"> Apply to Graduate by 2/28! </p>
                <p class="info-text"> Switch </p>
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

