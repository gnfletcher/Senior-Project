<html>
<head>

</head>
<body>
<?php
include 'connect.php';

$program_title = $_POST['program_title'];

echo $program_title;

$sql = "INSERT INTO rluh_website.programs (program_title) VALUES ('$program_title')";

if ($conn->query($sql) == true) {
    echo "Records added successfully";
} else {
    echo "Error!";
}

$conn->close();

?>

</body>
</html>
