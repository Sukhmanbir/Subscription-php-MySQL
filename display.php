<!DOCTYPE html>
<html>

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!--Display logo-->
		<link rel="icon" href="images/1.png">

		<!--CSS-->
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<title>Subscribers</title>
	</head>

	<body>
		<!--Link and Image-->
		<div>
			<a href="http://gc200303856.computerstudi.es/sem2/php/Assignment_1/subscribe.php">New Subscription</a>
		</div>
		<div><img src="images/2.png" alt="Android's Logo">
		</div>
		<!--Heading-->
		<h1>Subscribers</h1>
		<!--Table-->
		<div class="table-responsive">

			<?php
			//Connect to database
			$conn = new PDO('mysql:host=xxxxxxxxxxxx;dbname=xxxxxxxx', 'xxxxxxxx', 'xxxxxxxx');
			//Enable SQL debugging
			$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			//Select data from SQL table using SELECT command
			$sql = "SELECT * FROM android";

			//Execute query
			$cmd = $conn -> prepare($sql);
			$cmd -> execute();
			//Fetch data
			$result = $cmd -> fetchAll();

			//Start the html table
			echo '          
  <table class="table table-striped table-hover table-bordered"><thead>
<th>ID</th>  
<th>First Name</th>
<th>Last Name</th>
<th>Gender</th>	
<th>Address</th>		
<th>Province</th>
<th>Email</th></thead><tbody>';

			//Loop through the single record in data at a time
			foreach ($result as $row) {
				//Output the values from the query sequentially
				echo '<tr><td>' . $row['id'] . '</td>
	<td>' . $row['first_name'] . '</td>
	<td>' . $row['last_name'] . '</td>
	<td>' . $row['gender'] . '</td>
	<td>' . $row['address'] . '</td>
	<td>' . $row['province'] . '</td>
	<td><a href="mailto:' . $row['email'] . '">' . $row['email'] . '</a></td></tr>';
			}

			//Disconnect
			$conn = null;
			?>
		</div>
	</body>

</html>
