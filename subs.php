<?php
// var_dump($_GET["category"]);
// while ($_GET["category"] != null) {
// 	echo $_GET["category"];
// }
$cate = array();
$cate = $_GET["category"];
$email = $_GET["email"];
// var_dump($cate);

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

	for ($i=0; $i < sizeof($cate); $i++) { 
		$sql = "insert into subs(topic, user_email) values('$cate[$i]','$email');";

		if ($conn->query($sql) === TRUE) {
			echo "Successfully subscribed to ".$cate[$i]."<br>";
		} 
		else {
			echo "You are already subscribed to ".$cate[$i]."<br>";
		}
	}
	$conn->close();

?>