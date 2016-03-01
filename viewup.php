<?php
$email = $_GET["email"];
// echo $handle;
function showlist($email){
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

	$sql = "select * from message where user_email='$email'";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    	while($row = $result->fetch_assoc()) {
    		$topic = trim($row['topic']);
    		// $topic = trim($row['user_email']);
    		$message = trim($row['message']);
    		$viewed = trim($row['viewed']);
    		if($viewed=='Y')
    			echo "topic is: ".$topic."<br>"."Message is: ".$message."<br><br><hr>";
    		else 
    			echo "<b>topic is: ".$topic."<br>"."Message is: ".$message."<br><br><hr></b>";
    		updatem($topic, $email);
    	}
	}
	else {
		echo "You have no messages";
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
<a href="subscriber.php">Home</a><br><br>
<?php
showlist($email);
?>
</body>
</html>

<?php

function updatem($topic, $email){
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

		$sql = "update message set viewed='Y' where user_email='$email';";

		if ($conn->query($sql) === TRUE) {
			// echo "Successfully subscribed to ".$cate[$i]."<br>";
		} 
		else {
			// echo "You are already subscribed to ".$cate[$i]."<br>";
		}
	$conn->close();
}

?>