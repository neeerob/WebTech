<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
</head>
<body>

	<h1>Page 1 [Home]</h1>

	<h3>Digital Wallet</h3>
	<p>1. <a href="Home.php">Home</a> 2.<a href="add-beneficiary.php">Add Beneficiary</a> 3. <a href="transaction-history.php">Transaction History</a></p>

	<h3>Fund Transfer:</h3>


	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		
		<label>Select Catagory:</label>
		<select name="catagory">
			<option value="Send Money">Send Money</option>
			<option value="Mobile recharge">Mobile recharge</option>
			<option value="Gift">Gift</option>
		</select>
		<br><br>

		<label>To:</label>
		<select name="sendTo">
			<option value="Select a value">Select Someone</option>


			<?php
				
				if(file_exists("../digital-wallet/beneficiary_data.json")){
				$handle = fopen("../digital-wallet/beneficiary_data.json","r");
				$explode = fread($handle,filesize("../digital-wallet/beneficiary_data.json"));
				$explode = explode("\n", $explode);

				//$name === $json->userName; 
				//$phone === $json->password;
				for($i = 0; $i<count($explode) - 1;$i++){
						$json = json_decode($explode[$i]);
					$name === $json->name; 
					$phone === $json->phone;
					echo "<option value= '";
					echo "$json->name";
					echo "'>";
					echo "$json->name";
					echo "</option>";
					}
				}

			?>
		</select>
		<br><br>

		<label>Amount:</label>
			<input type="number" name="amount">
		<br><br>
		<input type="submit" name="submit" value="Submit">
		<br><br>

	</form>

	<?php 

		if($_SERVER['REQUEST_METHOD'] === "POST"){
			$catagory = $_POST['catagory'];
			$sendTo = $_POST['sendTo'];
			$amount = $_POST['amount'];

			$isValid = false;
			if(empty($catagory) or empty($sendTo) or $sendTo === "Select a value" or empty($amount) or $amount <= 0) {
				$isValid = false;

				echo "<b>Please fill proper information!</b>";
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
				$catagory = sanitize($catagory);
				$sendTo = sanitize($sendTo);
				$amount = sanitize($amount);
				$date = date("Y/m/d h:i:s A");

				if(file_exists("../digital-wallet/history_data.json")){

					$handel = fopen("history_data.json","a");
					$arr1 = array('name' => $sendTo,'catagory' => $catagory, 'amount' => $amount, 'time' => $date);
						
					$encode = json_encode($arr1);
					$res = fwrite($handel, $encode . "\n");
					echo "<br>";
					if ($res) {
						echo "<h2>Successful</h2>";
						echo "Money send successfully.";
					}
					else {
						echo "<h2>Error while sending.</h2><hr>";
					}
				}
				else{

					$handel = fopen("history_data.json","a");
						$arr1 = array('name' => $sendTo,'catagory' => $catagory, 'amount' => $amount, 'time' => $date);
						
						$encode = json_encode($arr1);
						$res = fwrite($handel, $encode . "\n");
						echo "<br>";
						if ($res) {
							echo "<h2>Successful</h2>";
							echo "Money send successfully.";
						}
						else {
							echo "<h2>Error while sending.</h2><hr>";
						}
				}

			}
			else{

				if (empty($sendTo) or $sendTo === "Select a value"){
					echo "<br><br><b>To field is Unselected (Requred -> Select a Beneficiary)</b><br> <br>";
				}
				if(empty($amount) or $amount <= 0){
					echo "<b>Amount must be greater then zero (Give proper amount )</b><br> <br>";

				}
			}
		}


	?>





</body>
</html>