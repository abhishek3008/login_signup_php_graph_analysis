<?php
	include 'db.php'; //MySQL Database Configuration File
	// If the user is already logged in
	if (isset($_SESSION['email'])) {
		header('Location: home.php');
	}
	// Values of form get stored in $_POST variable as we have used post method
	if (isset($_POST['submit'])) {  //check if the form is submitted
		
		//Storing all the form details into variables.. according to input field name
		$name = $_POST['name'];		
		$college = $_POST['college'];
		$gender = $_POST['gender'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$state = $_POST['state'];
		$address = $_POST['address'];
		$pass = password_hash($_POST['password'], PASSWORD_DEFAULT); //Hashing of password to provide security

		// Inserting into Database

		$query = "INSERT INTO `registration` values ('','$name','$gender','$college','$email','$pass',$mobile,'$state','$address')";

		if(!mysqli_query($conn,$query)){ //Executing query and checking for errors  
			$error = 0;
			$error_msg = mysqli_error($conn);
			if ($error_msg == "Duplicate entry '".$email."' for key 'email'") {
				$error_msg = "This Email-Id is already registered.";
			}
		}
		else{
			$success = 1;
			$_SESSION['email'] = $email;
			$query = "SELECT id FROM `registration` where email='$email'";
			$result = mysqli_query($conn, $query); 
			$row = mysqli_fetch_assoc($result);
			$_SESSION['user_id'] = $row['id'];
			echo $_SESSION['user_id'];
			header('Location: home.php');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/flatly/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <style type="text/css">
    	label{
    		font-weight: 800;
    	}
    </style>
</head>
<body style="background: linear-gradient(to top right, #08aeea 0%, #b721ff 100%); ">
	<div class="container mt-4 mb-5">
		<div class="row" style="justify-content: center; box-shadow:"> 
			<div class="col-md-9">
				<div style="box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15)">
					<div style="font-family: 'Open Sans'; text-align: center; font-size: 24px; padding: 20px; background: #000; color: #fff; font-weight: 700; border-top-left-radius: 10px; border-top-right-radius: 10px; ">REGISTRATION FORM</div>
					<form method="POST" style="background: #fff; padding: 40px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
						<?php 
							// Display errors when form is submitted
							if (isset($error)) {
						?>
									<div class="alert alert-danger text-center mb-5"><?php echo $error_msg; ?></div>
						<?php 
								} 
						?>
					<fieldset>
						 <div class="form-group row">
					      <label for="name" class="col-sm-2 col-form-label">Name</label>
					      <div class="col-sm-10">
					        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
					      </div>
					    </div>

					    

						 <div class="form-group row">
					      <label class="col-sm-2 col-form-label">Gender</label>
					      <div class="col-sm-10">
					        <input type="radio" name="gender" value="Male" checked> Male
					        <input type="radio" class="ml-5" name="gender" value="Female"> Female
					        <input type="radio" class="ml-5" name="gender" value="Others"> Others
					      </div>
					    </div>

					    <div class="form-group row">
					      <label for="College" class="col-sm-2 col-form-label">College</label>
					      <div class="col-sm-10">
					        <input type="text" class="form-control" id="College" name="college" placeholder="Enter College Name" required>
					      </div>
					    </div>
						<!-- Type Email is inbuilt validator -->
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

					    <!-- Patterns is used for validating mobile number -->
						 <div class="form-group row">
					      <label for="Mobile" class="col-sm-2 col-form-label">Mobile</label>
					      <div class="col-sm-10">
					        <input type="text" class="form-control" id="Mobile" placeholder="Enter Mobile No" autocomplete="new-mob" name="mobile" pattern="[6-9]{1}[0-9]{9}" title="Enter Valid Phone Number" required>
					      </div>
					    </div>


					     <div class="form-group row">
					      <label for="State" class="col-sm-2 col-form-label">State</label>
					      <div class="col-sm-10">
					      	<select class="form-control" id="State" name="state" required>
					      		  <option>Select State</option>
			                      <option>Andaman and Nicobar Islands </option>
			                      <option>Andhra Pradesh</option>
			                      <option>Arunachal Pradesh</option>
			                      <option>Assam</option>
			                      <option>Bihar</option>
			                      <option>Chandigarh </option>
			                      <option>Chhattisgarh</option>
			                      <option>Dadra and Nagar Haveli</option>
			                      <option>Daman and Diu </option>
			                      <option>National Capital Territory of Delhi </option>
			                      <option>Goa</option>
			                      <option>Gujarat</option>
			                      <option>Haryana</option>
			                      <option>Himachal Pradesh</option>
			                      <option>Jammu and Kashmir</option>
			                      <option>Jharkhand</option>
			                      <option>Karnataka</option>
			                      <option>Kerala</option>
			                      <option>Lakshadweep </option>
			                      <option>Madhya Pradesh</option>
			                      <option>Maharashtra</option>
			                      <option>Manipur</option>
			                      <option>Meghalaya</option>
			                      <option>Mizoram</option>
			                      <option>Nagaland</option>
			                      <option>Odisha</option>
			                      <option>Puducherry </option>
			                      <option>Punjab</option>
			                      <option>Rajasthan</option>
			                      <option>Sikkim</option>
			                      <option>Tamil Nadu</option>
			                      <option>Telangana</option>
			                      <option>Tripura</option>
			                      <option>Uttar Pradesh</option>
			                      <option>Uttarakhand</option>
			                      <option>West Bengal</option>
					      	</select>
					      </div>
					    </div>


						 <div class="form-group row">
					      <label for="name" class="col-sm-2 col-form-label">Address</label>
					      <div class="col-sm-10">
					        <textarea type="text" class="form-control" id="name" name="address" placeholder="Enter Address - Hno/block street" autocomplete="street" required></textarea>
					      </div>
					    </div>

					    <center><input type="submit" value="REGISTER" style="font-weight: 700" name="submit" class="btn-lg btn-success mt-3">
					    	<button type="button"  style="font-weight: 700" onclick="window.location.href='login.php'" class="ml-5 btn-lg btn-success">Already Registered?</button>
					    </center>


					</fieldset>
				</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>