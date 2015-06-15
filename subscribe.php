<!DOCTYPE html>
<html>

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!--Display logo-->
		<link rel="icon" href="images/1.png">

		<!--CSS-->
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<title>Subscribe</title>
	</head>

	<body>
		<!--Container holding all the content-->
		<div class="container">
			<!--Link and Image-->
			<header>
				<div>
					<a href="http://gc200303856.computerstudi.es/sem2/php/Assignment_1/display.php">Subscribers' List</a>
				</div>
				<div><img src="images/2.png" alt="Android's Logo">
				</div>
			</header>
			<!--Headings-->
			<h1><b>Android</b><small>&copy;</small></h1>
			<h2>Subscribe for Newsletter</h2>
			<!--Form-->
			<form class="form-horizontal" class="text-center" id="subscription" name="subscription" method="post" action="save.php">
				<input name="form_sent" type="hidden" value="1">
				<!--First Name-->
				<div class="form-group">
					<label class="col-sm-2 control-label" for="first_name">First Name:</label>
					<div class="col-sm-6">
						<input name="first_name" type="text"  class="form-control" title="Your First Name" placeholder="First Name" required="" />
					</div>
				</div>
				<!--Last Name-->
				<div class="form-group">
					<label class="col-sm-2 control-label" for="last_name">Last Name:</label>
					<div class="col-sm-6">
						<input name="last_name" type="text"  class="form-control" title="Your Last Name" placeholder="Last Name" required="" />
					</div>
				</div>
				<!--Gender-->
				<div class="form-group">
					<label class="col-sm-2 control-label" for="gender">Gender:</label>
					<!--Radio Button Male using PHP-->
					<input type = 'radio'   checked="" Name ='gender' value= 'male'
					<?php print $male_status; ?>
					>
					Male
					
					<!--Radio Button Female using PHP-->
					<input type = 'radio'  Name ='gender' value= 'female'
					<?php print $female_status; ?>
					>
					Female
					
					<!--checking which radio button is checked-->
					<?php
					
					//intial status of both as unchecked
					$male_status = 'unchecked';
					$female_status = 'unchecked';
					
					//specify the variable storing the selection
					$selected_radio = $_POST['gender'];
					
					//check which radio button is selected
					if ($selected_radio == 'male') {

						$male_status = 'checked';

					} else if ($selected_radio == 'female') {

						$female_status = 'checked';

					}
					?>

				</div>
				<!--Address-->
				<div class="form-group">
					<label class="col-sm-2 control-label" for="address">Address:</label>
					<div class="col-sm-6">
						<input name="address" type="text"  class="form-control" title="Your Address" placeholder="Address" required="" />
					</div>
				</div>
				<!--Province-->
				<div class="form-group">
					<label class="col-sm-2 control-label" for="province">Province:</label>
					<div class="col-sm-6">
						<select name="province"  class="form-control">
							<option>-Select-</option>
							<!--get province list from the database-->
							<?php
							//connect
							$conn = new PDO('mysql:host=xxxxxxxxxxxx;dbname=xxxxxxxx', 'xxxxxxxx', 'xxxxxxxx');
							$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

							//set up the sql select query
							$sql = "SELECT province FROM provinces ORDER BY province";

							//execute the query and store the result
							$cmd = $conn -> prepare($sql);
							$cmd -> execute();
							$result = $cmd -> fetchAll();

							//loop through the results and add each province to the dropdown
							foreach ($result as $row) {
								echo '<option>' . $row['province'] . '</option>';
							}

							//disconnect
							$conn = null;
							?>
						</select>
					</div>
				</div>
				<!--Email-->
				<div class="form-group">
					<label class="col-sm-2 control-label" for="email">Email:</label>
					<div class="col-sm-6">
						<input name="email" type="email"  class="form-control" title="Your Email Address" placeholder="Email" required="" />
					</div>
				</div>
				<!--Button to submit the form-->
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-primary"type="submit">
							SUBSCRIBE
						</button>
					</div>
				</div>
			</form>
		</div>
	</body>

</html>
