<!DOCTYPE html>
<html>

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!--Display logo-->
		<link rel="icon" href="images/1.png">

		<!--CSS-->
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<title>Subscribing...</title>
	</head>

	<body>
		<!--Link and Image-->
		<div>
			<a href="http://gc200303856.computerstudi.es/sem2/php/Assignment_1/display.php">Subscribers' List</a>
		</div>
		<div><img src="images/2.png" alt="Android's Logo">
		</div>

		<?php
		//store the input in variables
		$first_name = test_input($_POST['first_name']);
		$last_name = test_input($_POST['last_name']);
		$gender = test_input($_POST['gender']);
		$address = test_input($_POST['address']);
		$province = test_input($_POST['province']);
		$email = test_input($_POST['email']);
		$ok = true;

		//check that input was completed by the user
		if (empty($first_name)) {
			echo "Please enter your first name
		<br />
		";
			$ok = false;
		}

		if (empty($last_name)) {
			echo "Please enter your last name
		<br />
		";
			$ok = false;
		}

		if (empty($gender)) {
			echo "Please select your gender
		<br />
		";
			$ok = false;
		}

		if (empty($address)) {
			echo "Please enter your address
		<br />
		";
			$ok = false;
		}

		if ($province == "-Select-") {
			echo "Please select your province
		<br />
		";
			$ok = false;
		}

		if (empty($email)) {
			echo "Please enter your email
		<br />
		";
			$ok = false;
		} else {
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo "Invalid email format";
				$ok = false;
			}
		}

		//connection is made to check if user is already subscribed or not
		//connect
		$conn = new PDO('mysql:host=xxxxxxxxxxxx;dbname=xxxxxxxx', 'xxxxxxxx', 'xxxxxxxx');
		$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//set up & execute the sql select
		$sql = "SELECT email FROM android";

		//check if same email is subscribed or not
		foreach ($conn->query($sql) as $row) {
			if ($row['email'] == $email) {
				echo "The email address $email is already subscribed to the newsletter.";
				$ok = false;
			}
		}

		//if all inputs are complete
		if ($ok) {

			//set up and execute the sql insert
			$sql = "INSERT INTO android(first_name, last_name, gender, address, province, email) VALUES (:first_name, :last_name, :gender, :address, :province, :email)";
			$cmd = $conn -> prepare($sql);
			$cmd -> bindParam(':first_name', $first_name, PDO::PARAM_STR, 50);
			$cmd -> bindParam(':last_name', $last_name, PDO::PARAM_STR, 50);
			$cmd -> bindParam(':gender', $gender, PDO::PARAM_STR, 6);
			$cmd -> bindParam(':address', $address, PDO::PARAM_STR, 500);
			$cmd -> bindParam(':province', $province, PDO::PARAM_STR, 2);
			$cmd -> bindParam(':email', $email, PDO::PARAM_STR, 100);
			$cmd -> execute();

			//disconnect
			$conn = null;

			//send email to user
			mail($email, 'Subscription Confirmation', 'Hello ' . $first_name . ', This email is to confirm that you have been successfully subscribed to Android Newsletter. You will get all the updates and news about Android weekly. Thank you for subscribing us!');

			echo '<h1>Hello <b>' . $first_name . '</b>,</h1>
		<br />
		<h2>You have been successfully subscribed to Android Newsletter.
		<br />
		A confirmation email has been sent to <a href="mailto:' . $email . '">' . $email . '</a> .</h2>';
		}

		//add function to escape special characters input by the user
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		?>
	</body>

</html>
