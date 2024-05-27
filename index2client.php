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

$search = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = trim($_POST['search']);
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
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
<link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<!-- style2.css in the root folder -->
<link rel="stylesheet" href="css\index2\css\styles.css">
<link rel="stylesheet" href="css\index2\css\style.css">
<style>
        .status-active {
        background-color: green;
        color: white;
    }
    .status-inactive {
        background-color: red;
        color: white;
    }
</style>
	<title>Deceased Person 2d Plot</title>
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
            <li class="active">
				<a href="index2client.php">
					<i class='bx bx-street-view'></i>
					<span class="text">Client List</span>
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
            <div class="container">
              <div class="card-body">
                <form method="POST" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search by name..." name="search" value="<?php echo $search; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
                <table id="searchTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Client Num</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($search)) {
                            $conn = mysqli_connect("localhost", "root", "", "user_db");
                            $search = mysqli_real_escape_string($conn, $search);
                            $query = "SELECT * FROM client_form WHERE clientnum LIKE '%$search%' OR lastname LIKE '%$search%' OR middlename LIKE '%$search%' OR email LIKE '%$search%' ";

                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $index => $client) {
                                $statusClass = $client['status'] === 'Active' ? 'status-active' : 'status-inactive';
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($client['clientnum']); ?></td>
                                    <td><?= htmlspecialchars($client['firstname']); ?></td>
                                    <td><?= htmlspecialchars($client['lastname']); ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm viewSelection"
                                           data-toggle="modal"
                                           data-target="#displayClient"
                                           data-clientnum="<?= htmlspecialchars($client['clientnum']); ?>"
                                           data-id="<?= htmlspecialchars($client['id']); ?>"
                                           data-name="<?= htmlspecialchars($client['firstname'] . ' ' . $client['lastname'] . ' ' . $client['middlename']); ?>"
                                           data-email="<?= htmlspecialchars($client['email']); ?>"
                                           data-contact="<?= htmlspecialchars($client['contact']); ?>"
                                           data-birthday="<?= htmlspecialchars($client['birthday']); ?>"
                                           data-position="<?= htmlspecialchars($client['position']); ?>"
                                           data-status="<?= htmlspecialchars($client['status']); ?>"
                                           href="#">View</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='3'><h5>No Record Found</h5></td></tr>";
                        }
                        mysqli_close($conn);
                        }
                        ?>
                    </tbody>
                </table>
        
                <!-- Main Modal for Viewing Client Details -->
                <div class="modal fade" id="displayClient" tabindex="-1" aria-labelledby="displayClientLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="displayClientLabel">Client Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p id="clientDetails"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary editClient" data-toggle="modal" data-target="#editClient">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Edit Modal for Editing Client Status -->
                <div class="modal fade" id="editClient" tabindex="-1" aria-labelledby="editClientLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editClientLabel">Edit Client Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editClientForm">
                                    <div class="form-group">
                                        <label for="clientStatus">Status</label>
                                        <select class="form-control" id="clientStatus" name="status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <input type="hidden" id="clientId" name="id">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveChanges">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script>
                $(document).on('click', '.viewSelection', function () {
                    var clientnum = $(this).data('clientnum');
                    var name = $(this).data('name');
                    var email = $(this).data('email');
                    var contact = $(this).data('contact');
                    var birthday = $(this).data('birthday');
                    var position = $(this).data('position');
                    var status = $(this).data('status');
                    var id = $(this).data('id');

                    var statusClass = status === 'Active' ? 'status-active' : 'status-inactive';
        
                    var details = '<strong>Client Number:</strong> ' + clientnum + '<br>' +
                                  '<strong>Name:</strong> ' + name + '<br>' +
                                  '<strong>Email:</strong> ' + email + '<br>' +
                                  '<strong>Contact:</strong> ' + contact + '<br>' +
                                  '<strong>Birthday:</strong> ' + birthday + '<br>' +
                                  '<strong>Position:</strong> ' + position + '<br>' +
                                  '<strong>Status:</strong> <span class="' + statusClass + '">' + status + '</span>';
        
                    $('#clientDetails').html(details);
                    $('.editClient').data('id', id);
                    $('#clientStatus').val(status);
                    $('#clientId').val(id);
                });
        
                $('#saveChanges').on('click', function () {
                    var formData = $('#editClientForm').serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'update_status.php',
                        data: formData,
                        success: function (response) {
                            $('#editClient').modal('hide');
                            $('#displayClient').modal('hide');
                            alert(response);
                            location.reload();
                        }
                    });
                });
                $(document).ready(function() {
        $('#searchTable').DataTable();
    });
            </script>
        
	</section>
	<!-- CONTENT -->
	

	<script src="script2.js"></script>
</body>
</html>