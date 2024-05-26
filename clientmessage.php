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
        <li class="active">
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

        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <p>Deceased Counts: <?php echo htmlspecialchars($clientNum); ?>: <?php echo $areano1_data_length; ?></p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <?php echo $requests_count; ?>
                    <p>Requests: <?php echo $requests_count; ?></p>
                </span>
            </li>
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <?php echo $dpersons_count; ?>
                    <p>Deceased Counts: <?php echo $dpersons_count; ?></p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <?php echo $requests_count; ?>
                    <p>Requests: <?php echo $requests_count; ?></p>
                </span>
            </li>
        </ul>

        <div class="table-data">
            <div>
                <?php if ($client_data !== null) : ?>
                    <h2>Client Data</h2>
                    <p>First Name: <?php echo htmlspecialchars($client_data['firstname']); ?></p>
                    <p>Last Name: <?php echo htmlspecialchars($client_data['lastname']); ?></p>
                    <p>Number of records with clientNum <?php echo htmlspecialchars($clientNum); ?>: <?php echo $areano1_data_length; ?></p>
                
                    <?php if ($areano1_data_length > 0) : ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Area One ID</th>
                                    <th>Client Num</th>
                                    <th>DP Num</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($areano1_data as $row) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['areaOneId']); ?></td>
                                        <td><?php echo htmlspecialchars($row['clientNum']); ?></td>
                                        <td><?php echo htmlspecialchars($row['dpNum']); ?></td>
                                        <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                                        <td><?php echo htmlspecialchars($row['lastname']); ?></td>
                                        <td><button onclick="showGraveDetails(<?php echo $row['areaOneId']; ?>)">View</button></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>No records found for clientNum <?php echo htmlspecialchars($clientNum); ?></p>
                    <?php endif; ?>
                <?php else : ?>
                    <p>User is not logged in or no user data found!</p>
                <?php endif; ?>
                </div>
            
            <div class="todo">
                <div class="container">
                            <!-- single canvas node to render the chart -->
                            <canvas
                              id="myChart"
                              width="350"
                              height="500"
                              aria-label="chart"
                              role="img"
                            ></canvas>
                </div>
                <script src="js/chart.js"></script>
                <script src="js/custom.js"></script>    
            
            </div>
            <div class="container">
                <h1>Himalyang Pilipino Memorial Park Map</h1>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5801.809947650999!2d121.04995534561812!3d14.682603960843778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0cb260299bf%3A0x9dcfa64b6e999995!2sHimlayang%20Pilipino%2C%20Inc.%20-%20Memorial%20Park%20Office!5e0!3m2!1sen!2sph!4v1714648726015!5m2!1sen!2sph&gestureHandling=none&scrollwheel=false&disableDefaultUI=true" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <button class="btn btn1" id="modalBtn1">A1</button>
            </div>
        
            <!-- Modals for the map -->
            <div id="myModal1" class="modal">
                <div class="modal-content">
                    <div class="image-container" style="position: relative; width: 100%;">
                        <h2>Modal Content for Area One</h2>
                        <img src="uploaded_img/AreaOne.png" alt="Snow" style="max-width: 100%; max-height: 100%;">
                        
                        <!-- Generate buttons dynamically based on data -->
                        <?php foreach ($area_data as $index => $row): ?>
                            <?php if ($index < 30): // Limit to 30 buttons ?>
                                <div style="position: absolute; top: <?= 10 + (intdiv($index, 6) * 10) ?>%; left: <?= 10 + (($index % 6) * 10) ?>%; width: 0; height: 0;">
                                    <button class="modal-button" 
                                            style="width: 20px; height: 20px;" 
                                            data-clientNum="<?= htmlspecialchars($row['clientNum']) ?>" 
                                            data-dpNum="<?= htmlspecialchars($row['dpNum']) ?>" 
                                            data-firstname="<?= htmlspecialchars($row['firstname']) ?>" 
                                            data-lastname="<?= htmlspecialchars($row['lastname']) ?>"
                                            data-graveNo="<?= htmlspecialchars($row['graveNo']) ?>"
                                            data-dateofBirth="<?= htmlspecialchars($row['dateofBirth']) ?>"
                                            data-dateOfDeath="<?= htmlspecialchars($row['dateOfDeath']) ?>"
                                            data-dateofBuried="<?= htmlspecialchars($row['dateofBuried']) ?>"
                                            data-status="<?= htmlspecialchars($row['status']) ?>"
                                            data-statCol="<?= htmlspecialchars($row['statCol']) ?>"
                                            data-areaNo="<?= htmlspecialchars($row['areaNo']) ?>"
                                            data-graveType="<?= htmlspecialchars($row['graveType']) ?>"
                                            data-buriedStatus="<?= htmlspecialchars($row['buriedStatus']) ?>"
                                            data-maintenanceStatus="<?= htmlspecialchars($row['maintenanceStatus']) ?>"
                                            data-lastMaintenanceDate="<?= htmlspecialchars($row['lastMaintenanceDate']) ?>"
                                            onclick="showGraveDetails(this)">
                                        <?= $row['graveNo'] ?>
                                    </button>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    
                    <span class="close" id="closeModal1">&times;</span>
                </div>
            </div>

