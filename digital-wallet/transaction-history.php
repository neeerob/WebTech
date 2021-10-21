<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>History</title>
</head>
<body>

	<h1>Page 3 [Transaction History]</h1>

	<h3>Digital Wallet</h3>
	<p>1. <a href="Home.php">Home</a> 2.<a href="add-beneficiary.php">Add Beneficiary</a> 3. <a href="transaction-history.php">Transaction History</a></p>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		
		<label>From:</label>
		<input type="datetime-local" name="start">

		<label >To:</label>
		<input type="datetime-local" name="end">

		<input type="submit" name="submit" value="Submit">

	</form>


	<h3>Total Records: </h3>
	<?php 
		
		if($_SERVER['REQUEST_METHOD'] === "POST"){

			$start = $_POST['start'];
			$end = $_POST['end'];
			if(file_exists("../digital-wallet/history_data.json")){
				$handle = fopen("../digital-wallet/history_data.json","r");
				$explode = fread($handle,filesize("../digital-wallet/history_data.json"));
				$explode = explode("\n", $explode);

				echo "<table border='1'>";
				echo "<tr>";
				echo "<th>";
				echo "Transction Catagory";
				echo "</th>";
				echo "<th>";
				echo "To";
				echo "</th>";
				echo "<th>";
				echo "Amount";
				echo "</th>";
				echo "<th>";
				echo "Transfered On";
				echo "</th>";
				
				for($i = 0; $i<count($explode) - 1;$i++){
						$json = json_decode($explode[$i]);
					//$name === $json->name; 
					//$phone === $json->phone;
						if($json->time >= $end and $json->time <= $start){
							echo "</tr>";
							echo "<tr>";
							echo "<td>";
							echo "$json->catagory";
							echo "</td>";
							echo "<td>";
							echo "$json->name";
							echo "</td>";
							echo "<td>";
							echo "$json->amount";
							echo "</td>";
							echo "<td>";
							echo "$json->time";
							echo "</td>";
							echo "</tr>"; 
						}
					
				}
				echo "</table>";
			}
				
		}
		else{


				if(file_exists("../digital-wallet/history_data.json")){
				$handle = fopen("../digital-wallet/history_data.json","r");
				$explode = fread($handle,filesize("../digital-wallet/history_data.json"));
				$explode = explode("\n", $explode);

				echo "<table border='1'>";
				echo "<tr>";
				echo "<th>";
				echo "Transction Catagory";
				echo "</th>";
				echo "<th>";
				echo "To";
				echo "</th>";
				echo "<th>";
				echo "Amount";
				echo "</th>";
				echo "<th>";
				echo "Transfered On";
				echo "</th>";
				
				for($i = 0; $i<count($explode) - 1;$i++){
						$json = json_decode($explode[$i]);
					//$name === $json->name; 
					//$phone === $json->phone;
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "$json->catagory";
					echo "</td>";
					echo "<td>";
					echo "$json->name";
					echo "</td>";
					echo "<td>";
					echo "$json->amount";
					echo "</td>";
					echo "<td>";
					echo "$json->time";
					echo "</td>";
					echo "</tr>"; 
				}
				echo "</table>";
			}
					

			else{
				echo "json file not found!";
			}
		}

	?>

</body>
</html>

