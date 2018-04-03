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
		$sql = "(SELECT *, 'ra' as type FROM resident_assistants r WHERE r.user_id = '$user_id')
		UNION
		(SELECT *, 'ard' as type FROM assistant_rds a WHERE a.user_id = '$user_id')
		UNION
		(SELECT *, 'rd' as type FROM resident_directors d WHERE d.user_id = '$user_id')";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if('ra' = $row["type"]){
					header("Location: https://swang.devspace.link/dev/rahome.php?user_id=" . $user_id);
					die();
				} elseif('ard' = $row["type"]){
					header("Location: https://swang.devspace.link/dev/ardhome.php?user_id=" . $user_id);
					die();
				} elseif('rd' = $row["type"]){
					header("Location: https://swang.devspace.link/dev/rdhome.php?user_id=" . $user_id);
					die();
				}
            }
        } else {
            header("Location: https://swang.devspace.link/dev/userNotFound.html");
			die();
		}