<?php 
session_start();
include 'config.php';
include 'query.php';
// include 'check_session.php';
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

	<!-- Boxicons -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css\index2\css\styles.css">
	<link rel="stylesheet" href="css\index2\css\style.css">
	<style>
		.highlight {
			border: 2px solid red;
			/* You can customize the style for highlighting */
		}
		.graveyard-grid {
			pointer-events: none;
		}
		.graveyard bg-primary {
			pointer-events:fill;
		}
		.graveyard{
			pointer-events: visible;
		}
		.modal-image {
		max-width: 100%;
		max-height: 300px; /* Adjust the height as needed */
		display: block;
		margin: 0 auto;
		}
	</style>
	<title>Deceased Person Location</title>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="index2.php" class="brand">
			<span class="text" style="padding-left: 15px;"> Himlayan ng Bayan</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="index2.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
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
					<span class="text">List</span>
				</a>
			</li>
            <li>
                <a href="messages.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="text">Messages</span>
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
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
</body>
</html>