<?php 
session_start();
include 'config.php';
include 'query.php'; // Ensure this includes the performQuery function and get_client_data function

if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
    $client_data = get_client_data($client_id);

    if ($client_data !== null) {
        $firstname = $client_data['firstname'];
        $lastname = $client_data['lastname'];
        $clientNum = $client_data['clientNum'];

        $areano1_data = check_client_exists_in_areano1($clientNum);
        $areano1_data_length = count($areano1_data);
    }
}

$area_data = get_data_by_area($areaOneId);
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
    width: auto; /* Change width to auto */
    height: auto; /* Adjust height as needed */
    margin: auto;
}

.container iframe {
    width: 100%;
    height: 100%;
}

.todo {
    display: flex;
    flex-direction: column; /* Arrange items vertically */
    align-items: center; /* Center items horizontally */
}

.btn {
    background-color: blue;
    color: white;
    font-size: 14px;
    padding: 10px;
    border: none;
    cursor: pointer;
    border-radius: 25%;
    width: 150px; /* Adjust button width */
    height: 40px; /* Adjust button height */
    margin-bottom: 10px; /* Add space between buttons */
    text-align: center;
    line-height: 20px;
}

.btn:hover {
    background-color: darkblue;
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
        <li class="active">
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
            <div class="todo">
                <h1>Map per Area Given</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Button 1 -->
                            <button class="btn btn-primary btn-block mb-3"><a href="Area1.php">Area 1</a></button>
                            <!-- Area 2 -->
                            <button class="btn btn-primary btn-block mb-3">Area 2</button>
                            <!-- Area 3 -->
                            <button class="btn btn-primary btn-block mb-3">Area 3</button>
                            <!-- Area 4 -->
                            <button class="btn btn-primary btn-block mb-3">Area 4</button>
                            <!-- Area 5 -->
                            <button class="btn btn-primary btn-block mb-3">Area 5</button>
                            <!-- Area 6 -->
                            <button class="btn btn-primary btn-block mb-3">Area 6</button>
                            <!-- Area 7 -->
                            <button class="btn btn-primary btn-block mb-3">Area 7</button>
                            <!-- Area 8 -->
                            <button class="btn btn-primary btn-block mb-3">Area 8</button>
                        </div>
                    </div>
                </div>
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