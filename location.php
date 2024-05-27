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
			<div>
				<input type="text" id="searchInput" placeholder="Search...">
			</div>
			    <!-- Your HTML content here -->

    <!-- Your PHP code to fetch graveyard data and display -->
    <?php
    $dpersons = getDperson($conn); // Pass $conn to the getDperson() function

    echo '<div class="area-grid">';
    for ($i = 1; $i <= 9; $i++) {
        echo '<div class="area"> Area: ' . $i;
        echo '<div class="graveyard-grid" data-toggle="modal" data-target="#viewDperson">';
        for ($j = 1; $j <= 60; $j++) {
            $matchedGraveyard = false;
            foreach ($dpersons as $dperson) {
                if (($j + (($i - 1) * 60)) == $dperson['graveNo']) {
                    echo '<div class="graveyard bg-primary" 
                            data-darea="Area: ' . $i . '"
                            data-graveno="Graveyard: ' . $j . '" 
                            data-name="' . $dperson['firstname'] . ' ' . $dperson['lastname'] . ' ' . $dperson['middlename'] . ' " 
                            data-death="' . $dperson['dofDeath'] . '" 
                            data-birth="' . $dperson['dofBirth'] . '"
                            data-buried="' . $dperson['dofBuried'] . '"
                            data-yearspent="' . $dperson['yearspent'] . '"
                            data-monthspent="' . $dperson['monthspent'] . '"
                            data-dayspent="' . $dperson['dayspent'] . '"
                            data-status="' . $dperson['status'] . '"
                            data-dareaImg="images/area' . $i . '.webp"
                            value="' . $j + ($i - 1) * 60 . '"> GY#: ' . $j + ($i - 1) * 60 . '</div>';
                    $matchedGraveyard = true;
                    break; // Exit the inner loop once a match is found
                }
            }
            if (!$matchedGraveyard) {
                echo '<div class="graveyard" data-darea="Area: ' . $i . '" data-graveno="Graveyard: ' . $j . '" value="' . $j + ($i - 1) * 60 . '" data-dareaImg="images/area' . $i . '.webp"> GY#: ' . $j + ($i - 1) * 60 . '</div>';
            }
        }
        echo '</div>'; // Close the graveyard-grid div
        echo '</div>'; // Close the area div
    }
    echo '</div>'; // Close the area-grid div
    ?>

    <!-- Your modal HTML code -->
    <!-- Modal HTML code -->
    <div class="modal" id="viewDperson">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Welcome to Graveyard</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span>
                        <span id="darea"></span>
                    </span>
                    <br>
                    <span id="graveno"></span>
                    <br>
                    <span>Deceased Name:
                        <span id="name"></span>
                    </span>
                    <br>
                    <span>Date of Birth:
                        <span id="birth"></span>
                    </span>
                    <br>
                    <span>Date of Death:
                        <span id="death"></span>
                    </span>
                    <br>
                    <span>Date of Buried:
                        <span id="buried"></span>
                    </span>
                    <br>
                    <span>Status:
                        <span id="status"></span>
                    </span>
                    <br>
                    <span>Year Spent in grave:
                        <span id="yearspent"></span>Y / <span id="monthspent"></span>M / <span id="dayspent"></span>D
                    </span>
                    <br>
                    <div id="warning-message" style="display: none;">
                        <div id="alert" class="alert" role="alert">
                            <!-- Message will be added dynamically -->
                        </div>
                    </div>
                    <img src="#" alt="area image" id="img-link" class="modal-image">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include your JavaScript files here -->
    <script src="path/to/jquery.js"></script>
    <script src="path/to/bootstrap.js"></script>
    
    <script>
        function showModal(event) {
            var graveyard = event.currentTarget;

            document.getElementById('darea').textContent = graveyard.getAttribute('data-darea');
            document.getElementById('graveno').textContent = graveyard.getAttribute('data-graveno');
            document.getElementById('name').textContent = graveyard.getAttribute('data-name');
            document.getElementById('birth').textContent = graveyard.getAttribute('data-birth');
            document.getElementById('death').textContent = graveyard.getAttribute('data-death');
            document.getElementById('buried').textContent = graveyard.getAttribute('data-buried');
            document.getElementById('status').textContent = graveyard.getAttribute('data-status');
            document.getElementById('yearspent').textContent = graveyard.getAttribute('data-yearspent');
            document.getElementById('monthspent').textContent = graveyard.getAttribute('data-monthspent');
            document.getElementById('dayspent').textContent = graveyard.getAttribute('data-dayspent');
            document.getElementById('img-link').src = graveyard.getAttribute('data-dareaImg');

            var yearspent = parseInt(graveyard.getAttribute('data-yearspent'));
            var year_left = 3 - yearspent;

            var alertDiv = document.getElementById('alert');
            var warningMessageDiv = document.getElementById('warning-message');

            warningMessageDiv.style.display = 'block';

            if (yearspent === 0) {
                alertDiv.className = 'alert alert-success';
                alertDiv.textContent = 'This grave is freshly buried. Only ' + year_left + ' years left.';
            } else if (yearspent === 1) {
                alertDiv.className = 'alert alert-info';
                alertDiv.textContent = 'This grave has ' + year_left + ' years left.';
            } else if (yearspent === 2) {
                alertDiv.className = 'alert alert-warning';
                alertDiv.textContent = 'Warning: Only ' + year_left + ' year left!';
            } else if (yearspent === 3) {
                alertDiv.className = 'alert alert-danger';
                alertDiv.textContent = 'Alert: This grave has been removed.';
            } else {
                warningMessageDiv.style.display = 'none';
            }
        }

        document.querySelectorAll('.graveyard').forEach(function (graveyard) {
            graveyard.addEventListener('click', showModal);
        });

        // Calculate remaining years left for each graveyard
        var graveyards = document.querySelectorAll('.graveyard');
        graveyards.forEach(function(graveyard) {
            var yearspent = parseInt(graveyard.getAttribute('data-yearspent'));
            var year_left = 3 - yearspent;

            if (yearspent === 0) {
                graveyard.classList.add('freshly-buried');
            } else if (yearspent === 2) {
                graveyard.classList.add('warning');
            } else if (yearspent === 3) {
                graveyard.classList.add('removed');
            }
        });
    </script>

    <script>
        var searchInput = document.getElementById("searchInput");
        var graveyards = document.querySelectorAll(".graveyard");
        var viewDpersonModal = document.getElementById("viewDperson");

        searchInput.addEventListener('input', function (e) {
            var searchText = e.target.value.toLowerCase();
            graveyards.forEach(graveyard => {
                var name = graveyard.getAttribute('data-name').toLowerCase();
                var area = graveyard.getAttribute('data-darea').toLowerCase();
                var graveno = graveyard.getAttribute('data-graveno').toLowerCase();
                var graveKey = area + graveno;

                if (name.includes(searchText) || graveKey.includes(searchText)) {
                    graveyard.classList.add("highlight");
                } else {
                    graveyard.classList.remove("highlight");
                }
            });

            // Remove the highlight class from the modal when searching
            viewDpersonModal.classList.remove("highlight-modal");
        });
    </script>
			<input type="text" id="selected">
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
</body>
</html>