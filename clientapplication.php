<?php 
session_start();
include 'config.php';
include 'query.php'; // Ensure this includes the performQuery function and get_client_data function


$client_data = null;
$areano1_data = [];
$areano1_data_length = 0;

if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
    $client_data = get_client_data($client_id);

    if ($client_data !== null) {
        $firstname = $client_data['firstname'];
        $lastname = $client_data['lastname'];
        $middlename = $client_data['middlename'];
        $clientNum = $client_data['clientNum'];
        $email = $client_data['email'];
        $contact = $client_data['contact'];

        $areano1_data = check_client_exists_in_areano1($clientNum);
        $areano1_data_length = count($areano1_data);
    } else {
        header("Location: loginform.php");
        exit();
    }
} else {
    header("Location: loginform.php");
    exit();
}

$area_data = get_data_by_area($areaOneId);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input data
    $fullname = trim($_POST['fullname']);
    $gmail = trim($_POST['gmail']);
    $subject = trim($_POST['subject']);
    $number = trim($_POST['number']);
    $message = trim($_POST['message']);
    $clientNum = trim($_POST['clientNum']);

    // Insert the form data into the database
    $query = "INSERT INTO messages (fullname, gmail, subject, number, message, clientNum) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssssss", $fullname, $gmail, $subject, $number, $message, $clientNum);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to a success page or display a success message
            header("Location: clientapplication.php");
            exit();
        } else {
            // Handle insertion failure
            echo "Failed to insert data into the database.";
        }
    } else {
        // Handle query preparation failure
        echo "Error in preparing database query.";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
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
            height: 500px;
            margin: auto;
        }

        .container iframe {
            width: 75%;
            height: 50%;
        }
        
        .table-data {
            display: flex;
            gap: 10px; /* Adds space between the two divs */
        }

        .todo1 {
            /* Add additional styling if necessary */
            width: 500px;

        }

        .todo {
            /* Add additional styling if necessary */
            /* align-items: center; Center the canvas vertically */
        }

        .todo .container {
            width: 100%;
            display: flex;
            justify-content: center; /* Center the chart within the container */
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
            width: 40px;
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
        <li class="active">
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
        <li>
            <a href="clientmessage.php">
                <i class='bx bx-street-view'></i>
                <span class="text">Message</span>
            </a>
        </li>
        <li>
            <a href="clienthistory2.php">
                <i class='bx bx-list-ul'></i>
                <span class="text">Direction</span>
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
            
            <div class="todo1">
                <h1>How to Find Us</h1>
                <br>
                <h3>Locate Us</h3>
                <br>
                <p>If you have any questions, just fill in the contact form, and we will answer you shortly. Come and visit one of our nearby offices in your area.</p>
                <p></p>
                <p></p>
                <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5801.809947650999!2d121.04995534561812!3d14.682603960843778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0cb260299bf%3A0x9dcfa64b6e999995!2sHimlayang%20Pilipino%2C%20Inc.%20-%20Memorial%20Park%20Office!5e0!3m2!1sen!2sph!4v1714648726015!5m2!1sen!2sph&gestureHandling=none&scrollwheel=false&disableDefaultUI=true" width="460" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            </div>
            
            <div class="todo">
                <h1>Inquire Now</h1>
                <form action="" method="POST">
                    <label for="fullname">Full Name:</label><br>
                    <input type="text" id="fullname" name="fullname" value="<?php echo $lastname . ', ' . $firstname . ' ' . $middlename; ?>" readonly><br>
                    
                    <label for="gmail">Email:</label><br>
                    <input type="email" id="gmail" name="gmail" value="<?php echo $email; ?>"><br>
                    
                    <label for="subject">Subject:</label><br>
                    <select id="subject" name="subject">
                        <option value="" disabled selected>Select</option>
                        <option value="services">Services</option>
                        <option value="other">Other</option>
                    </select><br>
                    
                    <label for="number">Number:</label><br>
                    <input type="text" id="number" name="number" value="<?php echo $contact; ?>"><br>
                    
                    <label for="message">Message:</label><br>
                    <textarea id="message" name="message"></textarea><br>
                    
                    <label for="clientNum">Client Number:</label><br>
                    <input type="text" name="clientNum" value="<?php echo $clientNum; ?>"><br><br>
            
                    <input type="submit" value="Submit">
                </form>
            </div>
            
        </div>
        <div id="clientData"></div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->
<script src="script2.js"></script>
</body>
</html>