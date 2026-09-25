<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Friends page</title>
	<link rel="stylesheet" href="friends.css">
</head>
<body>
<div class="content">
	<!--  for making database conection  -->
	<?php
		$servername = "localhost";
		$username = "uday";
		$password = "Root@1234";
		$dbname = "FACEBOOK";
		// Connect to MySQL
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		if (!isset($_GET["id"])) {
			die("User ID not provided");
		}
		$id = $_GET["id"];
		$sql_user = "SELECT NAME 
					FROM USER
					WHERE USER_ID = ?";
		$db_statements = $conn->prepare($sql_user);
		$db_statements->bind_param("i", $id);
		$db_statements->execute();
		$user = $db_statements->get_result()->fetch_assoc();
		echo "<h1 class='my-title'>Friends of <a href='profile.php?id=$id'>" . $user["NAME"] . "</a></h1>";
		echo "<h3 id='home-link'><a href='home.php?id=1'>HOME</a></h3>";
		$sql = "SELECT U.USER_ID, U.NAME
				FROM FRIEND F
				LEFT OUTER JOIN USER U
					ON F.FRIEND_ID = U.USER_ID
				WHERE F.USER_ID = ?";
		$db_statements = $conn->prepare($sql);
		$db_statements->bind_param("i", $id);
		$db_statements->execute();
		$my_frnds = $db_statements->get_result();
		while ($frnds = $my_frnds->fetch_assoc()) {
			echo '<a class="my-friend" id="friend-link" href="profile.php?id='
				. $frnds["USER_ID"]
				. '">'
				. $frnds["NAME"]
				. '</a><br>';
		}

	?>
	<?php
		if($my_frnds->num_rows>0){
			while( $frnds = $my_frnds->fetch_assoc()){
				echo '<a href="profile.php?id=' . $frnds["USER_ID"] . '">'
				. $frnds["NAME"] .
				'</a><br>';
			}
		}
	?>
</div>
	
</body>
</html>





