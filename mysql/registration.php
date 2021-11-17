<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration Form</title>
</head>
<body>
	

	<h2>Registration</h2>
	<p>1. <a href="Profile.php">Profile</a> 2. <a href="login.php">Login</a> 3. <a href="registration.php">Register</a> 4. <a href="Logout.php">Logout</a></p><hr>
	
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
		<fieldset>
			<legend>Basic Information: </legend>

			<label>First Name:</label>
			<input type="text" name="firstname">
			<br>

			<label>Last Name:</label> 
			<input type="text" name="lastname">
			<br>



			<label>Gender:</label>
			<input type="radio" name="gender" value="male">Male
			<input type="radio" name="gender" value="female">Female
			<input type="radio" name="gender" value="Other">Other
			<br>

			<label>DoB:</label>
			<input type="date" name="birthday">
			<br>

			<label>Religion</label>
			<select name="religion">
				<option value="Islam">Islam</option>
				<option value="Hinduism">Hinduism</option>
				<option value="Christianity">Christianity</option>
				<option value="Buddhism">Buddhism</option>
			</select>

		</fieldset>

		<br>

		<fieldset>
			<legend>Contact Information:</legend>

			<label>Present Address: </label>
			<textarea id="present_Address" name="present_Address" >
			</textarea>
			<br>

			<label>Permanent Address: </label>
			<textarea id="permanent_Address" name="permanent_Address" >
			</textarea>
			<br>

			<label>Phone: </label>
			<input type="tel"  name="phone">
			<br>

			<label>Email:</label>
			<input type="email" name="email">
			<br>

			<label>Personal Website Link: </label>
			<input type="url" name="webPage">


		</fieldset>

		<br>

		<fieldset>
			<legend>Account Information</legend>

			<label>User Name: </label>
			<input type="text" name="userName">
			<br>

			<label>Password: </label>
			<input type="password" name="password">
			<br>



		</fieldset>
		<br>
		<input type="submit" name="submit" value="Submit">

	</form>

	<br>

	<?php 

		if($_SERVER['REQUEST_METHOD'] === "POST"){

				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$gender = $_POST['gender'];
				$DOB = $_POST['birthday'];
				$religion = $_['religion'];
				$present_Address = trim($_POST['present_Address']);
				$permanent_Address = trim($_POST['permanent_Address']);
				$phone = $_POST['phone'];
				$email = $_POST['email'];
				$webPage = $_POST['webPage'];
				$username = $_POST['userName'];
				$password = $_POST['password'];

				if(empty($firstname) or empty($lastname) or empty($gender) or empty($DOB) or empty($password) or empty($email) or empty($username) or empty($phone)){
						echo "<b>Please fill all information.</b>";
					}

				else{
					if(strlen($password) >= 8 ){
						$servername = "localhost";
						$userName = "root";
						$pass = "";
						$dbname = "homeTest";

						$connection = new mysqli($servername, $userName, $pass, $dbname);

						if ($connection->connect_error) {
							die("Connection failed: " . $connection->connect_error);
						}
						else{

								$sql = "select * from user_information where user = '".$username."'";

								$data = $connection->query($sql);

								if ($data->num_rows > 0) {
									echo "<b>Username alrady exist. Please choose another username.</b>";
									
								}
								else{
									echo "OK";
									$sql = "INSERT INTO user_information (firstName, lastName, gender, DOB, religion, p_add, par_add, phone, email, web, user, pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
									//$res = $connection->query($sql);
									$stmt = $connection->prepare($sql);
									$stmt->bind_param("ssssssssssss", $firstname, $lastname, $gender, $DOB, $religion, $present_Address, $permanent_Address, $phone, $email, $webPage, $username, $password);
										$res = $stmt->execute();

									if ($res) {
										echo "Data Inserted Succssfully";
									}
									else {
										echo "Error while saving";
									}
								}
							$connection->close();
						}

					}
					else{
						echo "<b>Password must be at least 8 cherecter long.</b>";
					}
				}
			}
		?>



	<P>Alrady have an account? Click <a href="Login.php"> here</a> to Login.</P>


</body>
</html>

