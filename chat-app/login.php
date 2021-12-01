<?php 
	session_start();

	if(count($_SESSION) != 0){

		header("Location: chat.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
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
<script src="login-action.js"></script>
<body>

	<h1 id ="i1" class="c1">Login</h1><hr>

	<p>1. <a href="home.php">Home</a> 2.<a href="login.php">Login</a> 3. <a href="registration.php">Register</a></p>

	<fieldset>
		<legend> Give registration information </legend>
		<br>
			<form name = "login" onsubmit="return isValid(this);" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
					<br>
					<label>username: </label>
					<input type="text" name="userName" value="<?php if(isset($_COOKIE["userName"])) { echo $_COOKIE["userName"]; } ?>" >

					<p id = "errorMsgUser" class="e1"></p>

					<label>password: </label>
					<input type="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" >
					
					<p id = "errorMsgPass" class="e1"></p>

					<input type="checkbox" name="remember">
					<label for="remember">  Remember me</label><br>

					<br>
					<input id = "sub1" type="submit" name="Login" value="Login">
					<input id = "sub2" type="reset" name="reset" value="Reset">
			</form>

			<p><b>Don't have a account? Click <a href="registration.php">here</a> to register.</b></p>
		

	<?php 

			if($_SERVER['REQUEST_METHOD'] === "POST"){

				$userName = $_POST['userName'];
				$password = $_POST['password'];

				if(empty($userName) or empty($password)){
					echo "<br><b>Please fill up proper information.</b>";
				}
				else{
					$servername = "localhost";
						$user = "root";
						$pass = "";
						$dbname = "chat-app";

						$connection = new mysqli($servername, $user, $pass, $dbname);

						if ($connection->connect_error) {
							die("Connection failed: " . $connection->connect_error);
						}
						else{
							
							$sql = "select * from user where userName = '".$userName."' and password = '".$password."'";

							
							$loginFlag = false;

							$data = $connection->query($sql);

							if ($data->num_rows > 0) {
								while ($row = $data->fetch_assoc()) {

									/*$userName = $row["userName"];*/
									$loginFlag = true;
									if($loginFlag === true){

										if(!empty($_POST["remember"])){

											setcookie ("userName",$userName,time()+ 3600);
											setcookie ("password",$password,time()+ 3600);	

											session_start();
											$_SESSION['userName'] = $userName;
											
										}

										else{
										session_start();
										$_SESSION['userName'] = $userName;
										header("Location: home.php");

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