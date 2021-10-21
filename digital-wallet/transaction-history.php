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


	<h3>Total Records: </h3>
	<?php 
		if(file_exists("../digital-wallet/history_data.json")){
				$handle = fopen("../digital-wallet/history_data.json","r");
				$explode = fread($handle,filesize("../digital-wallet/history_data.json"));
				$explode = explode("\n", $explode);

				echo "<br><br><table border='1'>";
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
					echo "$json->phone";
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

	?>

</body>
</html>