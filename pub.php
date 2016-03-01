<?php
$handle = $_GET["handle"];
// echo $handle;
function showlist($handle){
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

	$sql = "select name from topic where pub='$handle'";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    	while($row = $result->fetch_assoc()) {
    		$topic = trim($row['name']);
    		echo "<input type=radio name=category value=$topic>";
    		echo $topic;
    		echo "<br>";
    	}
	}
	else {
		echo "You have no topics<br>";
		window.stop();
	} 
	$conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
	function hi () {
		// body...
		var topic = document.getElementsByName('category');
		var t="";
		for(var i = 0; i < topic.length; i++){
    		if(topic[i].checked){
        		t = topic[i].value;
    		}
		}
		var message = document.getElementById('message').value;
		// alert(t);
		window.location.href = "pubsub.php/"+t+"/"+message;
		return false;
	}
	</script>
</head>
<body>
	<!-- <form> -->
	<?php

		showlist($handle);

	?>
		Message<input type="text" id="message"><br>
		<input type="submit" onclick="hi();" value="publish">
	<!-- </form> -->
</body>
</html>