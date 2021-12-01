<?php 

  session_start();

  if(count($_SESSION) === 0){

    header("Location: login.php");
  }

?>


<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table,th {
  
  padding: 5px;
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;
}

.buttonSend {
    margin: 5px;
    padding: 10px;
    border-radius: 2em;
    height: 40px;
    border: solid black 1px;
    background-color: #4CAF50;
    width: fit-content;
    float: left;
}
*{
  text-align: center;
}
</style>
</head>
<body>

<?php
$userName = $_SESSION['userName'];
$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "chat-app";

$q = ($_GET['q']);

$con = mysqli_connect($servername, $user, $pass, $dbname);

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM message where sendTo = '".$q."' and sendFrom = '".$userName."'";

$sql1="SELECT * FROM message where sendTo = '".$userName."' and sendFrom = '".$q."'";


$result = mysqli_query($con,$sql);
$result1 = mysqli_query($con,$sql1);
//$result = mysqli_query($con,$sql1);
echo "<table>";
echo "<th>Message log</th>";
/*echo "<table>
<tr>
<th>Message log</th>
</tr>";*/
while($row = mysqli_fetch_array($result)) {
  while ($row1 = mysqli_fetch_array($result1)) {
    $mess = $row['message'];
    $sendto = $row['sendTo'];
    $sendfrom = $row['sendFrom'];
    echo "<tr>";
    echo '<td><input class = "buttonSend" type = "button" value = "'.$mess.'"> ' ."</td>";
    echo "</tr>";
  }

    $mess1 = $row1['message'];
    $sendto1 = $row1['sendTo'];
    $sendfrom1 = $row1['sendFrom'];
    echo "<tr>";
    echo '<td><input class = "buttonSend" type = "button" value = "'.$mess1.'"> ' ."</td>";
    echo "</tr>";

}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>