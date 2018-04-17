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
    <title>RLUH - Program Budgeting</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="ardhome.php?user_id=<?php echo $user_id; ?>">RLUH ARD MAIN</a>
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

            <div class="col-lg-7">
                <h1>Program Budgeting</h1>

                <div class="margin"></div>
                <?php
                $user_id = $_GET["user_id"];
                $name = "";
                $sql = "SELECT program_title, program_date, proposal_date, concat(ra.fname, ' ', ra.lname) AS name FROM programs p " .
                    "JOIN program_proposers pp ON (p.program_id = pp.program_id) " .
                    "JOIN resident_assistants ra ON (pp.ra_id = ra.ra_id) " .
                    "JOIN users u ON (u.user_id = ra.user_id) " .
                    "WHERE ra.ra_id IN " .
                    "(SELECT ra_id FROM resident_assistants ra " .
                    "JOIN buildings b ON (b.building_id = ra.building_id) " .
                    "JOIN groupings g ON (g.grouping_id = b.grouping_id) " .
                    "JOIN assistant_rds ard ON (ard.grouping_id = g.grouping_id) " .
                    "WHERE ard.ard_id = " .
                    "(SELECT ard_id FROM assistant_rds ard " .
                    "JOIN users u ON (u.user_id = ard.user_id) " .
                    "WHERE u.user_id = '$user_id'))";
                $result = mysqli_query($link, $sql);


//                $num_rows = mysqli_num_rows($result);
//                echo '<p>' . $num_rows . '</p>';
                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="margin"></div>';
                    echo '<h3 class = "text-center"> Program Details </h3>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="card mb-3">';
                        echo '<div class="card-header" style="background-color: #EDD51C"> Program Title: ' . $row["program_title"] . '</div>';
                        echo '<div class="card-body"> Requested by: ' . $row["name"] . '</div>';
                        echo '<div class="card-body"> Date of program: ' . $row["program_date"] . '</div>';
                        echo '<div class="card-body"> Date Requested: ' . $row["proposal_date"] . '</div>';
                        echo '<div class="card-body">Requested Funds: ' . $row["requested_funds"] . '</div>';
                echo '</div>';
                    }
                } else {
                    echo '<h5 class = "text-center"> No Program information to show</h5>';;
                }
                ?>




<!--                <div class="card mb-3">-->
<!--                    <div class="card-header">Proposed Program #1</div>-->
<!--                    <div class="card-body">Date:</div>-->
<!--                    <div class="card-body">Requested Funds:</div>-->
<!--                    <div class="card-body">Vendors:</div>-->
<!--                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
<!--                </div>-->
<!--                <div class="card mb-3">-->
<!--                    <div class="card-header">Proposed Program #2</div>-->
<!--                    <div class="card-body">Date:</div>-->
<!--                    <div class="card-body">Requested Funds:</div>-->
<!--                    <div class="card-body">Vendors:</div>-->
<!--                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
<!--                </div>-->
<!--                <div class="card mb-3">-->
<!--                    <div class="card-header">Proposed Program #3</div>-->
<!--                    <div class="card-body">Date:</div>-->
<!--                    <div class="card-body">Requested Funds:</div>-->
<!--                    <div class="card-body">Vendors:</div>-->
<!--                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
<!--                </div>-->


            </div>
            <div class="col-lg-5">
                <div>
                    <h3>Budgets:</h3>
                </div>
                <?php
                $user_id = $_GET["user_id"];
                $sql2 = "SELECT concat(fname, ' ', lname) AS name FROM users u " .
                    "JOIN resident_assistants ra ON (u.user_id = ra.user_id) " .
                    "JOIN buildings b ON (b.building_id = ra.building_id) " .
                    "JOIN groupings g ON (b.grouping_id = g.grouping_id) " .
                    "JOIN assistant_rds ard ON (ard.grouping_id = g.grouping_id) " .
                    "WHERE ard.ard_id = " .
                    "(SELECT ard_id FROM assistant_rds ard " .
                    "JOIN users u ON (u.user_id = ard.user_id) " .
                    "WHERE u.user_id = '$user_id') ";
                $result2 = mysqli_query($link, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    echo '<div class="card mb-3">';
                    echo '<div class="card-header" style="background-color: #EDD51C"> ' . $row2["name"] . '</div>';
                    echo '<div class="card-body">Budget:</div>';
                    echo '<div class="card-body">Remaining:</div>';
                    echo '</div>';
                }

                } else {
                    echo '<p>No Budget Information to show</p>';
                }
                ?>
<!--                <div class="card mb-3">-->
<!--                    <div class="card-header">RA #1</div>-->
<!--                    <div class="card-body">Budget:</div>-->
<!--                    <div class="card-body">Remaining</div>-->
<!--                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
<!--                </div>-->
<!--                <div class="card mb-3">-->
<!--                    <div class="card-header">RA #2</div>-->
<!--                    <div class="card-body">Budget:</div>-->
<!--                    <div class="card-body">Remaining:</div>-->
<!--                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
<!--                </div>-->
                <div class="card mb-3">
                    <div class="card-header" style="background-color: #EDD51C">Hall Council Budget</div>
                    <div class="card-body">Budget:</div>
                    <div class="card-body">Remaining:</div>
                </div>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>
</body>

</html>