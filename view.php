<?php
session_start();
include('config.php');
include('query.php');
include('check_session.php');

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>    
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<title>Deceased Person Create</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="index2.php" class="brand">
			<i class=''><b> HNB </b></i>
			<span class="text" style="padding-left: 15px;"> Himlayan ng Bayan</span>
		</a>
		<ul class="side-menu top">
			<li>
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
					<span class="text">ADD</span>
				</a>
			</li>
			<li class="active">
				<a href="index2-view.php">
					<i class='bx bx-street-view'></i>
					<span class="text">View</span>
				</a>
			</li>
			<li>
				<a href="list.php">
					<i class='bx bx-list-ul'></i>
					<span class="text">Team</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bx-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
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
			<a href="#" class="profile">
				<?php
                    $user_data = get_user_data(1);
                    if ($user_data == 1) {
                        echo $_SESSION['firstname'];
                    }else {
                        echo $_SESSION['firstname'];
                    }
                ?>
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
            <div class="card-header">
                <h2>Deceased Details - View</h2><span><h3><a href="index2-view.php" class="btn btn-primary float-end" style="float: right;">BACK</a></h3></span>
            </div>
            <br>
            <div> <?php include('message.php'); ?></div>
            <br>
                <div class="table-data">
                    <div class="order">
                        <div action="code.php" class="head">
                            <h3>Deceased Details</h3>
                        </div>
                        <div class="card-body">

                            <?php
							  
							  if (isset($_GET['id'])) {
							  $dperson_id = $_GET['id'];
							
							  $query = "SELECT * FROM dperson WHERE id = :id";
							  $stmt = $conn->prepare($query);
							  $stmt->bindParam(':id', $dperson_id);
							  $stmt->execute();
							
							  if ($stmt->rowCount() > 0) {
								$dperson = $stmt->fetch(PDO::FETCH_ASSOC);
								?>
								<div class="mb-3">
								<label>First Name: </label>
								<span><?= $dperson['firstname']; ?></span>
								</div>
								<br>
								<div class="mb-3">
								<label>Last Name: </label>
								<span><?= $dperson['lastname']; ?></span>
								</div>
								<br>
								<div class="mb-3">
								<label>Middle Name: </label>
								<span><?= $dperson['middlename']; ?></span>
								</div>
								<br>
								<div class="mb-3">
								<label>Date of Birth: </label>
								<span>
								<?= $dperson['dofBirth']; ?>
								</span>
								</div>
								<br>
								<div class="mb-3">
								<label>Date of Death: </label>
								<span>
								<?= $dperson['dofDeath']; ?>
								</span>
								</div>
								<br>
								<div class="mb-3">
								<label>Grave no. : </label>
								<span>
								<?= $dperson['graveNo']; ?>
								</span>
								</div>
								<?php
								} else {
								echo "<h4>No Such Id Found</h4>";
								}
							}
							?>
							
                        </div>
                    </div>
			    </div>
        </main>   
    <!-- MAIN -->                
        
	</section>
	<!-- CONTENT -->
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="script2.js"></script>
</body>
</html>