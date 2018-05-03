<?php
session_start();
include 'connect.php';
$user_id = $_GET['user_id'];
$user_type = $_SESSION["user_type"];

if (!isset($_SESSION["user_type"])) {
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
    <title>RLUH - Confiscation Form</title>
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
<?php
if ($user_type == "ra") {
    include 'ranav.php';
} elseif ($user_type == "rd") {
    include 'rdnav.php';
} elseif ($user_type == "ard") {
    include 'ardnav.php';
}
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div>
                    <h1> Incident Reporting </h1>
                    <p> This page is for recording information for confiscated items. </p>
                </div>
                <form action="conflogsubmit.php?user_id=<?php echo $_GET['user_id']; ?>" method="POST">
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
