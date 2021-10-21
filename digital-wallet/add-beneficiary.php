<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add Beneficiary</title>
</head>
<body>

	<h1>Page 2 [Add Beneficiary]</h1>

	<h3>Digital Wallet</h3>
	<p>1. <a href="Home.php">Home</a> 2.<a href="add-beneficiary.php">Add Beneficiary</a> 3. <a href="transaction-history.php">Transaction History</a></p>

	<h3>Add Beneficiary:</h3>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		Beneficiary Name:
			<input type="text" name="name">

		Mobile No: 
			<input type="tel"  name="phone">

		<input type="submit" name="submit" value="Submit">
		<br>
	</form>


	<?php 
		if(file_exists("../digital-wallet/beneficiary_data.json")){
				$handle = fopen("../digital-wallet/beneficiary_data.json","r");
				$explode = fread($handle,filesize("../digital-wallet/beneficiary_data.json"));
				$explode = explode("\n", $explode);

				echo "<br><br><table border='1'>";
				echo "<tr>";
				echo "<th>";
				echo "Beneficiary Name";
				echo "</th>";
				echo "<th>";
				echo "Phone Number";
				echo "</th>";
				
				for($i = 0; $i<count($explode) - 1;$i++){
						$json = json_decode($explode[$i]);
					//$name === $json->name; 
					//$phone === $json->phone;
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "$json->name";
					echo "</td>";
					echo "<td>";
					echo "$json->phone";
					echo "</td>";
					echo "</tr>"; 
				}
				echo "</table>";
			}
					

			else{
				echo "json file not found!";
			}

	?>

	<?php 

		if($_SERVER['REQUEST_METHOD'] === "POST"){
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$isValid = false;

			if(empty($name) or empty($phone)) {
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
				$name = sanitize($name);
				$phone = sanitize($phone);

				if(file_exists("../digital-wallet/beneficiary_data.json")){

					$handle = fopen("../digital-wallet/beneficiary_data.json","r");
					$explode = fread($handle,filesize("../digital-wallet/beneficiary_data.json"));
					$explode = explode("\n", $explode);
					$check = true;

					for($i = 0; $i<count($explode) - 1;$i++){
						$json = json_decode($explode[$i]);
						if($name === $json->name or $phone === $json->phone){
							$check = false;
							break;
						}
					}

					if($check === true){
						
						//save informations
						$handel = fopen("beneficiary_data.json","a");
						$arr1 = array('name' => $name,'phone' => $phone);
						
						$encode = json_encode($arr1);
						$res = fwrite($handel, $encode . "\n");
						"<br>";
						if ($res) {
							echo "<h2>Successful</h2>";
							echo "Your beneficiary account is created successfully.";
						}
						else {
							echo "<h2>Error while saving.</h2><hr>";
						}
					}
					else{
						echo "<br><br><b>beneficiary Name or Mobile number alrady exist! Please change User Name</b><br>";

					}
				}
				else{

					$handel = fopen("beneficiary_data.json","a");
						$arr1 = array('name' => $name,'phone' => $phone);
						
						$encode = json_encode($arr1);
						$res = fwrite($handel, $encode . "\n");
						"<br>";
						if ($res) {
							echo "<h2>Successful</h2>";
							echo "Your beneficiary account is created successfully.";
						}
						else {
							echo "<h2>Error while saving.</h2><hr>";
						}

				}
			}
			else{

				if (empty($name)){
					echo "<br><br><b>Name field is empty (Requred -> Please provide Beneficiary name)</b><br> <br>";
				}
				if(empty($phone) ){
					echo "<b>Phone number field is empty (Requred -> Please provide Beneficiary Phone number)</b><br>";

				}
			}
	}


	?>

</body>
</html>