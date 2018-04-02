<?php
		$email = $_GET["email"];
		$sql = "SELECT user_id FROM users u WHERE u.email = '$email'";
		$result = $conn->query($sql);
		$user_ID = "";
		if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            window.location = "https://swang.devspace.link/dev/rahome.php?user_id=" + $user_ID;
            }
        } else {
            echo '';;
        }
		$emailUserCal=str_replace ('@','%40',$emailUser);
		
        ?>