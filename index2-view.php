<?php
session_start();
include 'config.php';
// include 'check_session.php';
include 'query.php';
// Ensure session_start() is called at the very beginning
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_data = get_user_data($user_id);

    if ($user_data !== null) {
        $firstname = $user_data['firstname'];
        $lastname = $user_data['lastname'];
        // Additional user data can be accessed here
    } else {
        echo "No user data found!";
    }
} else {
    echo "User is not logged in!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<!-- style2.css in the root folder -->
<link rel="stylesheet" href="css\index2\css\styles.css">
<link rel="stylesheet" href="css\index2\css\style.css">
<style>
    	.modal-image {
		max-width: 100%;
		max-height: 300px; /* Adjust the height as needed */
		display: block;
		margin: 0 auto;
		}
</style>
	<title>Deceased Person 2d Plot</title>
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
					<span class="text">ADD Deceased Person</span>
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
			<a href="#" class="profile">
                <?php
                // Check if the user is logged in
                if (isset($firstname)) {
                    // Display user information if logged in
                    echo 'Welcome ' . $firstname . ' Admin';
                    // You can echo other user data fields as needed
                } else {
                    // Redirect to the login form if the user is not logged in
                    header("Location: login_form.php");
                    exit();
                }
            ?>
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
            <br>
            <div> <?php include('message.php'); ?></div>
            <br>
            <div class="table-data">
				<div class="order">
					<div class="head">
						<h3>View Deceased Person</h3>
                        <form action="" method="GET">
                            <div class="input-group mb-7" style="padding-bottom: 15px;">
                                <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search">
                                <button type="submit" class="btn btn-primary"><i class='bx bx-search'></i></button>
                            </div>
                        </form>
					</div>
					<table>
						<thead>
							<tr>
                                <th>Deceased Firstname</th>
                                <th>Deceased Lastname</th>
                                <th>Deceased Middlename</th>
                                <th>Date Birth</th>
                                <th>Date Death</th>
                                <th>Grave no.</th>
                                <th> </th>
							</tr>
						</thead>
                        <?php 
                        $conn = mysqli_connect("localhost","root","","user_db");
            
                            if(isset($_GET['search']))
                            {
                                $filtervalues = $_GET['search'];
                                $query = "SELECT * FROM dperson WHERE CONCAT(firstname,lastname,middlename,dofBirth,dofDeath,graveNo) LIKE '%$filtervalues%' ";

                                $query_run = mysqli_query($conn, $query);
            
                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    foreach($query_run as $items)
                                {
                                    $i = 1;
                        ?>
						<tbody>
                            <tr>
                                <td><?= $items['firstname']; ?></td>
                                <td><?= $items['lastname']; ?></td>
                                <td><span><?= $items['middlename']; ?></span></td>
                                <td><span><?= $items['dofBirth']; ?></span></td>
                                <td><span><?= $items['dofDeath']; ?></span></td>
                                <td><span><?= $items['graveNo']; ?></span></td>
                                <td>
                                <form action="code.php" method="POST" class="d-inline">
    <a class="btn btn-primary btn-sm viewSelection"
    data-toggle="modal"
    data-target="#displayPerson"
    data-darea ="Area: <?php echo ceil($items['graveNo'] / 60) ?>"
    data-graveno ="Graveyard: <?php echo $items['graveNo'] ?>"
    data-name="<?php echo $items['firstname'] . ' ' . $items['lastname'] . ' ' . $items['middlename'] ?>"
    data-death="<?php echo $items['dofDeath'] ?>"
    data-birth="<?php echo $items['dofBirth'] ?>"
    data-dareaImg="images/area<?php echo $i ?>.webp" href="#">View</a>

    <a href="edit.php?id=<?= $items['id']; ?>" class="btn btn-success btn-sm">Edit</a>
    <a href="delete.php?id=<?php echo $items['id']; ?>" class="btn btn-danger btn-sm del-btn" style="background-color: rgb(221, 67, 67); color: aliceblue;">Delete</a>
                                </form>
                                </td>
                            </tr>
                        <?php
                                }
                            }
                            else
                                {
                        ?>
                            <tr>
                                <td colspan="4">No Record Found</td>
                            </tr>
                        <?php
                                }
                            }
                        ?>
							
						</tbody>
                        <?php
// Your PHP code to check if the 'm' parameter is set in the URL and display the success message
if (isset($_GET['m'])) {
?>
    <div class="flash-data" data-flashdata="<?php echo $_GET['m']; ?>"></div>
<?php
}
?>

<!-- JavaScript code to handle delete and success message -->
<script>
    // Delete button event handling
    $(document).on('click', '.del-btn', function(event) {
        event.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete page if user confirms
                document.location.href = href;
            }
        });
    });

    // Show success message if the 'm' parameter is set in the URL
    const flashdata = $('.flash-data').data('flashdata');
    if (flashdata) {
        Swal.fire({
            icon: 'success',
            title: 'Record Deleted',
            text: 'Record has been deleted'
        });
    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
					</table>
				</div>
			</div>
            
            <div class="table-data">
				<div class="order">
					<div class="head">
						<h3>List of the Deceased</h3>
					</div>
					<table>
						<thead>
							<tr>
                                <th>Deceased Firstname</th>
                                <th>Deceased Lastname</th>
                                <th>Deceased Middlename</th>
                                <th>Date of Birth</th>
                                <th>Date of Death</th>
                                <th>Grave no.</th>
                                <th> </th>
							</tr>
						</thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM dperson ";
                            $query_run = mysqli_query($conn, $query);
                            $i = 1;
                            if(mysqli_num_rows($query_run) > 0 )
                            {
                                foreach($query_run as $items)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $items['firstname']; ?></td>
                                        <td><?= $items['lastname']; ?></td>
                                        <td><?= $items['middlename']; ?></td>
                                        <td><?= $items['dofBirth']; ?></td>
                                        <td><?= $items['dofDeath']; ?></td>
                                        <td><?= $items['graveNo']; ?></td>
                                        <td>
                                        <form action="code.php" method="POST" class="d-inline">
                                            
                                        <a class="btn btn-primary btn-sm viewSelection"
                                        data-toggle="modal"
                                        data-target="#displayPerson"
                                        data-darea="Area: <?php echo ceil($items['graveNo'] / 60) ?>"
                                        data-graveno="Graveyard: <?php echo $items['graveNo'] ?>"
                                        data-name="<?php echo $items['firstname'] . ' ' . $items['lastname'] . ' ' . $items['middlename'] ?>"
                                        data-death="<?php echo $items['dofDeath'] ?>"
                                        data-birth="<?php echo $items['dofBirth'] ?>"
                                        data-dareaImg="images/area<?php echo $i ?>.webp" href="#">View</a>
                                        <a href="edit.php?id=<?= $items['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a href="delete.php?id=<?php echo $items['id']; ?>" class="btn btn-danger btn-sm del-btn" style="background-color: rgb(221, 67, 67); color: aliceblue;">Delete</a>
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
				</div>
			</div>

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
                        <button id="closeModalBtn" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

            var closeModalBtn = document.getElementById("closeModalBtn");

// Add a click event listener to the button
closeModalBtns.addEventListener("click", function() {
    // Perform the redirection to index2-view.php
    window.location.href = "index2-view.php";
});

            $(document).ready(function() {
                                            $('#ohTable').DataTable();
                                        });
        </script>

                      <!-- Add the SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>    
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        
	</section>
	<!-- CONTENT -->
	

	<script src="script2.js"></script>
</body>
</html>