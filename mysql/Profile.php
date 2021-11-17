<?php 

	session_start();

	if(count($_SESSION) === 0){

		header("Location: login.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile</title>
</head>
<body>
	<h2>Profile</h2>
	<p>1. <a href="Profile.php">Profile</a> 2. <a href="login.php">Login</a> 3. <a href="registration.php">Register</a> 4. <a href="Logout.php">Logout</a></p>

	<b>Welcome <?php echo $_SESSION['userName'];?></b>



</body>
</html>