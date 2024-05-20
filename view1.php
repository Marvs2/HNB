<?php
require 'config.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Himlayan ng Bayan</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
        <link rel="stylesheet" href="assets/css/smoothproducts.css">
        <link rel="stylesheet" href="css/user.css">
    </head>
    
<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
            <div class="container"><a class="navbar-brand logo" href="#">Himlayan ng Bayan</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="service.php">Services</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="Aboutus3.php">Deceased</a></li>
                        <li class="nav-item"><a class="nav-link" href="#footer">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="login_form.php">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <br>
    <br>
    <br>    
    <div class="container mt-5">

        <?php include('message.php'); ?>  

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Deceased Details 
                            <a href="Aboutus3.php" class="btn btn-info btn-sm" style="float:right;">BACK</a>
                        </h4>
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
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>