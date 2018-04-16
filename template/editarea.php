<?php
session_start();
include 'connect.php';
$user_id = $_GET['user_id'];
$user_type = $_SESSION["user_type"];
?>

<?php
if (isset($_GET['edit_grouping_id'])) {
    $grouping_id = $_GET["edit_grouping_id"];
    $area = $_POST["areaname"];
    $sql = "SELECT area_id FROM areas where area_name = '" . $area . "'";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $query = "UPDATE groupings SET area_id =" . $row["area_id"] . " WHERE grouping_id = '$grouping_id'";
        echo $query;
        $result1 = mysqli_query($link, $query);
    }
    if (!$result1) {
        echo mysqli_error($link);
    }
} else if(isset($_GET['edit_building_id'])) {
    $building_id = $_GET["edit_building_id"];
    $grouping = $_POST["groupingname"];
    echo '<p>' . $grouping . '</p>';
    $sql = "SELECT grouping_id FROM groupings WHERE grouping_name = '" . $grouping . "'";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $query1 = "UPDATE buildings SET grouping_id =" . $row["grouping_id"] . " WHERE building_id = '$building_id'";
        $result2 = mysqli_query($link, $query1);
    }
    if (!$result2) {
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
    window.setTimeout('window.location = "areamanagement.php?user_id=" + "<?php echo $user_id ?>"', 2500);
    // -->
</script>
</body>

</html>
