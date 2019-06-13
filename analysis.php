<?php
	include 'db.php';
	$check = 0;
	if (!isset($_SESSION['email'])) {
		header('Location: index.php');
	}
	$id = $_SESSION['user_id'];
	


?>

<!DOCTYPE html>
<html>
<head>
	<title>Analysis</title>
	<link href="https://canvasjs.com/assets/css/jquery-ui.1.11.2.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/flatly/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>

</head>



<script>

</script>
<body>
	<?php include 'nav.html'; ?>

<div class="container">
	<div class="row mt-5" style="width: 100%">
		<div class="col-md-4">
			<h3 class="mt-5">Analysis of Sem1</h3>
		</div>
		<div class="col-md-8">
			<canvas id="sem1"></canvas>
		</div>
		<div class="col-md-4 mt-5">
			<h3 class="mt-5">Analysis of sem2</h3>
		</div>
		<div class="col-md-8 mt-5">
			<canvas id="sem2"></canvas>
		</div>
	</div>
</div>

<script>
var id = '<?php echo($id); ?>'; 
$.ajax({
	url: 'sem_data.php',
	type: 'POST',
	data: {'id': id,'table_name':'sem1'},
	success: (data)=>{
	if (data != 0) {
			values = data.split(',');
			graph('sem1',values,'bar')
	}else{
		console.log('Nooo Data');
		graph('sem1',[0,0,0,0],'bar')

	}
	}
})

$.ajax({
	url: 'sem_data.php',
	type: 'POST',
	data: {'id': id,'table_name':'sem2'},
	success: (data)=>{
	if (data != 0) {
			values = data.split(',');
			graph('sem2',values,'pie')
	}else{
		console.log('Nooo Data');
		graph('sem1',[0,0,0,0],'bar')
	}
	}
})

function graph(element,values,chartType) {
	var ctx = document.getElementById(element).getContext('2d');
			var myChart = new Chart(ctx, {
			    type: chartType,
			    data: {
			        labels: ['Subject 1', 'Subject 2', 'Subject 3', 'Subject 4'],
			        datasets: [{
			            label: 'Analysis of '+element,
			            data: values,
			            backgroundColor: [
			                'rgba(255, 99, 132, 0.2)',
			                'rgba(54, 162, 235, 0.2)',
			                'rgba(255, 206, 86, 0.2)',
			                'rgba(255, 159, 64, 0.2)'
			            ],
			            borderColor: [
			                'rgba(255, 99, 132, 0.2)',
			                'rgba(54, 162, 235, 0.2)',
			                'rgba(255, 206, 86, 0.2)',
			                'rgba(255, 159, 64, 0.2)'
			            ],
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero: true
			                }
			            }]
			        }
			    }
			});
}
</script>
</body>
</html>