<!-- Modal HTML Structure -->
<div class="modal fade" id="graveDetailsModal" tabindex="-1" role="dialog" aria-labelledby="graveDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="graveDetailsModalLabel">Grave Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>First Name:</strong> <span id="modalFirstName"></span></p>
                <p><strong>Last Name:</strong> <span id="modalLastName"></span></p>
                <p><strong>Client Number:</strong> <span id="modalClientNum"></span></p>
                <p><strong>DP Number:</strong> <span id="modalDpNum"></span></p>
                <p><strong>Grave Number:</strong> <span id="modalGraveNo"></span></p>
                <p><strong>Date of Birth:</strong> <span id="modalDateOfBirth"></span></p>
                <p><strong>Date of Death:</strong> <span id="modalDateOfDeath"></span></p>
                <p><strong>Date of Buried:</strong> <span id="modalDateOfBuried"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                <p><strong>Status Column:</strong> <span id="modalStatCol"></span></p>
                <p><strong>Area Number:</strong> <span id="modalAreaNo"></span></p>
                <p><strong>Grave Type:</strong> <span id="modalGraveType"></span></p>
                <p><strong>Buried Status:</strong> <span id="modalBuriedStatus"></span></p>
                <p><strong>Maintenance Status:</strong> <span id="modalMaintenanceStatus"></span></p>
                <p><strong>Last Maintenance Date:</strong> <span id="modalLastMaintenanceDate"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
     <script>
        var modal1 = document.getElementById("myModal1");
        var btn1 = document.getElementById("modalBtn1");
        var span1 = document.getElementById("closeModal1");

        btn1.onclick = function() {
            modal1.style.display = "block";
        }

        span1.onclick = function() {
            modal1.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal1) {
                modal1.style.display = "none";
            }
        }

        function showGraveDetails(button) {
            var clientNum = button.getAttribute('data-clientNum');
            var dpNum = button.getAttribute('data-dpNum');
            var firstname = button.getAttribute('data-firstname');
            var lastname = button.getAttribute('data-lastname');
            var graveNo = button.getAttribute('data-graveNo');
            var dateofBirth = button.getAttribute('data-dateofBirth');
            var dateOfDeath = button.getAttribute('data-dateOfDeath');
            var dateofBuried = button.getAttribute('data-dateofBuried');
            var status = button.getAttribute('data-status');
            var statCol = button.getAttribute('data-statCol');
            var areaNo = button.getAttribute('data-areaNo');
            var graveType = button.getAttribute('data-graveType');
            var buriedStatus = button.getAttribute('data-buriedStatus');
            var maintenanceStatus = button.getAttribute('data-maintenanceStatus');
            var lastMaintenanceDate = button.getAttribute('data-lastMaintenanceDate');

            alert("Grave Details:\n" +
                "Client Number: " + clientNum + "\n" +
                "DP Number: " + dpNum + "\n" +
                "First Name: " + firstname + "\n" +
                "Last Name: " + lastname + "\n" +
                "Grave Number: " + graveNo + "\n" +
                "Date of Birth: " + dateofBirth + "\n" +
                "Date of Death: " + dateofDeath + "\n" +
                "Date of Buried: " + dateofBuried + "\n" +
                "Status: " + status + "\n" +
                "Status Color: " + statCol + "\n" +
                "Area Number: " + areaNo + "\n" +
                "Grave Type: " + graveType + "\n" +
                "Buried Status: " + buriedStatus + "\n" +
                "Maintenance Status: " + maintenanceStatus + "\n" +
                "Last Maintenance Date: " + lastMaintenanceDate);
        }
    </script>
<script src="script2.js"></script>
</body>
</html>