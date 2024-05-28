<?php
session_start();
include 'config.php'; // Include the config file to define $conn
include 'query.php'; // Include the query file

// Define the grave numbers you want to fetch data for
$graveNumbers = range(1, 30); // Array of numbers from 1 to 30

// Fetch the client data for the specified grave numbers
$client_data = get_client_data_for_grave_numbers_five($graveNumbers);

// Define positions for each grave number
$positions = [
    1 => ['top' => 69, 'left' => 20],
    2 => ['top' => 66, 'left'  => 27],
    3 => ['top' => 63, 'left' => 34],
    4 => ['top' => 60, 'left' => 41],
    5 => ['top' => 59, 'left' => 48],
    6 => ['top' => 58, 'left' => 55],
    7 => ['top' => 57, 'left' => 62],
    8 => ['top' => 57, 'left' => 67],
    9 => ['top' => 56, 'left' => 74],
    10 => ['top' => 56, 'left' => 81],
    11 => ['top' => 61, 'left' => 20],
    12 => ['top' => 57, 'left' => 27],
    13 => ['top' => 53, 'left' => 34],
    14 => ['top' => 50, 'left' => 41],
    15 => ['top' => 48, 'left' => 48],
    16 => ['top' => 48, 'left' => 55],
    17 => ['top' => 48, 'left' => 62],
    18 => ['top' => 48, 'left' => 67],
    19 => ['top' => 48, 'left' => 74],
    20 => ['top' => 46, 'left' => 81],
    21 => ['top' => 49, 'left' => 20],
    22 => ['top' => 47, 'left' => 27],
    23 => ['top' => 44, 'left' => 34],
    24 => ['top' => 41, 'left' => 41],
    25 => ['top' => 40, 'left' => 48],
    26 => ['top' => 39, 'left' => 55],
    27 => ['top' => 38, 'left' => 62],
    28 => ['top' => 38, 'left' => 67],
    29 => ['top' => 37, 'left' => 74],
    30 => ['top' => 37, 'left' => 81],
];

