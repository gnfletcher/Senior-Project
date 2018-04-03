<?php
include 'connect.php';
		$email = $_GET["email"];
		$sql = "SELECT user_id FROM users u WHERE u.email = '$email'";
		$result = $conn->query($sql);
		$user_id = "";
		if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $user_id = $row["user_id"];		
            }
        } else {
            header("Location: https://swang.devspace.link/dev/register.html");
			die();
        }
		$sql = "(SELECT *, 'ra' AS type FROM resident_assistants u WHERE u.user_id = '$user_id')
		UNION
		(SELECT *, 'ard' AS type FROM assistant_rds u WHERE u.user_id = '$user_id')
		UNION
		(SELECT *, 'rd' AS type FROM resident_directors u WHERE u.user_id = '$user_id')";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if('ra' = $row["type"]){
					header("Location: https://swang.devspace.link/dev/rahome.php?user_id=" . $user_id);
					die();
				}elseif('ard' = $row["type"]){
					header("Location: https://swang.devspace.link/dev/ardhome.php?user_id=" . $user_id);
					die();
				}elseif('rd' = $row["type"]){
					header("Location: https://swang.devspace.link/dev/rdhome.php?user_id=" . $user_id);
					die();
				}
            }
        } else {
            header("Location: https://swang.devspace.link/dev/userNotFound.html");
			die();
		}
		header("Location: https://swang.devspace.link/dev/rahome.php?user_id=" . $user_id);
		die();
		
        ?>