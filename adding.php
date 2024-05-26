<?php
session_start();
include 'config.php'; // Include the config file to define $conn
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

$fname = $lname = $mname = $dofBirth = $dofDeath = $graveNo = "";
$fnameErr = $lnameErr = $mnameErr = $dofBirthErr = $dofDeathErr = $graveNoErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input data
    $fname = trim($_POST['firstname']);
    $lname = trim($_POST['lastname']); 
    $mname = trim($_POST['middlename']);
    $dofBirth = trim($_POST['dofBirth']);
    $dofDeath = trim($_POST['dofDeath']);
    $graveNo = trim($_POST['graveNo']);

    // Validate the input fields
    if (empty($fname)) {
        $fnameErr = "First name is required";
    }

    if (empty($lname)) {
        $lnameErr = "Last name is required";
    }

    // Check the validity of graveNo and uniqueness using the isUniquegraveNo() function
    if (!is_numeric($graveNo) || $graveNo > 540) {
        $_SESSION['message'] = "Please enter a valid graveNo less than or equal to 540.";
        header("Location: add.php");
        exit();
    }
    
    // Check if graveNo already exists using MySQLi
$query = "SELECT * FROM dperson WHERE graveNo = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param('i', $graveNo); // 'i' indicates the parameter is an integer
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc(); // Use fetch_assoc() to get a single row

    if ($result) {
        $_SESSION['message'] = "graveNo already exists. Please enter a unique graveNo.";
        header("Location: add.php");
        exit();
    }
} else {
    die("Query preparation failed: " . $conn->error);
}

    // Continue with other input field validations...

// Check if there are any errors before inserting the data
if (empty($fnameErr) && empty($lnameErr) && empty($mnameErr) && empty($dofBirthErr) && empty($dofDeathErr) && empty($graveNoErr)) {
    // Insert the data into the database using MySQLi prepared statement
    $query = "INSERT INTO dperson (firstname, lastname, middlename, dofBirth, dofDeath, graveNo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // 'sssssi' indicates that all parameters are strings except for graveNo, which is an integer
        $stmt->bind_param('sssssi', $fname, $lname, $mname, $dofBirth, $dofDeath, $graveNo);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Deceased Person Added Successfully";
            header("Location: add.php");
            exit();
        } else {
            $_SESSION['message'] = "Deceased Person Added Failed";
            header("Location: add.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Error in the database query.";
        header("Location: add.php");
        exit();
    }
}
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
    <style>
		.container {
			height: 100vh;
			display: flex;
			align-items: center;
		}
		.column {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}
		.btn-grid {
			display: grid;
			grid-template-columns: 1fr;
			grid-template-rows: repeat(4, auto);
			gap: 10px;
		}
        .btn {
            width: 200px; /* Adjust the width as needed */
        }
	</style>
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
			<li class="active">
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
            <div class="table-data">
                <div class="order">
                    <div class="container">
                        <div class="row">
                            <!-- First Column -->
                            <div class="col-md-6 column">
                                <div class="btn-grid">
                                    <button class="btn btn-primary">Button 1</button>
                                    <button class="btn btn-primary">Button 2</button>
                                    <button class="btn btn-primary">Button 3</button>
                                    <button class="btn btn-primary">Button 4</button>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-6 column">
                                <div class="btn-grid">
                                    <button class="btn btn-secondary">Button 5</button>
                                    <button class="btn btn-secondary">Button 6</button>
                                    <button class="btn btn-secondary">Button 7</button>
                                    <button class="btn btn-secondary">Button 8</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <!-- Bootstrap JS and dependencies -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="script2.js"></script>
</body>
</html>