// Map positions to client data
foreach ($client_data as &$data) {
    if (isset($positions[$data['graveNo']])) {
        $data['top'] = $positions[$data['graveNo']]['top'];
        $data['left'] = $positions[$data['graveNo']]['left'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Embed in HNB</title>
    <link rel="stylesheet" href="css/maps.css">
    <style>
       .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh; /* Ensure the container takes the full height of the viewport */
        }
        .btn1 {
            position: absolute;
            top: 30%; /* Adjust the top position as needed */
            left: 55%; /* Adjust the left position as needed */
            transform: translate(-50%, -50%); /* Center the button */
            background-color: rgb(255, 140, 0); /* Add your desired styles */
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        .modal-button {
            background-color: blue; /* Add your desired styles */
            color: white;
            border: none;
            padding: 5px;
            cursor: pointer;
            border-radius: 40%;
        }
        .blue-button {
  background-color: blue;
  color: white;
  /* Add more styles as needed */
}

.green-button {
  background-color: green;
  color: white;
  /* Add more styles as needed */
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
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 30px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 100%;
            height: 80%;
        }
        .modal-content img {
            display: flex;
            width: 100%;
            height: 90%; /* Ensure the container takes the full height of the viewport */
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
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
        }
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 10px;
            border-radius: 5px;
        }
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            border-radius: 5px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-container">
            <h1>Himalyang Pilipino Memorial Park Map</h1>
            <img src="uploaded_img/FinalArea.png" alt="Snow" style="max-width: 100%; max-height: 100%;">
            <button class="btn btn1" id="modalBtn1">A1</button>
            <!-- Add circular buttons for main image content -->
        </div>
    </div>

   <!-- Main Modal for Button A1 -->
<div id="myModal1" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('myModal1')">&times;</span>
      <h2>Area 1 Details</h2>
      <img src="uploaded_img/AreaOne.png" alt="Area 1" style="max-width: 1000vh; max-height: 1000vh;">
      <!-- Add circular buttons for Area 1 modal content -->
      <?php for ($i = 1; $i <= 30; $i++): ?>
      <?php
      $data = isset($client_data[$i - 1]) ? $client_data[$i - 1] : null;
      $top = isset($positions[$i]['top']) ? $positions[$i]['top'] : '';
      $left = isset($positions[$i]['left']) ? $positions[$i]['left'] : '';
      ?>
      <div style="position: absolute; top: <?php echo $top; ?>%; left: <?php echo $left; ?>%; width: 0; height: 0;">
        <button class="modal-button <?php echo ($data) ? 'blue-button' : 'green-button'; ?>" onclick="openModal('graveModal<?php echo $i; ?>')"><?php echo $i; ?></button>
      </div>
      <?php endfor; ?>
    </div>
  </div>
<!-- Modals for each grave number -->
<?php for ($i = 1; $i <= 30; $i++): ?>
<?php $data = isset($client_data[$i - 1]) ? $client_data[$i - 1] : null; ?>
<div id="graveModal<?php echo $i; ?>" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('graveModal<?php echo $i; ?>')">&times;</span>
    <h2>Details for Grave No <?php echo $i; ?></h2>
    <?php if ($data): ?>
    <p>First Name: <?php echo $data['firstname']; ?></p>
    <p>Last Name: <?php echo $data['lastname']; ?></p>
    <p>Middle Name: <?php echo $data['middlename']; ?></p>
    <p>Date of Birth: <?php echo $data['dateofBirth']; ?></p>
    <p>Date of Death: <?php echo $data['dateOfDeath']; ?></p>
    <p>Date of Buried: <?php echo $data['dateofBuried']; ?></p>
    <p>Status: <?php echo $data['status']; ?></p>
    <p>Stat Col: <?php echo $data['statCol']; ?></p>
    <p>Area No: <?php echo $data['areaNo']; ?></p>
    <p>Grave Type: <?php echo $data['graveType']; ?></p>
    <p>Buried Status: <?php echo $data['buriedStatus']; ?></p>
    <p>Maintenance Status: <?php echo $data['maintenanceStatus']; ?></p>
    <p>Last Maintenance Date: <?php echo $data['lastMaintenanceDate']; ?></p>
    <?php
    $buriedDate = new DateTime($data['dateofBuried']);
    $currentDate = new DateTime();
    $interval = $currentDate->diff($buriedDate);
    $years = $interval->y;
    $months = $interval->m;
    $days = $interval->d;
    if ($years >= 5) {
        $alertClass = 'alert-danger';
        $alertMessage = 'More than 5 years';
    } elseif ($years >= 1) {
        $alertClass = 'alert-warning';
        $alertMessage = 'More than 1 year';
    } elseif ($months >= 1) {
        $alertClass = 'alert-info';
        $alertMessage = 'More than 1 month';
    } else {
        $alertClass = 'alert-success';
        $alertMessage = 'Less than a month';
    }
    ?>
    <div class="<?php echo $alertClass; ?>">
      <p><?php echo $alertMessage; ?> since buried: <?php echo $years; ?> years, <?php echo $months; ?> months, <?php echo $days; ?> days.</p>
    </div>
    <?php else: ?>
    <p>No data available for this grave.</p>
    <?php endif; ?>
    <button id="graveButton<?php echo $i; ?>" class="<?php echo ($data) ? 'blue-button' : 'green-button'; ?>" onclick="showModal('graveModal<?php echo $i; ?>')">Show Details</button>
  </div>
</div>
<?php endfor; ?>

    <script>
        // Function to open modals
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }

        // Function to close modals
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        // Add event listener for the A1 button
        document.getElementById('modalBtn1').onclick = function() {
            openModal('myModal1');
        }

        // Close the modal when the user clicks outside of it
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = "none";
            }
        }
    </script>
</body>
</html>
