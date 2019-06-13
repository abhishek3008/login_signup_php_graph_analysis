<?php
	include 'db.php';
	$check = 0;
	if (!isset($_SESSION['email'])) {
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link href="https://canvasjs.com/assets/css/jquery-ui.1.11.2.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/flatly/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <style type="text/css">
    	label{
    		font-weight: 800;
    	}
    	.my-card{
    		box-shadow: 0px 2px 10px 0px rgba(0,0,0,0.25);
    	}

    	.my-card:hover{
    		transition: .4s;
    		box-shadow: 0px 2px 10px 0px rgba(0,0,0,0.5);
    	}
    	li{
    		cursor: pointer;
    		padding: 5px;
    	}
    </style>


</head>
<body>

	<!-- Navigation Bar -->
	<?php include 'nav.html'; ?>
	<div class="container">
		<div class="row mt-5" style="width: 100%; justify-content: right;">
				<div class="col-md-4 my-card" style="border-radius: 4px; width: 200px; padding: 20px;">
						<div class="mb-4"><center><img src="icons/man.png" style="width: 120px"></center></div>
						<?php 
							$email = $_SESSION['email'];
                            $query = "SELECT * FROM `registration` where email = '$email'";
                            $result = mysqli_query($conn,$query);
                            $row = mysqli_fetch_assoc($result);
                        ?>
						<fieldset>
							 <div class="form-group row">
						      <label for="name" class="col-sm-2 col-form-label">Name</label>
						      <div class="col-sm-10 mt-2">
						        <?php echo $row['name']; ?>
						      </div>
						    </div>

							 <div class="form-group row">
						      <label for="name" class="col-sm-2 col-form-label">Gender</label>
						      <div class="col-sm-10 mt-2">
						        <?php echo $row['gender']; ?>
						      </div>
						    </div>

							 <div class="form-group row">
						      <label for="name" class="col-sm-2 col-form-label">College</label>
						      <div class="col-sm-10 mt-2">
						        <?php echo $row['college']; ?> 
						      </div>
						    </div>

							 <div class="form-group row">
						      <label for="name" class="col-sm-2 col-form-label">Email</label>
						      <div class="col-sm-10 mt-2">
						        <?php echo $row['email']; ?>
						      </div>
						    </div>

							 <div class="form-group row">
						      <label for="name" class="col-sm-2 col-form-label">Mobile</label>
						      <div class="col-sm-10 mt-2">
						        <?php echo $row['mobile']; ?>
						      </div>
						    </div>

						</fieldset>
				</div>
				<div class="col-md-8">
						<div class="row" style="height: 100%; width: 100% ;justify-content: center;">
							<div class="my-card" style="width: 45%; border-top-left-radius: 10px; border-top-right-radius: 10px;">
								<div style="font-family: 'Open Sans'; text-align: center; font-size: 24px; padding: 20px; background: #000; color: #fff; font-weight: 700; border-top-left-radius: 10px; border-top-right-radius: 10px;">Analysis</div>
								<img src="images/charts.jpg" style="width: 100%">
								<div style="padding: 60px;">
									<center><a href="analysis.php"><button class="btn-lg btn-primary">Get Analysis</button></a></center>
								</div>
							</div>
						</div>
				</div>
		</div>
	</div>
</body>
</html>