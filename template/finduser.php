<?php
include 'connect.php';
		$email = $_GET["email"];
		$sql = "SELECT user_id FROM users u WHERE u.email = '$email'";
		$result = $conn->query($sql);
		$user_id = "";
		if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
				$user_id = $row["user_id"];
				header("Location: https://swang.devspace.link/dev/rahome.php?user_id=" . $user_id);
				die();			
            }
        } else {
            header("Location: https://swang.devspace.link/dev/register.html");
			die();
        }
