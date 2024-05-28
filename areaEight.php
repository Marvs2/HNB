<?php
session_start();
include 'config.php'; // Include the config file to define $conn
include 'query.php'; // Include the query file

function showNotification($title, $text, $icon) {
    echo "<script type='text/javascript'>showNotification('$title', '$text', '$icon');</script>";
}

// Ensure session_start() is called at the very beginning
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_data = get_user_data($user_id);

    if ($user_data !== null) {
        $firstname = $user_data['firstname'];
        $lastname = $user_data['lastname'];
    } else {
        showNotification('Error', 'No user data found!', 'error');
        exit();
    }
} else {
    showNotification('Error', 'User is not logged in!', 'error');
    exit();
}

// Check connection
if ($conn->connect_error) {
    showNotification('Error', 'Connection failed: ' . $conn->connect_error, 'error');
    exit();
}

// Fetch the last dpNum value from the database to determine the starting point
$result = $conn->query("SELECT dpNum FROM areano1 ORDER BY dpNum DESC LIMIT 1");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastDpNum = intval(substr($row['dpNum'], 2)); // Get the numeric part of the dpNum
} else {
    $lastDpNum = 999; // Start from Dp1000 if no records are found
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstnames = $_POST['firstname'];
    $lastnames = $_POST['lastname'];
    $middlenames = $_POST['middlename'];
    $graveNos = $_POST['graveNo'];
    $dateofBirths = $_POST['dateofBirth'];
    $dateofBurieds = $_POST['dateofBuried'];
    $statuses = $_POST['status'];
    $statCols = $_POST['statCol'];
    $areaNos = $_POST['areaNo'];
    $graveTypes = $_POST['graveType'];
    $buriedStatuses = $_POST['buriedStatus'];
    $dateOfDeaths = $_POST['dateOfDeath'];
    $maintenanceStatuses = $_POST['maintenanceStatus'];
    $lastMaintenanceDates = $_POST['lastMaintenanceDate'];

    $sql = "INSERT INTO `areano1` (`dpNum`, `firstname`, `lastname`, `middlename`, `graveNo`, `dateofBirth`, `dateofBuried`, `status`, `statCol`, `areaNo`, `graveType`, `buriedStatus`, `dateOfDeath`, `maintenanceStatus`, `lastMaintenanceDate`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $allRecordsInserted = true;

    foreach ($firstnames as $index => $firstname) {
        $dpNum = 'Dp' . (++$lastDpNum);
        $lastname = $lastnames[$index];
        $middlename = $middlenames[$index];
        $graveNo = $graveNos[$index];
        $dateofBirth = $dateofBirths[$index];
        $dateofBuried = $dateofBurieds[$index];
        $status = $statuses[$index];
        $statCol = $statCols[$index];
        $areaNo = $areaNos[$index];
        $graveType = $graveTypes[$index];
        $buriedStatus = $buriedStatuses[$index];
        $dateOfDeath = $dateOfDeaths[$index];
        $maintenanceStatus = $maintenanceStatuses[$index];
        $lastMaintenanceDate = $lastMaintenanceDates[$index];

        $stmt->bind_param("sssssssisssssss", $dpNum, $firstname, $lastname, $middlename, $graveNo, $dateofBirth, $dateofBuried, $status, $statCol, $areaNo, $graveType, $buriedStatus, $dateOfDeath, $maintenanceStatus, $lastMaintenanceDate);

        if (!$stmt->execute()) {
            showNotification('Error', "Error: " . $stmt->error, 'error');
            $allRecordsInserted = false;
            break;
        }
    }

    if ($allRecordsInserted) {
        showNotification('Success', 'New record created successfully', 'success');
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/index2/css/style2.css">
    <link rel="stylesheet" href="css/index2/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .form-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-container label {
            display: block;
            margin-top: 10px;
        }
        .form-container input,
        .form-container select {
            width: 100%;
            padding: 5px;
        }
        .form-container .full-width {
            grid-column: span 2;
        }
        .form-container button,
        .form-container input[type="submit"] {
            margin-top: 20px;
        }
    </style>
       <script>
        function syncDates() {
            var dateOfBuried = document.getElementsByName('dateofBuried[]')[0];
            var lastMaintenanceDate = document.getElementsByName('lastMaintenanceDate[]')[0];
            lastMaintenanceDate.value = dateOfBuried.value;
        }

        function showNotification(title, text, icon) {
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showConfirmButton: true,
                timer: 3000
            });
        }
    </script>
    <title>Deceased Person Create</title>
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
                <!-- Nested list -->
                <ul>
                    <li>
                        <a href="areaOne.php">Add in Area 1</a>
                    </li>
                    <li>
                        <a href="#">Add in Area 2</a>
                    </li>
                    <li>
                        <a href="#">Add in Area 3</a>
                    </li>
                    <li>
                        <a href="#">Add in Area 4</a>
                    </li>
                    <li>
                        <a href="#">Add in Area 5</a>
                    </li>
                    <li>
                        <a href="#">Add in Area 6</a>
                    </li>
                    <li>
                        <a href="#">Add in Area 7</a>
                    </li>
                    <li class="active">
                        <a href="#">Add in Area 8</a>
                    </li>
                    <!-- Add more nested list items as needed -->
                </ul>
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

    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
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

        <main>
            <div class="table-data">
                <div class="order">
                    <div class="container">
                        <form action="" method="POST">
                            <div id="recordContainer">
                                <div class="record form-container">
                                    <div>
                                        <label for="firstname">First Name:</label>
                                        <input type="text" name="firstname[]" required>
                                    </div>
                                    <div>
                                        <label for="lastname">Last Name:</label>
                                        <input type="text" name="lastname[]" required>
                                    </div>
                                    <div>
                                        <label for="middlename">Middle Name:</label>
                                        <input type="text" name="middlename[]" required>
                                    </div>
                                    <div>
                                        <label for="graveNo">Grave Number:</label>
                                        <input type="text" name="graveNo[]" required>
                                    </div>
                                    <div>
                                        <label for="dateofBirth">Date of Birth:</label>
                                        <input type="date" name="dateofBirth[]" required>
                                    </div>
                                    <div>
                                        <label for="dateOfDeath">Date of Death:</label>
                                        <input type="date" name="dateOfDeath[]" required>
                                    </div>
                                    <div>
                                        <label for="dateofBuried">Date of Buried:</label>
                                        <input type="date" name="dateofBuried[]" required onchange="syncDates()">
                                    </div>
                                    <div>
                                        <label for="status">Status (1 for active, 0 for inactive):</label>
                                        <input type="number" name="status[]" min="0" max="1" value="1" readonly>
                                    </div>
                                    <div>
                                        <label for="statCol">Status Color:</label>
                                        <input type="text" name="statCol[]" value="blue" required>
                                    </div>
                                    <div>
                                        <label for="areaNo">Area Number:</label>
                                        <input type="text" name="areaNo[]" value="1" readonly>
                                    </div>
                                    <div>
                                        <label for="graveType">Grave Type:</label>
                                        <select name="graveType[]" required>
                                            <option value="Single">Single</option>
                                            <option value="Double">Double</option>
                                            <option value="House">House</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="buriedStatus">Buried Status:</label>
                                        <select name="buriedStatus[]" required>
                                            <option value="Burial">Burial</option>
                                            <option value="Cremation">Cremation</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="full-width">
                                        <label for="maintenanceStatus">Maintenance Status:</label>
                                        <input type="text" name="maintenanceStatus[]" value="New" required readonly>
                                    </div>
                                    <div class="full-width">
                                        <label for="lastMaintenanceDate">Last Maintenance Date:</label>
                                        <input type="date" name="lastMaintenanceDate[]" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="addRecord()">Add Another Record</button><br><br>
                            <input type="submit" class="btn btn-success" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
    <script>
        function addRecord() {
            var container = document.getElementById('recordContainer');
            var newRecord = container.querySelector('.record').cloneNode(true);
            container.appendChild(newRecord);
        }
    </script>
</main>
<!-- MAIN -->
</section>
<!-- CONTENT -->
<script src="script2.js"></script>
</body>
</html>
