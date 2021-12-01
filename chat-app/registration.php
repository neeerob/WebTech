<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration</title>
	<style>
		* {
			text-align: center;

		}

		fieldset{
		  border: 2px solid;
		  width: 500px;
		  margin:auto;
		}
		.e1{
			color: red;
		}
		a:hover {
			background-color: limegreen;
		}
		#sub1:hover {
			background-color: greenyellow;
		}
		#sub1{
			border: 2px solid #ccc;
  			border-radius: 4px;
		}
		#sub2:hover {
			background-color: greenyellow;
		}
		#sub2{
			border: 2px solid #ccc;
  			border-radius: 4px;
		}
	</style>
</head>

<script type="text/javascript" src="reg-action.js"></script>

<body>

	<h1 id ="i1" class="c1">Welcome to registration page</h1><hr>

	<p>1. <a href="home.php">Home</a> 2.<a href="login.php">Login</a> 3. <a href="registration.php">Register</a></p>

	<fieldset>
		<legend> Give registration information </legend>
		<br>
			<form name = "regester" onsubmit="return isValid(this);" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
				<label>Username: </label>
				<input type="text" name="userName">
				<p id = "errorMsgUser" class="e1"></p>

				<label>Password: </label>
				<input type="password" name="password">
				<p id = "errorMsgPass" class="e1"></p>
				

				<label>Email:</label>
				<input type="email" name="email">
				<p id = "errorMsgEmail" class="e1"></p>
				<br>

				<input id = "sub1" type="submit" name="regester" value="Register">
				<input id = "sub2" type="reset" name="reset" value="Reset">
			</form>

			<p><b>Alrady have a account? Click <a href="login.php">here</a> to login.</b></p>
		

	<?php 
	if($_SERVER["REQUEST_METHOD"] === "POST"){
		$userName = $_POST["userName"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		if (!empty($userName) or !empty($password) and !empty($email) and strlen($password) > 8) {
						$servername = "localhost";
						$username = "root";
						$pass = "";
						$dbname = "chat-app";

						$connection = new mysqli($servername, $username, $pass, $dbname);

						if ($connection->connect_error) {
							die("Connection failed: " . $connection->connect_error);
						}
						else{

								$sql = "select * from user where userName = '".$userName."'";

								$data = $connection->query($sql);

								if ($data->num_rows > 0) {
									echo "<br><b>Username alrady exist. Please choose another username.</b>";
									
								}
								else{
									
									$sql = "INSERT INTO user(userName, password, email) VALUES (?, ?, ?)";
									//$res = $connection->query($sql);
									$stmt = $connection->prepare($sql);
									$stmt->bind_param("sss", $userName, $password, $email);
										$res = $stmt->execute();

									if ($res) {
										echo '<br><b style = " color: green">Successfully registered</b>';
									}
									else {
										echo "<br><b>Error while registering!</b>";
									}
								}
							$connection->close();
						}
		}
		else{
			echo "<b>Unsuccessfull</b>";
		}
	}

?>
</fieldset>


</body>
</html>