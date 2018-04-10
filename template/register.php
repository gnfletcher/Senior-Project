<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>RLUH Request To Register</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Request To Register for an Account</div>
        <div class="card-body">
            <form action="accountrequested.php" method="POST">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="InputName"> First name </label>
                            <input name="fname" class="form-control" id="InputName" type="text" aria-describedby="nameHelp"
                                   placeholder="Enter First Name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="InputLastName"> Last name </label>
                            <input name="lname" class="form-control" id="InputLastName" type="text" aria-describedby="nameHelp"
                                   placeholder="Enter Last Name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email"> Rowan Email </label>
                    <input name="email" class="form-control" id="email" type="email" aria-describedby="emailHelp"
                           placeholder="Enter Email Address" required>
                </div>
                <div class="form-group">
                    <label for="email_confirm"> Confirm Rowan Email </label>
                    <input name="email_confirm" class="form-control" id="email_confirm" type="email" aria-describedby="emailHelp"
                           placeholder="Confirm Email Address" oninput="check(this)" required>
                </div>
                <script language='javascript' type='text/javascript'>
                    function check(input) {
                        if (input.value != document.getElementById('email').value) {
                            input.setCustomValidity('Email Addresses Must Be Matching.');
                        } else {
                            input.setCustomValidity('');
                        }
                    }
                </script>
                <div class="form-group">
                    <label for="building"> Assigned Building(s) </label>
                    <select name="building" id="building" class="form-control" required>
                        <option value="" disabled selected hidden> Select your assigned building...</option>
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
                </div>
                <div class="form-group">
                    <label for="position"> Position </label>
                    <select name="position" id="position" class="form-control" required>
                        <option value="" disabled selected hidden> Select your position...</option>
                        <option value="ra"> Resident Assistant </option>
                        <option value="ard"> Assistant Resident Director </option>
                        <option value="rd"> Resident Director </option>
                    </select>
                </div>
                <!--
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="InputPassword"> Password </label>
                            <input class="form-control" id="InputPassword" type="password"
                                   placeholder="Enter a Password">
                        </div>
                        <div class="col-md-6">
                            <label for="ConfirmPassword"> Confirm password </label>
                            <input class="form-control" id="ConfirmPassword" type="password"
                                   placeholder="Confirm password">
                        </div>
                    </div>
                </div> -->
                <input name="submit" type="submit" class="btn btn-primary btn-block" value="Request Your Account">
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="login.html">Login Page</a>
                <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
