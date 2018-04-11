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
    <title>RLUH - ARD Home</title>
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
    <a class="navbar-brand" href="ardhome.php?user_id=<?php echo $user_id; ?>">RLUH</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="ardhome.php?user_id=<?php echo $user_id; ?>">
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
                        <a href="ardprogrambudgeting.php?user_id=<?php echo $user_id; ?>">Program Budgeting</a>
                    </li>
                </ul>
            </li>
<!--            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">-->
<!--                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseDutyComponents"-->
<!--                   data-parent="#exampleAccordion">-->
<!--                    <i class="fa fa-fw fa-table"></i>-->
<!--                    <span class="nav-link-text">Duty</span>-->
<!--                </a>-->
<!--                <ul class="sidenav-second-level collapse" id="collapseDutyComponents">-->
<!--                    <li>-->
<!--                        <a href="dutyschedule.php">Duty Scheduling</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="switchrequest.php">Switch Duty Request</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseConfComponents"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text"> Confiscation Logs </span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseConfComponents">
<!--                    <li>-->
<!--                        <a href="confiscationform.php?user_id=--><?php //echo $_GET['user_id']; ?><!--"> Submit an Incident </a>-->
<!--                    </li>-->
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
                <h1>ARD Home Page</h1>
            </div>
        </div>
    </div>

    <div class="header-container">
        <?php
        $user_id = $_GET["user_id"];
        $name = "";
        $sql = "SELECT fname, lname FROM users u " .
            "JOIN assistant_rds ard ON (ard.user_id = u.user_id) " .
            "WHERE u.user_id = '$user_id'";
        $result = mysqli_query($link, $sql);

        $sql2 = "SELECT building_name FROM users u " .
            "JOIN assistant_rds ard ON (ard.user_id = u.user_id) " .
            "JOIN ard_buildings ardb ON (ardb.ard_id = ard.ard_id) " .
            "JOIN buildings b ON (ardb.building_id = b.building_id) " .
            "WHERE u.user_id = '$user_id'";
        $result2 = mysqli_query($link, $sql2);
        $num_rows = mysqli_num_rows($result2);
        if (mysqli_num_rows($result) > 0) {
            echo '<h3 class = "text-center"> User Details </h3>';
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row["fname"] . " " . $row["lname"];
                echo '<p class = "info-text">' . $name . '</p>';
                echo '<p class = "info-text"> Position: Assistant Resident Director</p>';
            }
        } else {
            echo '<h5 class = "text-center"> This user is not an ARD. Access denied. </h5>';;
        }

        if (mysqli_num_rows($result2) > 0) {
            $i = 1;
            echo '<p class = "info-text"> Assigned Building: ';
            while ($row2 = mysqli_fetch_assoc($result2)) {
                echo $row2["building_name"];
                if ($i < $num_rows) {
                    echo ', ';
                }
                $i++;

            }
            echo '</p>';
        } else {
            echo '<p class="info-text"> Currently not assigned to any buildings. </p>';
        }
        ?>
    </div>


    <div class="calendar-container">
        <?php
        $user_id = $_GET["user_id"];
        $sql = "SELECT email FROM users u WHERE u.user_id = '$user_id'";
        $result = mysqli_query($link, $sql);
        $emailUser = "";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $emailUser = $row["email"];
            }
        } else {
            echo '';;
        }
        $emailUserCal = str_replace('@', '%40', $emailUser);
        echo '<iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=' . $emailUserCal . '&amp;color=%231B887A&amp;ctz=America%2FNew_York" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>';
        ?>
    </div>


    <div class="main-container">

        <?php
        $user_id = $_GET["user_id"];
        $name = "";
        $sql1 = "SELECT fname, lname FROM users u " .
            "JOIN resident_assistants ra ON (u.user_id = ra.user_id) " .
            "JOIN assistant_rds ard ON (ra.ard_id = ard.ard_id) " .
            "WHERE ra.ard_id = " .
            "(SELECT ard_id FROM assistant_rds ard " .
            "JOIN users u ON (u.user_id = ard.user_id) " .
            "WHERE u.user_id = '$user_id')";
        $result = mysqli_query($link, $sql1);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="content-container">';
            echo '<div class = "row">';
            echo '<div class = "yellow-bar">';
            echo '<h3 class = "header-text">RA Progress</h3>';
            echo '</div>';
            echo '</div>';
            echo '<div class="container">';
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row["fname"] . " " . $row["lname"];

                echo '<p class="info-text"> ' . $i . '. ' . $name . '</p>';
                echo '<div class="progress">';
                echo '<div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>';
                echo '</div>';
                echo '<p> 
                </p>';
                $i++;

            }
            echo '</div>';
            echo '</div>';
        } else {
        }
        ?>

    </div>

    <div class="margin"></div>

    <div class="right-main-container">
        <div class="content-container">
            <!-- Program Information -->
            <div class="row">
                <div class="yellow-bar">
                    <h3 class="header-text"> Announcements </h3>
                </div>
            </div>
            <div class="container">
                <p class="info-text"> Good Things </p>
                <p class="info-text"> Bad Things </p>
            </div>
        </div>

        <div class="margin"></div>

        <div class="content-container">
            <!-- Program Information -->
            <div class="row">
                <div class="yellow-bar">
                    <h3 class="header-text"> To Do </h3>
                </div>
            </div>
            <div class="container">
                <p class="info-text"> Party for RA 1 </p>
                <p class="info-text"> Shame RA 2 </p>
                <p class="info-text"> Switch </p>
            </div>
        </div>
    </div>


    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Your Website 2018</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
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
