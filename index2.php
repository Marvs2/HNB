<?php 
session_start();
include 'config.php';
include 'query.php';
if (isset($_SESSION["password"]) != true){
	header("location: login_form.php");
	exit(); // Ensure no further code execution after redirect
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css\index2\css\style2.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="css\index2\css\style.css">

	<title>Deceased Person - Dashboard</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="index2.php" class="brand">
			<i class=''><b> HNB </b></i>
			<span class="text" style="padding-left: 15px;"> Himlayan ng Bayan</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="index2.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="location.php">
					<i class='bx bxs-edit-location' ></i>
					<span class="text">Location</span>
				</a>
			</li>
			<li>
				<a href="add.php">
					<i class='bx bx-folder-plus'></i>
					<span class="text">ADD Deceased Person</span>
				</a>
			</li>
			<li>
				<a href="index2-view.php">
					<i class='bx bx-street-view'></i>
					<span class="text">View</span>
				</a>
			</li>
			<li>
				<a href="list.php">
					<i class='bx bx-list-ul'></i>
					<span class="text">Request</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'> </i>
			<a href="#" class="profile" style="float:right;">
				<?php
					$user_data = get_user_data(1); // Pass the position value directly
					if ($user_data !== null) {
						echo $user_data['firstname'];
					} else {
						echo "Connection is null!";
					}
					// Usage in your code

				?>
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check'></i>
					<span class="text">
						<?php echo $dpersons_count; ?>
						<p>Deceased Counts: <?php echo $dpersons_count; ?></p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group'></i>
					<span class="text">
						<?php echo $requests_count; ?>
						<p>Requests: <?php echo $requests_count; ?></p>
					</span>
				</li>
			</ul>

			<div class="table-data">
				<div class="order">
					<table>
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$dataPoints = array(); // Initialize an empty array to store data
							
							$conn = mysqli_connect("localhost", "root", "", "user_db");
							$query = "SELECT * FROM dperson ORDER BY graveNo ASC";
							
							$query_run = mysqli_query($conn, $query);
							
							$count = 0;
							while ($row = mysqli_fetch_assoc($query_run)) {
								// Build the data array with fname, lname, and mname in graveno
								$dataPoints[$count]['label']=$row['firstname'] . ' ' . $row['lastname'];
								$dataPoints[$count]['y']=(float)$row['graveNo'];
								$count=$count+1;
							}
							?>
							
							<script>
							window.onload = function() {
								var chart = new CanvasJS.Chart("chartContainer", {
									animationEnabled: true,
									theme: "light2",
									title: {
										text: "Grave Track"
									},
									axisY: {
										title: "Grave (#)"
									},
									data: [{
										type: "column",
										yValueFormatString: " Grave #",
										dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
									}]
								});
								chart.render();
							}
							</script>
							<div id="chartContainer" style="height: 370px; width: 100%;"></div>
							<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="container">
								<!-- single canvas node to render the chart -->
								<canvas
								  id="myChart"
								  width="350"
								  height="500"
								  aria-label="chart"
								  role="img"
								></canvas>
					</div>
					<script src="js/chart.js"></script>
					<script src="js/custom.js"></script>	
				
				</div>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script2.js"></script>
</body>
</html>
