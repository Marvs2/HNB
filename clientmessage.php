<?php 
session_start();
include 'config.php';
include 'query.php'; // Ensure this includes the performQuery function and get_client_data function

// Check if the user is logged in
if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
    $client_data = get_client_data($client_id);

    // If user data exists
    if ($client_data !== null) {
        $firstname = $client_data['firstname'];
        $lastname = $client_data['lastname'];
        $clientNum = $client_data['clientNum'];

        $areano1_data = check_client_exists_in_areano1($clientNum);
        $areano1_data_length = count($areano1_data);
    }
}

function viewMessages() {
    global $conn; // Assuming $conn is your database connection variable

    // Query to select messages
    $query = "SELECT `id`, `fullname`, `gmail`, `subject`, `number`, `message`, `remarks`, `ClientNum` FROM `messages` WHERE 1";
    
    // Perform the query
    $result = mysqli_query($conn, $query);

    // Check if query failed
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Return the result set
    return $result;
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
    <link rel="stylesheet" href="css/index2/css/style2.css">
    <!-- My CSS -->
    <link rel="stylesheet" href="css/index2/css/style.css">
    <style>
        .container {
            position: relative;
            width: 750px;
            height: 700px;
            margin: auto;
        }

        .container iframe {
            width: 100%;
            height: 100%;
        }

        .btn {
            position: absolute;
            background-color: blue;
            color: white;
            font-size: 14px;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 25%;
            width: 60px;
            height: 40px;
            text-align: center;
            line-height: 20px;
        }

        .btn:hover {
            background-color: darkblue;
        }

        .btn1 {
            top: 44%;
            left: 47%;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            max-width: 800px;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .image-container {
            position: relative;
            width: 100%;
            text-align: center;
        }
        .image-container img {
            max-width: 80%;
            height: auto;
        }

        .modal-button:hover {
            background-color: #d4ac0d;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 50%;
        }

        .grid-container button {
            width: 40px;
            height: 40px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .grid-container button:nth-child(odd) {
            background-color: #4CAF50;
        }

        .grid-container button:nth-child(even) {
            background-color: #2196F3;
        }

    </style>
    <title>Deceased Person - Dashboard</title>
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="index2.php" class="brand">
        <span class="text" style="padding-left: 15px;"> Himlayan ng Bayan</span>
    </a>
    <ul class="side-menu top">
        <li>
            <a href="clientindex.php">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="clientapplication.php">
                <i class='bx bxs-edit-location'></i>
                <span class="text">Application</span>
            </a>
        </li>
        <li>
            <a href="clientlist.php">
                <i class='bx bx-folder-plus'></i>
                <span class="text">List</span>
            </a>
        </li>
        <li class="active">
            <a href="clientmessage.php">
                <i class='bx bx-street-view'></i>
                <span class="text">Message</span>
            </a>
        </li>
        <li>
            <a href="clienthistory2.php">
                <i class='bx bx-list-ul'></i>
                <span class="text">History</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="logout.php" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->
<!-- CONTENT -->
<section id="content">
    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>
                    <?php
                    // Check if the user is logged in
                    if (isset($firstname)) {
                        // Display user information if logged in
                        echo 'Welcome ' . $firstname;
                        // You can echo other user data fields as needed
                    } else {
                        // Redirect to the login form if the user is not logged in
                        header("Location: loginform.php");
                        exit();
                    }
                    ?>
                </h1>
            </div>
        </div>

        <div class="table-data">
            <!-- Table container -->
            <div class="container">
                <?php
                // Call the viewMessages function to get the query result
                $result = viewMessages();
                
// Check if there are any messages
if (mysqli_num_rows($result) > 0) {
    // Output table header
    echo "<table id='messageTable' class='display' style='width:100%;'>
            <thead>
                <tr>
                    <th style='display: none;'>ID</th>
                    <th style='padding: 10px;'>Full Name</th>
                    <th style='padding: 10px;'>Email</th>
                    <th style='padding: 10px;'>Subject</th>
                    <th style='padding: 10px;'>Number</th>
                    <th style='padding: 10px;'>Message</th>
                    <th style='padding: 10px;'>Remarks</th>
                    <th style='padding: 10px;'>ClientNum</th>
                    <th style='padding: 10px;'>Action</th>
                </tr>
            </thead>
            <tbody>";

            // Output table rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td style='display: none;'>" . $row['id'] . "</td>";
                echo "<td style='padding: 10px;'>" . $row['fullname'] . "</td>";
                echo "<td style='padding: 10px;'>" . $row['gmail'] . "</td>";
                echo "<td style='padding: 10px;'>" . $row['subject'] . "</td>";
                echo "<td style='padding: 10px;'>" . $row['number'] . "</td>";
                echo "<td style='padding: 10px;'>" . $row['message'] . "</td>";
                echo "<td style='padding: 10px;'>" . $row['remarks'] . "</td>";
                echo "<td style='padding: 10px;'>" . $row['ClientNum'] . "</td>";
                echo "<td style='padding: 10px;'><button class='btn view-btn' data-message-id='" . $row['id'] . "'>View</button></td>"; // View button
                echo "</tr>";
            }

            // Close table
            echo "</tbody></table>";
        } else {
            // No messages found
            echo "No messages found.";
        }
                
                // Free result set
                mysqli_free_result($result);
                ?>
            </div>
        </div>

         <!-- Modal HTML Structure -->
         <div class="modal fade" id="messageDetailsModal" tabindex="-1" role="dialog" aria-labelledby="messageDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageDetailsModalLabel">Message Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Content to be loaded dynamically via AJAX -->
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

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Include Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your custom JavaScript -->

<script>
    $(document).ready(function() {
    // Add click event to open modal when view button is clicked
    $('.view-btn').click(function() {
        var messageId = $(this).data('message-id');
        $.ajax({
            url: 'fetch_admin_responses.php', // Update to the correct PHP file handling admin responses
            type: 'POST',
            data: { messageId: messageId }, // Pass the messageId to the PHP script
            success: function(response) {
                $('#messageDetailsModal .modal-body').html(response); // Update the modal body content
                $('#messageDetailsModal').modal('show');
            }
        });
    });
});

</script>

</body>
</html>

