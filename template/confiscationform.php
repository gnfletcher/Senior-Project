<?php
session_start();
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
    <title>RLUH - Confiscation Log</title>
    <link rel='icon' href='favicon.ico' type='image/x-icon'/>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top" id="mainNav">
    <a class="navbar-brand" href="rahome.php">Confiscation Log</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
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
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="confiscationform.php">
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
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>
<!--****START WORKING HERE*****************************************************************************-->
<!-- NOTE USE <form> before and after all this code to submit information -->
<!-- look up form... it uses php -->

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- USE FORM TO SELECT ALL DATA -->
                <div>
                    <h1>Confiscation Log</h1>
                    <p>This page is for recording information for confiscated items.</p>
                </div>
                <form action="conflogsubmit.php" method="POST">
                    <p>
                        <label for="name"> Student Name: </label>
                        <input name="name" type="text" id="name">
                    </p>
                    <p>
                        <label for="building"> Building: </label>
                        <select name="building" id="building">
                            <option value="" disabled selected hidden> Select a Building...</option>
                            <?php
                            $sql1 = "SELECT building_name FROM buildings";
                            $result1 = mysqli_query($link, $sql1);
                            if (mysqli_num_rows($result1) > 0) {
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    echo '<option value="' . $row['building_name'] . '"> ' . $row['building_name'] . ' </option>';
                                }
                            }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label for="room"> Room Number: </label>
                        <input name="room" type="text" id="room">
                    </p>

                    <p>
                        <label for="date"> Date of Incident: </label>
                        <input name="date" type="date" id="date">
                    </p>

                    <p>
                        <label for="item"> Prohibited Item: </label>
                        <input name="item" type="text" id="item">
                    </p>
                    <p>
                        <label for="location"> Item Location: </label>
                        <textarea name="location" id="location" rows="4" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="notes"> Additional Notes: </label>
                        <textarea name="notes" id="notes" rows="4" cols="50"></textarea>
                    </p>

                    <br>
                    <br>
                    <br>
                    <input name="submit" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>


<!--****END WORKING HERE*********************************************************************************-->
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
