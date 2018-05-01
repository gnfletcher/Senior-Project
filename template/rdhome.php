<?php
session_start();
include 'connect.php';
$user_id = $_GET['user_id'];
$user_type = $_SESSION["user_type"];

if (!isset($_SESSION["user_type"]) || $user_type != "rd") {
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
    <title>RLUH - RD Home</title>
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
<?php include 'rdnav.php'; ?>

<!-- Main Content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2> RD Home Page </h2>
                <p> Welcome to the RLUH Portal! </p>
            </div>
        </div>
    </div>

    <div class="header-container">
        <?php
        $sql = "SELECT concat(fname, ' ', lname) AS name FROM users u " .
        "JOIN resident_directors rd ON (rd.user_id = u.user_id) " .
        "WHERE u.user_id = '$user_id'";
        $result = mysqli_query($link, $sql);

        $sql2 = "SELECT grouping_name FROM groupings g " .
        "JOIN resident_directors rd ON (rd.grouping_id = g.grouping_id) " .
        "JOIN users u ON (u.user_id = rd.user_id) " .
        "WHERE u.user_id = '$user_id'";
        $result2 = mysqli_query($link, $sql2);
        $num_rows = mysqli_num_rows($result2);
        if (mysqli_num_rows($result) > 0) {
            echo '<h3 class = "text-center"> User Details </h3>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<p class = "info-text">' . $row["name"] . '</p>';
                echo '<p class = "info-text"> Position: Resident Director</p>';
            }
        } else {
            echo '<h5 class = "text-center"> This user is not an RD. Access denied. </h5>';;
        }

        if (mysqli_num_rows($result2) > 0) {
            echo '<p class = "info-text"> Assigned Grouping: ';
            while ($row2 = mysqli_fetch_assoc($result2)) {
                echo $row2["grouping_name"];
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
        $sql = "SELECT u.email FROM users u WHERE u.user_id = '$user_id'";
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
        <!-- Useful Links -->
        <div class="content-container">
            <div class="row">
                <div class="yellow-bar">
                    <h3 class="header-text"> Useful Links </h3>
                </div>
            </div>
            <div class="container">
                <p class="info-text"><a href="programreview.php?user_id=<?php echo $user_id ?>"> Review Submitted
                        Programs </a></p>
                <p class="info-text"><a href="confiscationlog.php?user_id=<?php echo $user_id ?>"> View Confiscation
                        Log </a></p>
            </div>
        </div>

        <div class="margin"></div>

        <div class="content-container">
            <!-- Program Information -->
            <div class="row">
                <div class="yellow-bar">
                    <h3 class="header-text"> Announcements </h3>
                </div>
            </div>
            <div class="container">
                <p class="info-text"> Submit an Announcement for your RAs and ARDs to view: </p>
                <form method="POST" action="rdhome.php?user_id=<?php echo $user_id ?>">
                    <p class="info-text">
                        <input type="text" name="announcement" style="width: 30em;">
                        <input type="submit" name="submit">
                    </p>
                </form>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['submit'])) {
        $content = mysqli_real_escape_string($link, $_POST['announcement']);

        $rd_query = "SELECT rd_id FROM resident_directors WHERE user_id = '$user_id'";
        $res = mysqli_query($link, $rd_query);
        $row = mysqli_fetch_assoc($res);
        $rd_id = $row["rd_id"];


        $sql = "INSERT INTO announcements (rd_id, content) VALUES ('$rd_id', '$content')";
        $res2 = mysqli_query($link, $sql);
    }

    ?>

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