<?php
// var_dump($_GET["category"]);
// while ($_GET["category"] != null) {
// 	echo $_GET["category"];
// }
$cate = array();
$cate = $_GET["category"];
$email = $_GET["email"];
// var_dump($cate);
// var_dump($email);

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
		$sql = "delete from subs where topic='$cate[$i]' && user_email='$email'";

		if ($conn->query($sql) === TRUE) {
			echo "Successfully unsubscribed to ".$cate[$i]."<br>";
		} 
		else {
			echo "You are already unsubscribed to ".$cate[$i]."<br>";
		}
	}
	$conn->close();

?>