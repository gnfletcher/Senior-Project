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


<!-- Program Proposal Form -->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Resident Assistant Program Proposal</h1>
                <p>This page is to add a program proposal.</p>

                <form action="programinsert.php?user_id=<?php echo $user_id; ?>" method="POST">
                    <p>
                        <label for="program_title"> Program Title: </label>
                        <input name="program_title" type="text" id="program_title">
                    </p>
                    <p>
                        <label for="program_type"> Program Type: </label>
                        <select name="program_type" id="program_type">
                            <option value="Area Wide Program"> Area Wide Program </option>
                            <option value="Legacy Program"> Legacy Program </option>
                            <option value="Campus Outreach"> Campus Outreach </option>
                            <option value="Community Builder"> Community Builder </option>
                            <option value="Welcome Home"> Welcome Home </option>
                        </select>
                    </p>
                    <p>
                        <label for="program_date"> Event Date: </label>
                        <input name="program_date" type="date" id="program_date">
                    </p>
                    <?php
                    //if ($user_type == "ard") {
                        echo '<p>';
                        echo '<label for="building_id"> Building: </label>';
                        echo '<select name="building_id" id="building_id">';
                        echo '<option value="" disabled selected hidden> Select a Building...</option>';
                        $sql2 = "SELECT building_id, building_name FROM buildings";
                        $result2 = mysqli_query($link, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row = mysqli_fetch_assoc($result2)) {
                                echo '<option value="' . $row['building_id'] . '"> ' . $row['building_name'] . ' </option>';
                            }
                        }
                        echo '</select>';
                        echo '</p>';
                    //}
                    ?>
                    <p>
                        <label for="location"> Location of Event: </label>
                        <input type="text" name="location" id="location">
                    </p>
                    <p>
                        <label for="collaborators"> Collaborators: </label>
                        <select name="collaborators[]" multiple="multiple" id="collaborators">
                            <?php
                            $sql3 = "SELECT ra.user_id, ra.ra_id, CONCAT(fname, ' ', lname) AS ra_name FROM users u " .
                                "JOIN resident_assistants ra ON (ra.user_id = u.user_id)";
                            $result3 = mysqli_query($link, $sql3);
                            if (mysqli_num_rows($result3) > 0) {
                                while ($row = mysqli_fetch_assoc($result3)) {
                                    echo '<option value="' . $row['user_id'] . '"> ' . $row['ra_name'] . ' </option>';
                                }
                            }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label for="goals"> Goals/Objectives: </label>
                        <textarea name="goals" id="goals" rows="4" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="attendance"> Anticipated Attendance: </label>
                        <input name="attendance" type="text" id="attendance">
                    </p>
                    <p>
                        <label for="cost"> Total Requested Funds: </label>
                        <input type="text" name="cost" id="cost">
                    </p>
                    <!--
                    <p>
                        <label for="amount"> Amount Per: </label>
                        <input type="text" name="amount" id="amount">
                    </p> -->

                    <p>
                        <label for="advertisements"> Planned Advertisements: </label> <br />
                        <input name="advertisements[]" type="checkbox" value="Flyer" id="advertisements"> Flyer(s) <br />
                        <input name="advertisements[]" type="checkbox" value="Instagram" id="advertisements"> Instagram <br />
                        <input name="advertisements[]" type="checkbox" value="Facebook" id="advertisements"> Facebook <br />
                        <input name="advertisements[]" type="checkbox" value="Email" id="advertisements"> Email <br />
                        <input name="advertisements[]" type="checkbox" value="Snapchat" id="advertisements"> Snapchat <br />
                        <input name="advertisements[]" type="checkbox" value="Other" id="advertisements"> Other <br />
                    </p>
                    <p>
                        <label for="stepup"> STEP-UP Categories </label> <br />
                        <input name="stepup[]" type="checkbox" value="Safe Choices" id="stepup"> STEP-UP: Safe Choices <br />
                        <input name="stepup[]" type="checkbox" value="Think Healthy" id="stepup"> STEP-UP: Think Healthy <br />
                        <input name="stepup[]" type="checkbox" value="Embrace The Spirit" id="stepup"> STEP-UP: Embrace The Spirit <br />
                        <input name="stepup[]" type="checkbox" value="Participate" id="stepup"> STEP-UP: Participate <br />
                        <input name="stepup[]" type="checkbox" value="Understand & Appreciate Others" id="stepup"> STEP-UP: Understand & Appreciate Others <br />
                        <input name="stepup[]" type="checkbox" value="Preserve Resources" id="stepup"> STEP-UP: Preserve Resources <br />
                        <input name="stepup[]" type="checkbox" value="N/A" id="stepup"> N/A - This is a campus event with a different sponsor who is organizing the ProfLink event. <br />
                    </p>
                    <p>
                        <label for="proflink"> Please select any other relevant ProfLink categories for your program: </label> <br />
                        <input name="proflink[]" type="checkbox" value="Academic Success & Career Planning" id="proflink"> Academic Success & Career Planning <br />
                        <input name="proflink[]" type="checkbox" value="Academic Transition Programs" id="proflink"> Academic Transition Programs <br />
                        <input name="proflink[]" type="checkbox" value="Academic Transition Programs" id="proflink"> Athletics <br />
                        <input name="proflink[]" type="checkbox" value="Career Development" id="proflink"> Career Development (if attending OCA event) <br />
                        <input name="proflink[]" type="checkbox" value="Family Weekend" id="proflink"> Family Weekend <br />
                        <input name="proflink[]" type="checkbox" value="Greek Event" id="proflink"> Greek Event <br />
                        <input name="proflink[]" type="checkbox" value="Healthy Campus Initiatives" id="proflink"> Healthy Campus Initiatives <br />
                        <input name="proflink[]" type="checkbox" value="Homecoming" id="proflink"> Homecoming <br />
                        <input name="proflink[]" type="checkbox" value="Honors" id="proflink"> Honors <br />
                        <input name="proflink[]" type="checkbox" value="Intramural Activity" id="proflink"> Intramural Activity <br />
                        <input name="proflink[]" type="checkbox" value="Passport Program eligible" id="proflink"> Passport Program eligible <br />
                        <input name="proflink[]" type="checkbox" value="Performance" id="proflink"> Performance <br />
                        <input name="proflink[]" type="checkbox" value="RU Reading Together - Common Reading" id="proflink"> RU Reading Together - Common Reading <br />
                        <input name="proflink[]" type="checkbox" value="SJICR: Level 1 Change Agent" id="proflink"> SJICR: Level 1 Change Agent <br />
                        <input name="proflink[]" type="checkbox" value="SJICR: Level 1 Participant" id="proflink"> SJICR: Level 1 Participant <br />
                        <input name="proflink[]" type="checkbox" value="SJICR: Level 2 Participant" id="proflink"> SJICR: Level 2 Participant <br />
                        <input name="proflink[]" type="checkbox" value=" Student & Alumni Networking" id="proflink"> Student & Alumni Networking <br />
                        <input name="proflink[]" type="checkbox" value="University Events" id="proflink"> University Events <br />
                        <input name="proflink[]" type="checkbox" value="Volunteer/Community Service Opportunity" id="proflink"> Volunteer/Community Service Opportunity <br />
                        <input name="proflink[]" type="checkbox" value="N/A" id="proflink"> None of these <br />
                    </p>

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
