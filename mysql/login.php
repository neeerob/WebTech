<?php 
	session_start();

	if(count($_SESSION) != 0){

		header("Location: Profile.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
</head>
<body>
	<h2>Login</h2>
	<p>1. <a href="Profile.php">Profile</a> 2. <a href="login.php">Login</a> 3. <a href="registration.php">Register</a> 4. <a href="Logout.php">Logout</a></p><hr>

	<fieldset>
		<legend>Give login credential</legend>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
					<br>
					<label>username: </label>
					<input type="text" name="userName" value="<?php if(isset($_COOKIE["userName"])) { echo $_COOKIE["userName"]; } ?>" >
					<br>
					<br>

					<label>password: </label>
					<input type="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" >
					<br><br>

					<input type="checkbox" name="remember">
					<label for="remember">  Remember me</label><br>

					<br>
					<input type="submit" name="Login" value="Login">
			</form>

		
		<?php 

			if($_SERVER['REQUEST_METHOD'] === "POST"){

				echo "$cookie_password" ;
				echo "$cookie_userName";
				$userName = $_POST['userName'];
				$password = $_POST['password'];

				if(empty($userName) or empty($password)){
					echo "<br><b>Please fill up proper information.</b>";
				}
				else{
					$servername = "localhost";
						$username = "root";
						$pass = "";
						$dbname = "homeTest";

						$connection = new mysqli($servername, $username, $pass, $dbname);

						if ($connection->connect_error) {
							die("Connection failed: " . $connection->connect_error);
						}
						else{
							
							$sql = "select * from user_information where user = '".$userName."' and pass = '".$password."'";

							
							$loginFlag = false;

							$data = $connection->query($sql);

							if ($data->num_rows > 0) {
								while ($row = $data->fetch_assoc()) {
									echo "Ok";
									/*$userName = $row["userName"];*/
									$loginFlag = true;
									if($loginFlag === true){
										echo "Ok";
										echo "$userName";
										if(!empty($_POST["remember"])){
											//setcookie($userName)
											setcookie ("userName",$userName,time()+ 3600);
											setcookie ("password",$password,time()+ 3600);	

											session_start();
											$_SESSION['userName'] = $userName;
											/*echo "S";
											echo $_SESSION['userName'];*/
											header("Location: Profile.php");
											
										}

										else{
										session_start();
										$_SESSION['userName'] = $userName;
										header("Location: Profile.php");
										/*echo "S";
										echo $_SESSION['userName'];*/
										}
										
										
									}
									

								}
							}
							else{
								echo "<b><br>Wrong username or password.</b>";
							}

							$connection->close();
						}
				}

			}

		?>
	</fieldset>



</body>
</html>