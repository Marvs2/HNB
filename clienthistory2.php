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
            position: relative;
            width: 100%;
            height: 100%;
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
        <li>
            <a href="clientmessage.php">
                <i class='bx bx-street-view'></i>
                <span class="text">Message</span>
            </a>
        </li>
        <li class="active">
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
                <div class="container">
                    <div class="button-container">
                        <button data-area="Area1">Area1</button>
                        <button data-area="Area2">Area2</button>
                        <button data-area="Area3">Area3</button>
                        <button data-area="Area4">Area4</button>
                        <button data-area="Area5">Area5</button>
                        <button data-area="Area6">Area6</button>
                        <button data-area="Area7">Area7</button>
                        <button data-area="Area8">Area8</button>
                    </div>
                    
                    <!-- Modals -->
                    <div id="modalArea1" class="modal">
                        <div class="modal-content">
                            <span class="close" data-area="Area1">&times;</span>
                            <div class="video-container">
                                <video controls>
                                    <source src="video/AreaOneDirection.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                    
                    <div id="modalArea2" class="modal">
                        <div class="modal-content">
                            <span class="close" data-area="Area2">&times;</span>
                            <div class="video-container">
                                <video controls>
                                    <source src="video2.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                    
                    <div id="modalArea3" class="modal">
                        <div class="modal-content">
                            <span class="close" data-area="Area3">&times;</span>
                            <div class="video-container">
                                <video controls>
                                    <source src="video3.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                    
                    <div id="modalArea4" class="modal">
                        <div class="modal-content">
                            <span class="close" data-area="Area4">&times;</span>
                            <div class="video-container">
                                <video controls>
                                    <source src="video4.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                    
                    <div id="modalArea5" class="modal">
                        <div class="modal-content">
                            <span class="close" data-area="Area5">&times;</span>
                            <div class="video-container">
                                <video controls>
                                    <source src="video5.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                    
                    <div id="modalArea6" class="modal">
                        <div class="modal-content">
                            <span class="close" data-area="Area6">&times;</span>
                            <div class="video-container">
                                <video controls>
                                    <source src="video6.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                    
                    <div id="modalArea7" class="modal">
                        <div class="modal-content">
                            <span class="close" data-area="Area7">&times;</span>
                            <div class="video-container">
                                <video controls>
                                    <source src="video7.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                    
                    <div id="modalArea8" class="modal">
                        <div class="modal-content">
                            <span class="close" data-area="Area8">&times;</span>
                            <div class="video-container">
                                <video controls>
                                    <source src="video8.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->
<script>
    // Get all buttons and add event listeners
    var buttons = document.querySelectorAll('.button-container button');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            var area = this.getAttribute('data-area');
            var modal = document.getElementById('modal' + area);
            modal.style.display = "block";
        });
    });

    // Get all <span> elements that close the modals
    var spans = document.querySelectorAll('.close');
    spans.forEach(span => {
        span.addEventListener('click', function() {
            var area = this.getAttribute('data-area');
            var modal = document.getElementById('modal' + area);
            modal.style.display = "none";
        });
    });

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = "none";
        }
    }
</script>
<script src="script2.js"></script>
</body>
</html>