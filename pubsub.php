<?php

require "/home/sunil/vendor/autoload.php";
$app = new \Slim\Slim();

$app->get('/:topic/:message', function ($topic, $message) {
	// echo $topic;
	// echo "<br>";
	// echo $message;

sendMail($topic, $message);

});

$app->get('/unsub/:topic/:email', function ($topic, $email) {
	// echo $topic;
	// echo "<br>";
	// echo $email;

unsub($topic, $email);

});

$final_ar=array();
/*------------------*/
function sendMail($topic=null, $message=null){
	$m=$message;
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

	$sql = "select user_email from subs where topic='$topic'";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    	while($row = $result->fetch_assoc()) {
    		$email = trim($row['user_email']);
    		// echo $email;
    		$msg_un = "to unsubscribe <a href=\"pubsub.php/unsub/$topic/$email\">click</a>";
    		$message = $message."<br>".$msg_un;
			mail($email, $topic, $message);
			store_email($topic,$email,$message);
			$message=$m;
    	}
    	echo "
    	<script type=\"text/javascript\">
			alert(\"success\");
		</script>
    	";
    	// header("Location: index.php");
	} 
	$conn->close();
}

function unsub($topic=null, $email=null){
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

	$sql = "delete from subs where topic='$topic' && user_email='$email'";
	
	if ($conn->query($sql) === TRUE) {
		echo "Successfully unsubscribed from $topic";
	} 
	else {
		echo "Failure. Please try later";
	}
	$conn->close();
}


function store_email($topic, $email, $message){
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

		$sql = "insert into message values('$topic','$email','$message','N');";

		if ($conn->query($sql) === TRUE) {
			// echo "Successfully subscribed to ".$cate[$i]."<br>";
		} 
		else {
			// echo "You are already subscribed to ".$cate[$i]."<br>";
		}
	$conn->close();
}




// function check($operand1=null,$operator=null,$operand2=null){
// 	$servername = "localhost";
// 	$username = "root";
// 	$password = "root";
// 	$dbname = "DAC";

// 	// Create connection
// 	$conn = new mysqli($servername, $username, $password, $dbname);

// 	// Check connection
// 	if ($conn->connect_error) {
// 	    die("Connection failed: " . $conn->connect_error);
// 	}

// 	$sql = "select result from cache where op1=$operand1 && operator='$operator' && op2=$operand2;";
	
// 	$result = $conn->query($sql);

// 	if ($result->num_rows > 0) {
//     // output data of each row
//     	while($row = $result->fetch_assoc()) {
//     		$tmp=trim($row['result']);
//     		$final_ar['status']="ok";
//     		$final_ar['result']=$tmp;
// 			echo json_encode($final_ar);
//         	// echo trim($row['result']);
//     	}
// 	} 
// 	else {
//     insert($operand1,$operator,$operand2);
// 	}
// $conn->close();
// }
// /*------------------*/

// /*------------------*/

// function insert($operand1=null,$operator=null,$operand2=null){
// 	$servername = "localhost";
// 	$username = "root";
// 	$password = "root";
// 	$dbname = "DAC";

// 	// Create connection
// 	$conn = new mysqli($servername, $username, $password, $dbname);

// 	// Check connection
// 	if ($conn->connect_error) {
// 	    die("Connection failed: " . $conn->connect_error);
// 	}

// 	if($operator == '+'){
// 		$final = $operand1 + $operand2;
// 	}

// 	else if($operator == '-'){
// 		$final = $operand1 - $operand2;
// 	}

// 	else if($operator == '#'){
// 		if($operand2 == 0) {
// 			$final_ar['status']="nok";
//     		$final_ar['result']="cannot divide by 0";
// 			echo json_encode($final_ar);
// 			// echo "cannot divide by 0";
// 			die();
// 		}
// 		$operator = '/';
// 		$final = $operand1 / $operand2;
// 	}

// 	else if($operator == 'X'){
// 		$final = $operand1 * $operand2;
// 	}
// 	$final = trim($final);
// 	if($final>99999999999999){
// 		$final_ar['status']="nok";
//     	$final_ar['result']="result out of bound";
// 		// echo "result out of bound";
// 		die();
// 	}
// 	$sql = "insert into cache values($operand1,'$operator',$operand2,$final);";

// 	if ($conn->query($sql) === TRUE) {
// 		$final_ar['status']="ok";
//     	$final_ar['result']=trim($final);
// 		echo json_encode($final_ar);
// 	    // echo trim($final);
// 	} 
// 	else {
// 		$final_ar['status']="nok";
//     	$final_ar['result']="please try again";
// 		echo json_encode($final_ar);
// 	    // echo "Error: ";// . $sql . "<br>" . $conn->error;
// 	}

// 	$conn->close();
// }
// /*------------------*/
// // $final_ar['status']="nok";
// //     	$final_ar['result']="please try again";
// // $app->response()->header('Content-Type', 'application/json');
// // echo json_encode($final_ar);
// // var_dump($final_ar);


$app->run();
?>

