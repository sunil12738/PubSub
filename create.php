<?php
$handle = $_GET["handle"];
if(isset($_GET["topic"]) && isset($_GET["handle"])){
	$namee = $_GET["topic"];
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

	$sql = "insert into topic(pub, name) values('$handle','$namee');";

	if ($conn->query($sql) === TRUE) {
			echo "Successfully added";
			window.stop();
		} 
	else {
			echo "Already exists";
			window.stop();
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
	<form method="GET" action="create.php">
		<input type="text" name="topic">
		<?php
		echo "
		<input type=\"hidden\" name=\"handle\" value=\"$handle\">
		";
		?>
		<input type="submit" value="create new topic">
	</form>
</body>
</html>