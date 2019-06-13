<?php
	include 'db.php'; //MySQL Database Configuration File
	if (!isset($_SESSION['email'])) {
		header('Location: index.php');
	}
	$id = $_SESSION['user_id'];

	if (isset($_POST['submit_sem1'])) {
		$id = $_SESSION['user_id'];
		$sem1_sub1 = $_POST['sem1_sub1'];
		$sem1_sub2 = $_POST['sem1_sub2'];
		$sem1_sub3 = $_POST['sem1_sub3'];
		$sem1_sub4 = $_POST['sem1_sub4'];
		$query = "SELECT user_id from `sem1` where user_id=$id";
		$result = mysqli_query($conn, $query); 
		if (mysqli_num_rows($result) > 0) {
			$query = "UPDATE `sem1` set subject1 = $sem1_sub1, subject2 = $sem1_sub2, subject3 = $sem1_sub3, subject4 = $sem1_sub4 where user_id=$id";
			if(!mysqli_query($conn,$query)){ //Executing query and checking for errors  
				$success_sem1 = 0;
				$msg = "Error: ".mysql_error($conn);
				
			}else{
				$success_sem1 = 1;
				$msg = "Sem 1 Marks Updated";
				
			}
		}else{
			$query = "INSERT INTO `sem1` values ('',$sem1_sub1,$sem1_sub2,$sem1_sub3,$sem1_sub4,$id)";
			if(!mysqli_query($conn,$query)){ //Executing query and checking for errors  
				$success_sem1 = 0;
				$msg = "Error: ".mysql_error($conn);
				
			}else{
				$success_sem1 = 1;
				$msg = "Sem 1 Marks Inserted";
				
			}
		}
	}

	if (isset($_POST['submit_sem2'])) {
		$id = $_SESSION['user_id'];
		$sem2_sub1 = $_POST['sem2_sub1'];
		$sem2_sub2 = $_POST['sem2_sub2'];
		$sem2_sub3 = $_POST['sem2_sub3'];
		$sem2_sub4 = $_POST['sem2_sub4'];
		$query = "SELECT user_id from `sem2` where user_id=$id";
		$result = mysqli_query($conn, $query); 
		if (mysqli_num_rows($result) > 0) {
			$query = "UPDATE `sem2` set subject1 = $sem2_sub1, subject2 = $sem2_sub2, subject3 = $sem2_sub3, subject4 = $sem2_sub4 where user_id=$id";
			if(!mysqli_query($conn,$query)){ //Executing query and checking for errors  
				$success_sem2 = 0;
				$msg = "Error: ".mysql_error($conn);
				
			}else{
				$success_sem2 = 1;
				$msg = "Sem 2 Marks Updated";
				
			}
		}else{
			$query = "INSERT INTO `sem2` values ('',$sem2_sub1,$sem2_sub2,$sem2_sub3,$sem2_sub4,$id)";
			if(!mysqli_query($conn,$query)){ //Executing query and checking for errors  
				$success_sem2 = 0;
				$msg = "Error: ".mysql_error($conn);
				
			}else{
				$success_sem2 = 1;
				$msg = "Sem 2 Marks Inserted";
				
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home <?php echo $_SESSION["user_id"]; ?></title>
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/flatly/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>
<body>
	<script type="text/javascript">
		//Function to check the range
		function check_range(value) {
			if (value >= 0 && value <= 100) {
					return true;
			}else{
				return false;
			}
		}
		//Function to validate
		function validate(form) {
			// form.elements[1] --> Value of Subject 1
			if (check_range(form.elements[1].value) && check_range(form.elements[2].value) && check_range(form.elements[3].value) && check_range(form.elements[4].value)) {
					return true;
			}else{
				alert('Please Enter marks between 0-100');
				return false;
			}
		}
	</script>
	<?php include 'nav.html'; ?>
	<div class="container mt-4">
			<div class="row" style="width: 100%">
				<div style="width: 45%; box-shadow: 0px 4px 10px 0px rgba(0, 0, 0, 0.15)">
					<div style="font-family: 'Open Sans'; text-align: center; font-size: 24px; padding: 20px; background: #000; color: #fff; font-weight: 700; border-top-left-radius: 10px; border-top-right-radius: 10px; "><span><img src="icons/test.png" width="40"></span> SEM 1</div>
					<form method="POST" name="sem1_form" onsubmit="return validate(this)" style="background: #fff; padding: 40px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
						<?php 
							if (isset($success_sem1) ) {
								if ($success_sem1 == 1) {
								?>
									<div class="alert alert-success text-center mb-5"><?php echo $msg; ?></div>
								<?php	
								}else if ($success_sem1 == 0) {
								?>
									<div class="alert alert-danger text-center mb-5"><?php echo $msg; ?></div>
								<?php
								}
							}

							$table_name = 'sem1';
							$query = "SELECT * from $table_name where user_id=$id";
							$result = mysqli_query($conn, $query); 
							if (mysqli_num_rows($result) > 0) {
								$sem1_row = mysqli_fetch_assoc($result);
								?> 
							<div class="alert alert-info text-center mb-5">Data Already exist. You Can Update Your Data</div>

								<?php
							}else{
								?>
							<div class="alert alert-info text-center mb-5">Data Not Exist. Please Insert Your Marks</div>
								<?php
							}

						?>
					<fieldset>

						 <div class="form-group row">
					      <label for="sem1_sub1" class="col-sm-8 col-form-label">Subject 1</label>
					      <div class="col-sm-4">
					        <input type="text" class="form-control" value="<?php if (isset($sem1_row)) {echo $sem1_row['subject1']; } ?>" id="sem1_sub1" name="sem1_sub1" placeholder="Enter Marks" required>
					      </div>
					    </div>

						 <div class="form-group row">
					      <label for="sem1_sub2" class="col-sm-8 col-form-label">Subject 2</label>
					      <div class="col-sm-4">
					        <input type="text" class="form-control" value="<?php if (isset($sem1_row)) {echo $sem1_row['subject2']; } ?>" name="sem1_sub2" id="sem1_sub2" placeholder="Enter Marks" required>
					      </div>
					    </div>

						 <div class="form-group row">
					      <label for="sem1_sub3" class="col-sm-8 col-form-label">Subject 3</label>
					      <div class="col-sm-4">
					        <input type="text" class="form-control" value="<?php if (isset($sem1_row)) {echo $sem1_row['subject3']; } ?>" name="sem1_sub3" id="sem1_sub3" placeholder="Enter Marks" required>
					      </div>
					    </div>

					     <div class="form-group row">
					      <label for="sem1_sub4" class="col-sm-8 col-form-label">Subject 4</label>
					      <div class="col-sm-4">
					        <input type="text" class="form-control" value="<?php if (isset($sem1_row)) {echo $sem1_row['subject4']; } ?>" name="sem1_sub4" id="sem1_sub4" placeholder="Enter Marks" required>
					      </div>
					    </div>

					    <center>
					    	<input type="submit" style="font-weight: 700" name="submit_sem1" class="btn-lg btn-success mt-3">
					    </center>

					</fieldset>
				</form>
				</div>

				<div style="width: 45%; margin-left: 5%; box-shadow: 0px 4px 10px 0px rgba(0, 0, 0, 0.15)">
					<div style="font-family: 'Open Sans'; text-align: center; font-size: 24px; padding: 20px; background: #000; color: #fff; font-weight: 700; border-top-left-radius: 10px; border-top-right-radius: 10px; "><span><img src="icons/test.png" width="40"></span>SEM 2</div>
					<form method="POST" onsubmit="return validate(this)" style="background: #fff; padding: 40px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
						<?php 
							if (isset($success_sem2) ) {
								if ($success_sem2 == 1) {
								?>
									<div class="alert alert-success text-center mb-5"><?php echo $msg; ?></div>
								<?php	
								}else if ($success_sem2 == 0) {
								?>
									<div class="alert alert-danger text-center mb-5"><?php echo $msg; ?></div>
								<?php
								}
							}



							$table_name = 'sem2';
							$query = "SELECT * from $table_name where user_id=$id";
							$result = mysqli_query($conn, $query); 
							if (mysqli_num_rows($result) > 0) {
								$sem2_row = mysqli_fetch_assoc($result);
									?>
							<div class="alert alert-info text-center mb-5">Data Already exist. You Can Update Your Data</div>

									<?php
							}else{
								?>
							<div class="alert alert-info text-center mb-5">Data Not Exist. Please Insert Your Marks</div>
								<?php
							}

						?>
					<fieldset>
						 <div class="form-group row">
					      <label for="sem2_sub1" class="col-sm-8 col-form-label">Subject 1</label>
					      <div class="col-sm-4">
					        <input type="text" class="form-control" id="sem2_sub1" value="<?php if (isset($sem2_row)) {echo $sem2_row['subject1']; } ?>" name="sem2_sub1" placeholder="Enter Marks" required>
					      </div>
					    </div>

						 <div class="form-group row">
					      <label for="sem2_sub2" class="col-sm-8 col-form-label">Subject 2</label>
					      <div class="col-sm-4">
					        <input type="text" class="form-control" name="sem2_sub2" value="<?php if (isset($sem2_row)) {echo $sem2_row['subject2']; } ?>" id="sem2_sub2" placeholder="Enter Marks" required>
					      </div>
					    </div>

						 <div class="form-group row">
					      <label for="sem2_sub3" class="col-sm-8 col-form-label">Subject 3</label>
					      <div class="col-sm-4">
					        <input type="text" class="form-control" name="sem2_sub3" value="<?php if (isset($sem2_row)) {echo $sem2_row['subject3']; } ?>" id="sem2_sub3" placeholder="Enter Marks" required>
					      </div>
					    </div>

						 <div class="form-group row">
					      <label for="sem2_sub4" class="col-sm-8 col-form-label">Subject 4</label>
					      <div class="col-sm-4">
					        <input type="text" class="form-control" name="sem2_sub4" value="<?php if (isset($sem2_row)) {echo $sem2_row['subject4']; } ?>" id="sem2_sub4" placeholder="Enter Marks" required>
					      </div>
					    </div>

					    <center>
					    	<input type="submit" style="font-weight: 700" name="submit_sem2" class="btn-lg btn-success mt-3">
					    </center>

					</fieldset>
				</form>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>