<?php  
session_start();
include 'config.php';
include 'query.php';
include 'check_session.php';
 ?> 

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<!-- My CSS -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css\index2\css\style2.css">
	<link rel="stylesheet" href="css\index2\css\style.css">

	<title>Accept People Who are registering</title>
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
			<li>
				<a href="index2-view.php">
					<i class='bx bx-street-view'></i>
					<span class="text">View</span>
				</a>
			</li>
			<li class="active">
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

$user_data = get_user_data(1); // Pass the position value directly
					if ($user_data !== null) {
						echo $user_data['firstname'];
					} else {
						echo "Connection is null!";
					}
                ?>
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="table-data">
				<div class="todo">
					<section class="jumbotron text-center">
						<div class="container">
							<?php
// Establish connection to the database
$conn = mysqli_connect("localhost", "root", "", "user_db");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function fetchReq($query, $conn) {
    $result = mysqli_query($conn, $query);
    $all = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all;
}

$query = "SELECT * FROM requests";
$results = fetchReq($query, $conn);
if(count($results) > 0) {
    foreach($results as $row) {
        ?>
        <h1 class="jumbotron-heading"><?php echo $row['email'] ?></h1>
        <p class="lead text-muted"><?php echo $row['message'] ?></p>
        <p>
            <a href="accept.php?id=<?php echo $row['id'] ?>" class="btn-accept">Accept</a>
            <a href="reject.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm btn-delete" style="background-color: rgb(221, 67, 67); color: aliceblue;">Reject</a>
        </p>
        <small><i><?php echo $row['date'] ?></i></small>
        <?php
    }
} else {
    echo "No Pending Requests.";
}
?>

						  
						</div>
						<?php
if (isset($_GET['m'])) {
?>
    <div class="flash-data" data-flashdata="<?php echo $_GET['m']; ?>"></div>
<?php
}
?>

<!-- JavaScript code to handle delete and success message -->
<script>
    // Delete button event handling
    $(document).on('click', '.btn-delete', function(event) {
        event.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure you want to reject it?',
            text: "You won't be able to revert this action!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Reject it!'
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
            title: 'Record Rejected',
            text: 'Request has been rejected'
        });
    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
					  </section>
				
					</main>
				
				
					<!-- Bootstrap core JavaScript
					================================================== -->
					<!-- Placed at the end of the document so the pages load faster -->
					<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
					<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
					<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="script2.js"></script>
</body>
</html>