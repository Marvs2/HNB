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
    $query = "SELECT `id`, `fullname`, `gmail`, `subject`, `number`, `message`, `remarks`, `ClientNum`, `time` FROM `messages` WHERE 1";
    
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
        .chat-container {
            width: 80%;
            margin: 0 auto;
        }
        .client-chat {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .message {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 10px;
            border-bottom: 1px solid #eee;
            position: relative;
        }
        .message.client {
            background-color: #f0f8ff;
        }
        .message.admin {
            background-color: #e6ffe6;
            text-align: right;
        }
        .btn.view-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 3px 6px;
            font-size: 12px;
        }
        .admin-response {
            text-align: right;
        }
        .response-date {
            text-align: right;
            font-size: 15px;
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
            <div class="chat-container">
                <?php
                // Call the viewMessages function to get the query result
                $result = viewMessages();
            
                // Check if there are any messages
                if (mysqli_num_rows($result) > 0) {
                    // Initialize an array to store messages by ClientNum
                    $messagesByClient = [];
            
                    // Fetch all messages and group them by ClientNum
                    while ($row = mysqli_fetch_assoc($result)) {
                        $clientNum = $row['ClientNum'];
                        $messagesByClient[$clientNum][] = $row;
                    }
            
                    // Display messages grouped by ClientNum
                    foreach ($messagesByClient as $clientNum => $messages) {
                        echo "<div class='client-chat'>";
                        echo "<h3>Client: $clientNum</h3>";
            
                        // Sort messages by time (assuming 'time' is the timestamp field)
                        usort($messages, function($a, $b) {
                            return strtotime($a['time']) - strtotime($b['time']);
                        });
            
                        // Display messages in order
                        foreach ($messages as $message) {
                            echo "<div class='message client'>";
                            echo "<div>";
                            echo "<p><strong>Full Name:</strong> " . $message['fullname'] . "</p>";
                            echo "<p><strong>Email:</strong> " . $message['gmail'] . "</p>";
                            echo "<p><strong>Subject:</strong> " . $message['subject'] . "</p>";
                            echo "<p><strong>Number:</strong> " . $message['number'] . "</p>";
                            echo "<p><strong>Message:</strong> " . $message['message'] . "</p>";
                            echo "<p><strong>Time:</strong> " . $message['time'] . "</p>";
                            echo "</div>";
                            echo "<button class='btn view-btn' data-message-id='" . $message['id'] . "'>View Admin Response</button>";
                            echo "<div class='admin-response' id='response-" . $message['id'] . "' style='display:none;'></div>";
                            echo "</div>";
                        }
            
                        echo "</div>";
                    }
                } else {
                    // No messages found
                    echo "No messages found.";
                }
            
                // Free result set
                mysqli_free_result($result);
                ?>
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
        // Add click event to show admin response when view button is clicked
        $('.view-btn').click(function() {
            var messageId = $(this).data('message-id');
            var responseDiv = $('#response-' + messageId);
            $.ajax({
                url: 'fetch_admin_responses.php', // Update to the correct PHP file handling admin responses
                type: 'POST',
                data: { messageId: messageId }, // Pass the messageId to the PHP script
                success: function(response) {
                    responseDiv.html(response); // Update the admin response content
                    responseDiv.toggle(); // Show or hide the response
                }
            });
        });
    });
</script>

</body>
</html>
