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
<?php include 'ardnav.php'; ?>

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
        $sql = "SELECT concat(fname, ' ', lname) AS name FROM users u " .
            "JOIN assistant_rds ard ON (ard.user_id = u.user_id) " .
            "WHERE u.user_id = '$user_id'";
        $result = mysqli_query($link, $sql);

        $sql2 = "SELECT grouping_name FROM groupings g " .
            "JOIN assistant_rds ard ON (ard.grouping_id = g.grouping_id) " .
            "JOIN users u ON (u.user_id = ard.user_id) " .
            "WHERE u.user_id = '$user_id'";
        $result2 = mysqli_query($link, $sql2);
        $num_rows = mysqli_num_rows($result2);
        if (mysqli_num_rows($result) > 0) {
            echo '<h3 class = "text-center"> User Details </h3>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<p class = "info-text">' . $row["name"] . '</p>';
                echo '<p class = "info-text"> Position: Assistant Resident Director</p>';
            }
        } else {
            echo '<h5 class = "text-center"> This user is not an ARD. Access denied. </h5>';;
        }

        if (mysqli_num_rows($result2) > 0) {
            $i = 1;
            echo '<p class = "info-text"> Assigned Grouping: ';
            while ($row2 = mysqli_fetch_assoc($result2)) {
                echo $row2["grouping_name"];
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
        $sql1 = "SELECT concat(fname, ' ', lname) AS name, ra.user_id FROM users u " .
            "JOIN resident_assistants ra ON (u.user_id = ra.user_id) " .
            "JOIN buildings b ON (b.building_id = ra.building_id) " .
            "JOIN groupings g ON (b.grouping_id = g.grouping_id) " .
            "JOIN assistant_rds ard ON (ard.grouping_id = g.grouping_id) " .
            "WHERE ard.user_id = '$user_id'";
        $result = mysqli_query($link, $sql1);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="content-container">';
            echo '<div class = "row">';
            echo '<div class = "yellow-bar">';
            echo '<h3 class = "header-text">Upcoming Programs</h3>';
            echo '</div>';
            echo '</div>';
            echo '<div class="container">';
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<p class="info-text"><b> ' . $i . '. ' . $row["name"] . '</b></p>';
                $sql2 = "SELECT program_title, program_date FROM programs p " .
                    "WHERE p.user_id =" . $row["user_id"];
                $result2 = mysqli_query($link, $sql2);

                if(mysqli_num_rows($result2) > 0) {
                  while($row2 = mysqli_fetch_assoc($result2)) {
                      echo '<p class="info-text">Title: ' . $row2["program_title"] . '</p>';
                      echo '<p class="info-text">Date: ' . $row2["program_date"] . '</p>';
                      echo '<p> 
                </p>';
                  }
                }
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
