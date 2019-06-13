<?php
	include 'db.php';
	// If the user is already logged in
	if (isset($_SESSION['email'])) {
		header('Location: home.php');
	}
	if (isset($_POST['submit'])) {  //check if the form is submitted or not
		
		//Storing the form details into variables.. according to input field name
		$email = $_POST['email'];
		$password = $_POST['password'];

		//Query for checking if the email id is registered or not. If yes then Selecting hashed password for that email.
		$query = "SELECT id,email,password FROM `registration` where email='$email'";

		// Stroing the result of query in result variable 
		$result = mysqli_query($conn, $query); 
		// If email id is registered then there will be 1 row in the result
		if (mysqli_num_rows($result) > 0) {
		// output data of each row
			$row = mysqli_fetch_assoc($result);
			if(password_verify($password, $row["password"])) {
				// Store the email into Session Variable(cookie) to start the session.
				$_SESSION['email'] = $email;
				$_SESSION['user_id'] = $row['id'];

				header('Location: home.php');
			}else{
			 	$error = 1;
			 	$error_msg = "Password is incorrect. Please try again.";	
			}
		 }else {
		 	$error = 1;
		 	$error_msg = "Error: ".$email." is not registered! Kindly register and try again.";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/flatly/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <style type="text/css">
    	label{
    		font-weight: 800;
    	}
    </style>
</head>
<body style="background: linear-gradient(to top right, #08aeea 0%, #b721ff 100%); height: 96.5vh ">
	<div class="container mt-4 mb-5">
		<div class="row" style="justify-content: center; box-shadow:"> 
			<div class="col-md-9">
				<div style="box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15)">
					<div style="font-family: 'Open Sans'; text-align: center; font-size: 24px; padding: 20px; background: #000; color: #fff; font-weight: 700; border-top-left-radius: 10px; border-top-right-radius: 10px; ">LOGIN</div>
					<form method="POST" style="background: #fff; padding: 40px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
						<?php 
							if (isset($error)) {
								?>
									<div class="alert alert-danger text-center mb-5"><?php echo $error_msg; ?></div>
								<?php
							}
						?>
					<fieldset>
						 <div class="form-group row">
					      <label for="Email" class="col-sm-2 col-form-label">Email</label>
					      <div class="col-sm-10">
					        <input type="text" class="form-control" id="Email" name="email" placeholder="Enter Email"	 required>
					      </div>
					    </div>

						 <div class="form-group row">
					      <label for="Password" class="col-sm-2 col-form-label">Password</label>
					      <div class="col-sm-10">
					        <input type="password" class="form-control" name="password" id="Password" placeholder="Enter Password" autocomplete="new-pass" required>
					      </div>
					    </div>

					    <center>
					    	<input type="submit" style="font-weight: 700" name="submit" class="btn-lg btn-success mt-3">
					    	<button type="button"  style="font-weight: 700" onclick="window.location.href='index.php'" class="ml-5 btn-lg btn-success">Not Registered?</button>
					    </center>

					</fieldset>
				</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>