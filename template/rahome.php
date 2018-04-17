<?php
session_start();
include 'connect.php';
$user_id = $_GET['user_id'];
$user_type = $_SESSION["user_type"];

/*
if (!isset($_SESSION) || $user_type != "ra") {
    echo 'You do not have access to this page!';
    die();
} */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>RLUH - RA Home</title>
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
<?php include 'ranav.php'; ?>

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

    <div class="header-container">
        <?php
        $user_id = $_GET["user_id"];
        $name = "";
        $sql = "SELECT u.fname, u.lname, b.building_name, a.area_name FROM users u " .
            "JOIN resident_assistants ra ON (ra.user_id = u.user_id) " .
            "JOIN buildings b ON (b.building_id = ra.building_id) " .
            "JOIN groupings g ON (g.grouping_id = b.grouping_id) " .
            "JOIN areas a ON (a.area_id = g.area_id) " .
            "WHERE u.user_id = '$user_id'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '<h3 class = "text-center"> User Details </h3>';
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row["fname"] . " " . $row["lname"];
                echo '<p class = "info-text">' . $name . '</p>';
                echo '<p class = "info-text"> Area: ' . $row["area_name"] . ", Building: " . $row["building_name"] . '</p>';
                echo '<p class = "info-text"> Position: Resident Assistant</p>';
            }
        } else {
            echo '<h5 class = "text-center"> This user is not an RA. Access denied. </h5>';;
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
            echo '';
        }
        $emailUserCal = str_replace('@', '%40', $emailUser);
        echo '<iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=' . $emailUserCal . '&amp;color=%231B887A&amp;ctz=America%2FNew_York" style=" border-width:0 " width="700" height="600" frameborder="0" scrolling="no"></iframe>';
        ?>
    </div>

    <div class="main-container">
        <div class="content-container">
            <!-- Program Information -->
            <div class="row">
                <div class="yellow-bar">
                    <h3 class="header-text"> Your Programs </h3>
                </div>
            </div>

            <div class="container">
                <?php
                $user_id = $_GET["user_id"];
                $sql = "SELECT p.program_date, p.program_title, p.status FROM programs p " .
                    "JOIN program_proposers pp ON (pp.program_id = p.program_id) " .
                    "JOIN resident_assistants ra ON (ra.ra_id = pp.ra_id) " .
                    "JOIN users u ON (u.user_id = ra.user_id) " .
                    "WHERE u.user_id = '$user_id'";
                $result = mysqli_query($link, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo '<table style = "width: 100%" class = "info-text">';
                    echo '<tr>';
                    echo '<th style = "font-size: 1.1em"> Program Date </th>';
                    echo '<th style = "font-size: 1.1em"> Title</th>';
                    echo '<th style = "font-size: 1.1em"> Approval Status </th>';
                    echo '</tr>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row["program_date"] . '</td>';
                        echo '<td>' . $row["program_title"] . '</td>';
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

        <div class="margin"></div>

        <!-- Useful Links -->
        <div class="content-container">
            <div class="row">
                <div class="yellow-bar">
                    <h3 class="header-text"> Useful Links </h3>
                </div>
            </div>
            <div class="container">
                <p class="info-text"><a href="dutyschedule.php?user_id=<?php echo $user_id; ?>"> Duty Schedule </a></p>
                <p class="info-text"><a href="programproposal.php?user_id=<?php echo $user_id; ?>"> Create a New Program </a></p>
                <p class="info-text"><a href="switchrequest.php?user_id=<?php echo $user_id; ?>"> Switch </a></p>
            </div>
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