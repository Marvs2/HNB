<?php  
session_start();
include 'config.php';
include 'query.php';

// Ensure session_start() is called at the very beginning
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_data = get_user_data($user_id);

    if ($user_data !== null) {
        $admin_id = $user_data['id'];
        $firstname = $user_data['firstname'];
        $lastname = $user_data['lastname'];
        // Additional user data can be accessed here
    } else {
        echo "No user data found!";
        exit();
    }
} else {
    echo "User is not logged in!";
    exit();
}





// Function to insert admin response
function insert_admin_response($conn, $message_id, $admin_id, $response_message, $response_date) {
    // Prepare the SQL statement
    $sql = "INSERT INTO admin_responses (message_id, admin_id, response_message, response_date) VALUES (?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "iiss", $message_id, $admin_id, $response_message, $response_date);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Insertion successful
        mysqli_stmt_close($stmt);
        return true;
    } else {
        // Insertion failed
        mysqli_stmt_close($stmt);
        return false;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $message_id = $_POST['message_Id'];
    $admin_id = $_SESSION['user_id']; // Use session user_id as admin_id
    $response_message = $_POST['response_message'];
    $response_date = date("Y-m-d"); // Current date

    // Call the function to insert data into the admin_responses table
    if (insert_admin_response($conn, $message_id, $admin_id, $response_message, $response_date)) {
        // Insertion successful
        $response_status = "Data inserted successfully!";
    } else {
        // Insertion failed
        $response_status = "Failed to insert data!";
    }
}


// Fetch messages from the database
$query = "SELECT `id`, `fullname`, `gmail`, `subject`, `number`, `message`, `remarks`, `ClientNum` FROM `messages`";
$result = mysqli_query($conn, $query);


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

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <title>Accept People Who are registering</title>
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
            <li class="active">
                <a href="messages.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="text">Inquiries</span>
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
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
           <!-- HTML code with PHP -->
<div class="table-data">
    <div class="todo">
        <!-- HTML Table with DataTables -->
        <table id="messagesTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Number</th>
                    <th>Message</th>
                    <th>Remarks</th>
                    <th>ClientNum</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$row["fullname"]."</td>";
					echo "<td>".$row["gmail"]."</td>";
					echo "<td>".$row["subject"]."</td>";
					echo "<td>".$row["number"]."</td>";
					echo "<td>".$row["message"]."</td>";
					echo "<td>".$row["remarks"]."</td>";
					echo "<td>".$row["ClientNum"]."</td>";
					// View button with only ID wrapped in a div
					echo "<td><div><button class='btn viewBtn' data-toggle='modal' data-target='#messageModal' data-id='".$row["id"]."'>View</button></div></td>";
					echo "</tr>";
				}
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="messageDetails">
                    <!-- Message details will be dynamically inserted here -->
                </div>
                <hr>
                <h5>Admin Response</h5>
                <form id="adminResponseForm" action="" method="POST">
					<label for="message_Id" hidden>Row</label>
					<input type="hidden" id="message_Id" name="message_Id" value="" hidden> <!-- Hidden message ID field -->
					<label for="admin_id" hidden>Admin</label>
					<input type="hidden" id="admin_id" name="admin_id" value="<?php echo $admin_id; ?>"> <!-- Hidden admin ID field -->

					<div class="form-group">
						<label for="response_message">Response Message</label>
						<textarea class="form-control" id="response_message" name="response_message" rows="3"></textarea> <!-- Updated name attribute -->
					</div>
					<button type="submit" class="btn btn-primary">Submit Response</button>
				</form>				
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

		</main>
	<!-- MAIN -->
</section>
<!-- CONTENT -->


<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Initialize DataTables and Modal Population -->
<script>
    $(document).ready(function(){
        $('.viewBtn').click(function(){
            var id = $(this).data('id');
            // Here you can perform AJAX request to fetch details based on the ID and populate the modal content
            // For simplicity, I'm just displaying the ID in the modal for now
            $('#messageId').val(id);
			  // Set the value of the hidden input field
			$('#message_Id').val(id);
            $('#messageDetails').html("ID: " + id);
            $('#messageModal').modal('show'); // Show the modal
        });
    });
</script>

</body>
</html>
