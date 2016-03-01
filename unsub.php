<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<?php
if(isset($_GET["email"])){
	// echo "h";
	showlist($_GET["email"]);
}
?>
<body>
	<?php 
	if(!isset($_GET["email"])){
	echo "
	enter the email
	<form action=\"unsub.php\" method=\"GET\">
		<input type=\"text\" name=\"email\">
		<input type=\"submit\" value=\"Submit\">		
	</form>
	";
	}
	?>
</body>
</html>

<?php
function showlist($email=null){
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

	$sql = "select topic from subs where user_email='$email'";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
		echo "select from topics to unsubscribe";
		echo "<form action=\"unsubs.php\" method=\"GET\" >";
    	echo "<input type=text name=email value=$email><br>";
    	while($row = $result->fetch_assoc()) {
    		$topic = trim($row['topic']);
    		echo "<input type=checkbox name=category[] value=$topic>";
    		echo $topic;
    		echo "<br>";
    	}
    	echo "<input type=\"submit\" value=\"submit\">";
    	echo "</form>";
	}
	else {
		echo "you have not subscribed to any topic";
	}

	$conn->close();
}

?>