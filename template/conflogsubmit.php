<?php
session_start();
include 'connect.php';

$user_id = $_GET['user_id'];

if ((isset($_POST)) || (isset($POST['submit']))) {
    $student_name = mysqli_real_escape_string($link, $_POST['name']);
    $building = $_POST['building'];
    $room = mysqli_real_escape_string($link, $_POST['room']);
    $date = $_POST['date'];
    $item_desc = mysqli_real_escape_string($link, $_POST['item']);
    $item_loc = mysqli_real_escape_string($link, $_POST['location']);
    $notes = mysqli_real_escape_string($link, $_POST['notes']);

    $sql1 = "SELECT building_id FROM buildings WHERE (building_name = '$building')";
    $result1 = mysqli_query($link, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while($row = mysqli_fetch_assoc($result1)) {
            $building_id = $row["building_id"];
        }
    }

    $sql2 = "SELECT ra.ra_id FROM resident_assistants ra WHERE (ra.user_id = '$user_id')";
    $result2 = mysqli_query($link, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        while($row = mysqli_fetch_assoc($result2)) {
            $ra_id = $row["ra_id"];
        }
    }

    $query = "INSERT INTO confiscation_log (ra_id, student_name, building_id, room, date, item_description, item_location, notes) " .
        "VALUES ('$ra_id', '$student_name', '$building_id', '$room', '$date', '$item_desc', '$item_loc', '$notes')";
    $final_result = mysqli_query($link, $query);
    if(!$final_result) {
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
        <h3>Successful Request!</h3>
        <p> You will be notified as soon as possible on your request</p>
            <script language="javascript" type="text/javascript">
                <!--

                window.setTimeout('window.location = "confiscationform.php?user_id="  + "<?php echo $user_id ?>"',2500);
                // -->
            </script>
    </body>

</html>