<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form Action</title>
</head>
<body>

	<!-- <h2>Your Submitted Information</h2><hr> -->

	<?php 

	if($_SERVER['REQUEST_METHOD'] === "POST"){

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$gender = $_POST['gender'];
		$DOB = $_POST['birthday'];
		$religion = $_POST['religion'];
		$present_Address = trim($_POST['present_Address']);
		$permanent_Address = trim($_POST['permanent_Address']);
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$webPage = $_POST['webPage'];
		$userName = $_POST['userName'];
		$password = $_POST['password'];

		$isValid = false;

		if(empty($firstname) or empty($lastname) or empty($gender) or empty($DOB) or empty($religion) or empty($email) or empty($userName) or empty($password)){
			$isValid = false;
		}

		else{

			$isValid = true;
		}
		
		if($isValid == true){

			function sanitize($data){
				$data = trim($data);
				$data = stripcslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$firstname = sanitize($firstname);
			$lastname = sanitize($lastname);
			$gender = sanitize($gender);
			//$DOB = sanitize($birthday);
			$religion = sanitize($religion);
			$present_Address = sanitize($present_Address);
			$permanent_Address = sanitize($permanent_Address);
			$phone = sanitize($phone);
			$email = sanitize($email);
			$webPage = sanitize($webPage);
			$userName = sanitize($userName);
			$password = sanitize($password);

			//echo "All input Ok<hr><br>";
			

			$handel = fopen("data.json","a");
			$arr1 = array('firstname' => $firstname,'lastname' => $lastname,'gender' => $gender,'DOB' => $DOB,'religion' => $religion,'present_Address' => $present_Address,'permanent_Address' => $permanent_Address,'Phone' => $phone,'email' => $email,'webPage' => $webPage,'userName' => $userName,'password' => $password);
			
			$encode = json_encode($arr1);
			$res = fwrite($handel, $encode . "\n");
			"<br>";
			if ($res) {
				echo "<h2>Successful</h2><hr>";
				echo "Your account is created successfully.";
				echo " Click <a href = Login.php> here</a> for login.";
			}
			else {
				echo "<h2>Error while saving.</h2><hr>";
			}

			$handle = fopen("data.json","r");
			$data = fread($handle, filesize("data.json"));
			
			$explode = explode("\n", $data);
			array_pop($explode);


			$arr2 = array();

			for($i = 0;$i<count($explode);$i++){
				$json = json_decode($explode[$i]);
				array_push($arr2, $json);
			}

			$handel = fopen("data_json-format.json","w");
			
			$encode1 = json_encode($arr2);
			$res_1 = fwrite($handel, $encode1. "\n");

		}

		else{

			echo "<h3> You Entered some empty input, Please enter valid information</h3><hr>";
			if (empty($firstname)){
			
			echo "<li>First Name is Empty (* Requred -> Fill Information)<br> <br>";
			}
			else {
				echo "First Name : $firstname <br> <br>";
			} 

			if (empty($lastname)){
				echo "<li>Last Name is Empty (* Requred -> Fill Information)<br> <br>";
				
			}
			else {
				echo "Last Name : $lastname <br> <br>";
			}

			if (empty($gender)){
				echo "<li>Gender Button Empty (* Requred -> Fill Information)<br> <br>";
				
			}
			else {
				echo "Gender : $gender <br> <br>";
			}

			if (empty($DOB)){
				echo "<li>DOB is not given (* Requred -> Fill Information)<br> <br>";
				
			}
			else {
				echo "DOB is: $DOB <br> <br>";
			}

			if (empty($religion)){
				echo "<li>Religion is not given (* Requred -> Fill Information)<br> <br>";
				
			}
			else {
				echo "Religion is: $religion <br> <br>";
			}



			if (empty($email)){
				echo "<li>Email is not given (* Requred -> Fill Information)<br> <br>";
				
			}
			else {
				echo "Email is: $email <br> <br>";
			}


			if (empty($userName)){
				echo "<li>User Name is not given (* Requred -> Fill Information)<br> <br>";
				
			}
			else {
				echo "User Name is: $userName <br> <br>";
			}

			if (empty($password)){
				echo "<li>Password is not given (* Requred -> Fill Information)<br> <br>";
				
			}
			else {
				echo "Password is: $password <br> <br>";
			}
		}


		}

	?>




</body>
</html>