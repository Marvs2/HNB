<?php
    session_start();
    include 'config.php';
    include 'query.php';
    $id = $_SESSION['id'];

    
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
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">-->
        <link rel="stylesheet" href="assets/css/smoothproducts.css">
        <link rel="stylesheet" href="css/user.css">
        <style>
            		.modal-image {
		max-width: 100%;
		max-height: 300px; /* Adjust the height as needed */
		display: block;
		margin: 0 auto;
		}
        </style>
    </head>
    
    <body style="background-image:url(&quot;assets/img/lugar.webp&quot;); background-size:cover;">
        <nav class="navbar navbar-light navbar-expand-lg fixed-top bg- #000d1a clean-navbar" style="background-color: #032030; height: 80px;">
            <div class="container">
                <a class="navbar-brand logo" href="#" style="font-family: Arial, sans-serif font-weight: bold; font-size:20px; color:white;">Himlayan ng Bayan</a>
                {{-- <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button> --}}
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php" style="font-size: 10px; color:white;">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="Aboutus3.php" style="font-size: 10px; color:white;">Deceased</a></li>
                        <li class="nav-item"><a class="nav-link" href="Aboutuser.php" style="font-size: 10px; color:white;">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="login_form.php" style="font-size: 10px; color:white;">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        &nbsp;
        &nbsp;

        <div class="container mt-4" style="padding-top: 100px;">

            
            <div>
                <div>
                    <div>
                            &nbsp;
                            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Deceased Person Details
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <table id="ohTable" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>Middlename</th>
                                                <th>Date of Birth</th>
                                                <th>Date of Death</th>
                                                <th>Grave No.</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $conn = mysqli_connect("localhost","root","","user_db");
                                                $query = "SELECT * FROM dperson";
                                                $query_run = mysqli_query($conn, $query);

                                            if(mysqli_num_rows($query_run) > 0 )
                                            {
                                                foreach($query_run as $dperson)
                                                {
                                                    $i = 1;
                                                    ?>
                                                    <tr>
                                                        <td><?= $dperson['firstname']; ?></td>
                                                        <td><?= $dperson['lastname']; ?></td>
                                                        <td><?= $dperson['middlename']; ?></td>
                                                        <td><?= $dperson['dofBirth']; ?></td>
                                                        <td><?= $dperson['dofDeath']; ?></td>
                                                        <td><?= $dperson['graveNo']; ?></td>
                                                        <td>
                                                            <form action="code.php" method="POST" class="d-inline">
                                                                <a class="btn btn-primary btn-sm viewSelection"
                                                                data-toggle="modal"
                                                                data-target="#displayPerson"
                                                                data-darea="Area: <?php echo ceil($dperson['graveNo'] / 60) ?>"
                                                                data-graveno="Graveyard: <?php echo $dperson['graveNo'] ?>"
                                                                data-name="<?php echo $dperson['firstname'] . ' ' . $dperson['lastname'] . ' ' . $dperson['middlename'] ?>"
                                                                data-death="<?php echo $dperson['dofDeath'] ?>"
                                                                data-birth="<?php echo $dperson['dofBirth'] ?>"
                                                                data-dareaImg="images/area<?php echo $i ?>.webp" href="#">View</a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                echo "<h5> No Record Found </h5>";
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <div class="modal" id="displayPerson">
				<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
					<h5 class="modal-title">Welcome to Graveyard</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<div class="modal-body">
					<span>
						<span id="darea"> </span>
					</span>
					<br> 	
					<span id="graveno"> </span>
					<br>
					<span>Deceased Name:
						<span id="name"> </span>
					</span>
					<br>
                    <span>Date of Birth:
						<span id="birth"> </span>
					</span>
					<br>
					<span>Date of Death:
						<span id="death"> </span>
					</span>
					<br>
					<img src="#" alt="area image" srcset="" id="img-links" class="modal-image">
					</div>

                    <div class="modal-footer">
                        <button id="closeModalBtns" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
				</div>
				</div>
			</div>
        </main>   
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        		<!-- MAIN -->                 
        <script>
            var viewButton = document.querySelectorAll(".viewSelection");
            viewButton.forEach(viewButton => {
                viewButton.addEventListener('click', function (e) {
                // Highlight the clicked viewButton as before
                document.querySelector("#darea").textContent = this.getAttribute('data-darea');
                document.querySelector("#graveno").textContent = this.getAttribute('data-graveno');
                document.querySelector("#name").textContent = this.getAttribute('data-name');
                document.querySelector("#birth").textContent = this.getAttribute('data-birth');
                document.querySelector("#death").textContent = this.getAttribute('data-death');
                document.querySelector("#img-links").src = this.getAttribute('data-dareaImg');
                var modal = new bootstrap.Modal(document.getElementById('displayPerson'));
            modal.show();
                });
            });

            var closeModalBtn = document.getElementById("closeModalBtns");

// Add a click event listener to the button
closeModalBtns.addEventListener("click", function() {
    // Perform the redirection to index2-view.php
    window.location.href = "Aboutus3.php";
});

            $(document).ready(function() {
                                            $('#ohTable').DataTable();
                                        });
        </script>
        	<script src="script2.js"></script>
                                        
                            </div>
                                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
                                    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
                        </div>
                    </div>         
                </div>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
