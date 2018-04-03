<?php
include 'connect.php';
		$email = $_GET["email"];
		$sql = "SELECT user_id FROM users u WHERE u.email = '$email'";
		$result = $conn->query($sql);
		$user_ID = "";
		if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $user_ID = $row["user_ID"];   
            }
        } else {
            echo '';;
        }
		header("Location: https://swang.devspace.link/dev/rahome.php?user_ID=" . $user_ID);
		die();
		
        ?>