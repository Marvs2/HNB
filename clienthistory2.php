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
        
  .grid-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 10px;
    background-color: #f1f1f1;
    padding: 10px;
  }
  .grid-container h1 {
    color: #e6e6e6
  }

  .grid-item {
    background-color: #e6e6e6;
    padding: 20px;
    text-align: center;
  }

  .video-container {
    position: relative;
    width: 100%;
    height: 25%;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    background-color: #000;
  }

  .video-container video {
    position: absolute;
    top: 35%;
    left: 0;
    width: 100%;
    height: 100%;
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
                    <div class="grid-container">
                        <div class="grid-item video-container">
                            <h1>Area 1</h1>
                          <video controls>
                            <source src="video/AreaOneDirection.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                          </video>
                        </div>
                      
                        <div class="grid-item video-container">
                            <h1>Area 2</h1>
                            <video controls>
                              <source src="video/AreaTwoDirection.mp4" type="video/mp4">
                              Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="grid-item video-container">
                            <h1>Area 3</h1>
                            <video controls>
                              <source src="video/AreaTwoDirection.mp4" type="video/mp4">
                              Your browser does not support the video tag.
                              </video>
                        </div>
                        <div class="grid-item video-container">
                            <h1>Area 4</h1>
                            <video controls>
                              <source src="video/AreaTwoDirection.mp4" type="video/mp4">
                              Your browser does not support the video tag.
                              </video>
                        </div>
                        <div class="grid-item video-container">
                            <h1>Area 5</h1>
                            <video controls>
                              <source src="video/AreaTwoDirection.mp4" type="video/mp4">
                              Your browser does not support the video tag.
                              </video>
                        </div>
                        <div class="grid-item video-container">
                            <h1>Area 6</h1>
                            <video controls>
                              <source src="video/AreaTwoDirection.mp4" type="video/mp4">
                              Your browser does not support the video tag.
                              </video>
                        </div>
                        <div class="grid-item video-container">
                            <h1>Area 7</h1>
                            <video controls>
                              <source src="video/AreaTwoDirection.mp4" type="video/mp4">
                              Your browser does not support the video tag.
                              </video>
                        </div>
                        <div class="grid-item video-container">
                            <h1>Area 8</h1>
                            <video controls>
                              <source src="video/AreaTwoDirection.mp4" type="video/mp4">
                              Your browser does not support the video tag.
                              </video>
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