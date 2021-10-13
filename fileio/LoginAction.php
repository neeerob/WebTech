<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login Action</title>
</head>
<body>

	<?php 

	if($_SERVER['REQUEST_METHOD'] === "POST"){

		$userName = $_POST['userName'];
		$password = $_POST['password'];

		if(empty($userName) or empty($password)){
			echo "Please fill up proper information.";
		}
		else{
			if(file_exists("../fileio/data.json")){
				$handle = fopen("../fileio/data.json","r");
				$data = fread($handle,filesize("../fileio/data.json"));
				$data = explode("\n", $data);
				$loginFlag = false;

				for($i = 0; $i<count($data) - 1;$i++){
					$json = json_decode($data[$i]);
					if($userName === $json->userName and $password === $json->password){
						$loginFlag = true;
						break;
					}
				}
				if($loginFlag === true){
					echo "Login successfully!";
				}
				else{
					echo "Login failed<br>";
					echo "Don't have account? Click <a href='form-submission.php'> here</a> to create a account. Or click <a href = Login.php> here</a> for login.";

				}
			}

			else{
				echo "JSON File not found.";
			}
		}

	}


	?>

</body>
</html>
