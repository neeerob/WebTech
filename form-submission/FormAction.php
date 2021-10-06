<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form Action</title>
</head>
<body>

	<h4>Your Submitted Information</h4><hr>

	<?php 

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$gender = $_POST['gender'];
	$DOB = $_POST['birthday'];
	$Religion = $_POST['religion'];
	$present_Address = $_POST['present_Address'];
	$permanent_Address = $_POST['permanent_Address'];
	$Phone = $_POST['phone'];
	$email = $_POST['email'];
	$webPage = $_POST['webPage'];
	$userName = $_POST['userName'];
	$password = $_POST['password'];
	

	if (empty($firstname)){
		//$firstnameValid = false;
		echo "First Name is Empty (Requred->Fill Information) <br>";
	}
	else {
		echo "First Name : $firstname <br>";
	} 

	if (empty($lastname)){
		echo "Last Name is Empty (Requred->Fill Information) <br>";
	}
	else {
		echo "Last Name : $lastname <br>";
	}

	if (empty($gender)){
		echo "Gender Button Empty (Requred->Fill Information) <br>";
	}
	else {
		echo "Gender : $gender <br>";
	}

	if (empty($DOB)){
		echo "DOB is not given (Requred->Fill Information) <br>";
	}
	else {
		echo "DOB is: $DOB <br>";
	}

	if (empty($Religion)){
		echo "Religion is not given (Requred->Fill Information) <br>";
	}
	else {
		echo "Religion is $Religion <br>";
	}

	if (empty($present_Address)){
		echo "Present Address is not given (Requred->Fill Information) <br>";
	}
	else {
		echo "Present Address is: $present_Address <br>";
	}

	if (empty($permanent_Address)){
		echo "Permanent Address is not given (Requred->Fill Information) <br>";
	}
	else {
		echo "Permanent Address is: $permanent_Address <br>";
	}

	if (empty($Phone)){
		echo "Phone Number is not given (Requred->Fill Information) <br>";
	}
	else {
		echo "Phone Number is: $Phone <br>";
	}

	if (empty($email)){
		echo "Email is not given (Requred->Fill Information) <br>";
	}
	else {
		echo "Email is: $email <br>";
	}

	if (empty($webPage)){
		echo "Web Page is not given (Requred->Fill Information) <br>";
	}
	else {
		echo "Web Page is: $webPage <br>";
	}

	if (empty($userName)){
		echo "User Name is not given (Requred->Fill Information) <br>";
	}
	else {
		echo "User Name is: $userName <br>";
	}

	if (empty($password)){
		echo "Password is not given (Requred->Fill Information) <br>";
	}
	else {
		echo "Password is: $password <br>";
	}


	?>



</body>
</html>