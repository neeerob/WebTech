<?php 

	session_start();

	if(count($_SESSION) === 0){

		header("Location: login.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<style>
		h1{
			text-align: center;

		}
		p{
			text-align: center;

		}
		.left {
		  float: left;
		  width:50%;
		  text-align:left;
		}
		.right {
		  float: left;
		  width:50%;
		  text-align:right;
		}
		table {
		  width: 100%;
		}

		#sub1:hover {
			background-color: greenyellow;
		}
		#sub1{
			border: 2px solid #ccc;
  			border-radius: 4px;
		}

		* {
			text-align: center;

		}
		a:hover {
			background-color: limegreen;
		}

		textarea {
		width: 100%;
		height: 70px;
		padding: 12px 20px;
		box-sizing: border-box;
		border: 2px solid #ccc;
		border-radius: 4px;
		background-color: #f8f8f8;
		font-size: 16px;
		resize: none;
		}



	</style>
</head>
<body>

	<h1 id ="i1" class="c1">Chat</h1>
	<div id = "i1">
	<h4 class="left">1. <a href="home.php">Home</a> 2. <a href="logout.php">Logout</a></h4>
	<h4 class="right" style="color:green;">Hi , <?php echo $_SESSION['userName'];  ?> </h4>
	</div>
	<hr>

	
	<fieldset>
		<legend>Select username to chat</legend>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
				<br>
				<label> Send message to: </label>

				<select name="sendTo" onchange="showChatbox(this.value)">
					<option value="Select a value">Select Someone</option>
					<?php
						
						$userName = $_SESSION['userName'];


						$servername = "localhost";
						$user = "root";
						$pass = "";
						$dbname = "chat-app";

						$connection = new mysqli($servername, $user, $pass, $dbname);

						if ($connection->connect_error) {
							die("Connection failed: " . $connection->connect_error);
						}

						echo "<br>";

						$sql = "select * from user where userName != '".$userName."'";

						$data = $connection->query($sql);
						if ($data->num_rows > 0) {
						while ($row = $data->fetch_assoc()) {
							echo "<option value= '";
							echo $row['userName'];
							echo "'>";
							echo $row['userName'];
							echo "</option>";
						}

						}
					?> 

				</select>

				<br><br>

				<div id="txtHint"><b></b></div>

				<br><br>

				<label>Message: </label><br><br>
				<textarea id="message" name="message" >
				</textarea>

				<br><br>

				<input id = "sub1" type="submit" name="submit" value="Send Message" onclick="showChatbox(sendTo.value)">
			</form>
	

	<?php
		
		if($_SERVER["REQUEST_METHOD"] === "POST"){

			$message = trim($_POST['message']);
			$sendTo = $_POST['sendTo'];
			//$time = date(format,[timestamp]);
			$sendFrom = $_SESSION['userName'];
			//echo "ok";

			if($_POST['sendTo'] === "Select a value"){
				echo '<br><b style = " color: red">Please choose a username to send message</b>';
			}
			if(!empty($message)){
				$userName = $_SESSION['userName'];

				$servername = "localhost";
				$user = "root";
				$pass = "";
				$dbname = "chat-app";

				$timestamp = date('Y-m-d H:i:s');

				$connection = new mysqli($servername, $user, $pass, $dbname);

				if ($connection->connect_error) {
					die("Connection failed: " . $connection->connect_error);
				}
				//echo "Ok";
				
				$sql = "INSERT INTO message(sendFrom, sendTo, message, time) VALUES (?, ?, ?, ?)";
				$stmt = $connection->prepare($sql);
				$stmt->bind_param("ssss", $sendFrom, $sendTo, $message, $timestamp);
				$res = $stmt->execute();
				if ($res) {
					echo '<br><b style = " color: green">Successfully sent message</b>';
				}
				else {
					echo "<br><b>Failed to send!</b>";
				}
				$connection->close();



			}

		}

		

	?>

	</fieldset>

	<div id="txtHint"><b></b></div>

	<script>
		function showChatbox(str) {
		  if (str == "") {
		    document.getElementById("txtHint").innerHTML = "";
		    return;
		  } 
		  else { 
		    var xmlhttp = new XMLHttpRequest();
		    xmlhttp.onreadystatechange = function() {
		      if (this.readyState == 4 && this.status == 200) {
		        document.getElementById("txtHint").innerHTML = this.responseText;
		      }
		    };
		    xmlhttp.open("GET","getChatLog.php?q="+str,true);
		    xmlhttp.send();
		  }
		}
	</script>








</body>
</html>