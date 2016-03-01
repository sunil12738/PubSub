<?php
function showlist(){
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

	$sql = "select name from topic";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    	while($row = $result->fetch_assoc()) {
    		$topic = trim($row['name']);
    		echo "<input type=checkbox name=category[] value=$topic>";
    		echo $topic;
    		echo "<br>";
    	}
	} 
	$conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method=get action="subs.php">
	Enter your email<input type="text" name=email><br>Please choose from the list of topics<br>
	<?php

		showlist();

	?>
	<input type="submit" value="Subscribe">
	</form>
</body>
</html>