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
    <title>RLUH - Building Management</title>
    <link rel='icon' href='favicon.ico' type='image/x-icon'
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/rahomestyles.css" rel="stylesheet">
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
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents"
                   data-parent="#exampleAccordion">
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
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseDutyComponents"
                   data-parent="#exampleAccordion">
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
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>


<div class="content-wrapper">
    <div class="container-fluid">
        <h1>Area Management</h1>
        <div class="row">
            <div class="col-12">
                <b>Select Area: </b>

                <select name="area" id="area"
                        onchange=" location = 'areamanagement.php?area=' + this.options[this.selectedIndex].value">
                    <option value="" disabled selected hidden> Select an Area...</option>
                    <?php
                    $sql = "SELECT a.area_name FROM areas a";
                    $result = mysqli_query($link, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['area_name'] . '"> ' . $row['area_name'] . ' </option>';
                        }
                    }
                    ?>
                </select>
                <?php
                echo '<div class="margin"></div>';

                $area = $_GET["area"];
                $sql1 = "SELECT distinct b.building_name, b.building_id, g.grouping_name, a.area_name FROM buildings b " .
                    "JOIN groupings g ON (g.grouping_id = b.grouping_id) " .
                    "JOIN areas a ON (a.area_id = g.area_id) " .
                    "WHERE a.area_name ='$area'";
                $result1 = mysqli_query($link, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    echo '<h3>Buildings in ' . $area . '</h3>';

                    echo '<table style = "width: 100%" class = "info-text">';
                    echo '<tr>';
                    echo '<th style = "font-size: 1.1em"> Building Name </th>';
                    echo '<th style = "font-size: 1.1em"> Grouping </th>';
                    //echo '<th style = "font-size: 1.1em"> Area </th>';
                    echo '<th style = "font-size: 1.1em">  </th>';
                    //echo '<th style = "font-size: 1.1em">  </th>';
                    echo '</tr>';
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        echo '<tr>';
                        echo '<td>' . $row1["building_name"] . '</td>';
                        echo '<td>';
                        echo '<form action="editarea.php?user_id=' . $user_id . '&edit_building_id=' . $row1["building_id"] . '" method="POST">';
                        echo '<select name="groupingname" id="groupingname" onchange=" location = "areamanagement.php?area=' . $area . '>';
                        echo '<option value="" disabled selected hidden> ' . $row1["grouping_name"] . '</option>';
                        $sql2 = "SELECT g.grouping_name FROM groupings g";
                        $result2 = mysqli_query($link, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                echo '<option value="' . $row2['grouping_name'] . '"> ' . $row2['grouping_name'] . ' </option>';
                            }
                        }

                        echo '</select>';
                        echo '</td>';
                        echo '<td>';
                        echo '<input name="submit" type="submit" value="Submit">';
                        echo '</td>';
                        echo '</form>';
                        echo '</tr>';
                    }
                    echo '</table>';
                }
                $sql4 = "SELECT distinct g.grouping_name, g.grouping_id, a.area_name FROM groupings g " .
                    "JOIN areas a ON (a.area_id = g.area_id) " .
                    "WHERE a.area_name ='$area'";
                $result4 = mysqli_query($link, $sql4);
                if(mysqli_num_rows($result4) > 0) {
                    echo '<h3>Groupings in ' . $area . '</h3>';

                    echo '<table style = "width: 100%" class = "info-text">';
                    echo '<tr>';
                    echo '<th style = "font-size: 1.1em"> Grouping Name </th>';
                    echo '<th style = "font-size: 1.1em"> Area </th>';
                    echo '<th style = "font-size: 1.1em">  </th>';
                    //echo '<th style = "font-size: 1.1em">  </th>';
                    echo '</tr>';

                    while ($row4 = mysqli_fetch_assoc($result4)) {
                        echo '<tr>';
                        echo '<td>' . $row4["grouping_name"] . '</td>';
                        echo '<td>';
                        echo '<form action="editarea.php?user_id=' . $user_id . '&edit_grouping_id=' . $row4["grouping_id"] . '" method="POST" >';
                        echo '<select name="areaname" id="areaname" onchange=" location = "areamanagement.php?area=' . $area . '>';
                        echo '<option value="" disabled selected hidden> ' . $area . '</option>';
                        $sql3 = "SELECT a.area_name FROM areas a";
                        $result3 = mysqli_query($link, $sql3);
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                echo '<option value="' . $row3['area_name'] . '"> ' . $row3['area_name'] . ' </option>';
                            }
                        }

                        echo '</select>';
                        echo '<td>';
                        echo '<input name="submit" type="submit" value="Submit">';
                        echo '</td>';
                        echo '</form>';
                        echo '</tr>';
                    }
                    echo '</table>';
                }
                ?>

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
    </div>
</body>

</html>
