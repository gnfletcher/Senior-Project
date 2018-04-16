<?php
session_start();
include 'connect.php';
$user_id = $_GET['user_id'];
$user_type = $_SESSION["user_type"];
?>

<?php
if (isset($_GET['remove_user_id'])) {
    $remove_user_id = $_GET["remove_user_id"];
    echo '<p>' . $remove_user_id . '</p>';

    $query = "UPDATE users SET account_status = '' WHERE user_id = '$remove_user_id'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        echo mysqli_error($link);
    }
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
    <title>RLUH Website</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body>

<h3>Successful</h3>
<script language="javascript" type="text/javascript">

    <!--
    window.setTimeout('window.location = "usermanagement.php?user_id=" + "<?php echo $user_id ?>"', 2500);
    // -->
</script>
</body>

</html>
