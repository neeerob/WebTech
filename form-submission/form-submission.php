<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration Form</title>
</head>
<body>
	

	<h1>Registration form</h1>
	<form action="FormAction.php" method="POST">

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

		<fieldset>
			<legend>Contact Information:</legend>

			<label>Present Address: </label>
			<textarea id="present_Address" name="present_Address" rows="2">
			</textarea>
			<br>

			<label>Permanent Address: </label>
			<textarea id="permanent_Address" name="permanent_Address" rows="2">
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

</body>
</html>