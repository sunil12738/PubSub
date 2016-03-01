<?php
$handle=$_GET["publisher"];
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "asgn3";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "select name from publisher where name='$handle'";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
	} 
	else {
    	echo "You are not publisher";
		window.stop();
	}
	$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="pub.php" method="get">
		<?php 
		echo "<input type=\"hidden\" name=\"handle\" value=\"$handle\">";
		?>
		<input type=submit value="send new message">
	</form>

	<form action="create.php" method="get">
		<?php 
		echo "<input type=\"hidden\" name=\"handle\" value=\"$handle\">";
		?>
		<input type=submit value="create new topic">
	</form>


<!-- <a href="pub.php">send a new message</a> -->
<!-- <a href="create.php">create new topic</a> -->
</body>
</html>