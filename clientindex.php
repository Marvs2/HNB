<?php 
session_start();
include 'config.php';
include 'query.php'; // Ensure this includes the performQuery function and get_user_data function

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

function countRowsWithAndWithoutData($conn, $tableName) {
    $queryWithData = "SELECT COUNT(*) as rowsWithData FROM $tableName WHERE dpNum IS NOT NULL";
    $resultWithData = $conn->query($queryWithData);
    $rowWithData = $resultWithData->fetch_assoc()['rowsWithData'];

    // Count the total number of rows
    $queryTotalRows = "SELECT COUNT(*) as totalRows FROM $tableName";
    $resultTotalRows = $conn->query($queryTotalRows);
    $totalRows = $resultTotalRows->fetch_assoc()['totalRows'];

    // Calculate rows without data as totalRows - 30
    $rowWithoutData = 30 - $totalRows ;

    return array(
        'rowsWithData' => $rowWithData,
        'rowsWithoutData' => $rowWithoutData,
        'totalRows' => $totalRows
    );
}

$conn = mysqli_connect("localhost", "root", "", "user_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

#inactive account
$query = "SELECT COUNT(*) as inactiveCount FROM client_form WHERE status = 'Inactive'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$requests_count = $row['inactiveCount'];


$tableNames = array('areano1', 'areano2', 'areano3', 'areano4', 'areano5', 'areano6', 'areano7', 'areano8');
$tableData = array();

$totalRowsWithData = 0;
$totalRowsWithoutData = 0;

foreach ($tableNames as $tableName) {
    $rowCount = countRowsWithAndWithoutData($conn, $tableName);

    // Calculate the percentage occupancy
    $percentageOccupancy = ($rowCount['rowsWithData'] / 30) * 100;

    $tableData[] = array(
        'tableName' => $tableName,
        'rowCount' => $rowCount,
        'percentageOccupancy' => $percentageOccupancy
    );

    $totalRowsWithData += $rowCount['rowsWithData'];
    $totalRowsWithoutData += $rowCount['rowsWithoutData'];
}

$conn->close();
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
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <title>Deceased Person - Dashboard</title>
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="clientindex.php" class="brand">
        <span class="text" style="padding-left: 15px;"> Himlayan ng Bayan</span>
    </a>
    <ul class="side-menu top">
        <li>
            <a href="clientindex.php"><!--near half 25%--> 
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="clientapplication.php"><!--Nearly Done 80%--> 
                <i class='bx bxs-edit-location'></i>
                <span class="text">Application</span>
            </a>
        </li>
        <li>
            <a href="clientlist.php"><!--Working on it 15% -->
                <i class='bx bx-folder-plus'></i>
                <span class="text">List</span>
            </a>
        </li>
        <li>
            <a href="clientmessage.php"><!--Nearly Done 75%--> 
                <i class='bx bx-street-view'></i>
                <span class="text">Message</span>
            </a>
        </li>
        <li>
            <a href="clienthistory2.php"> <!--Maybe Info about the other inquiry?? -->
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
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="profile" style="float:right;">
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
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Home</a>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <?php echo $totalRowsWithData; ?>
                    <p>Total: <?php echo $totalRowsWithData; ?></p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <?php echo $totalRowsWithoutData; ?>
                    <p>Avalable:<?php echo $totalRowsWithoutData; ?></p>
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
            <div class="order">
                <div id="chartsContainer" style="height: 450px; width: 100%;"></div>
                <br>
                <h4>Occupancy Percentage</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Area</th>
                            <th>Total Rows</th>
                            <th>Rows With Data</th>
                            <th>Rows Without Data</th>
                            <th>Percentage Occupancy</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tableData as $data): ?>
                            <tr>
                                <td><?php echo $data['tableName']; ?></td>
                                <td><?php echo $data['rowCount']['totalRows']; ?></td>
                                <td><?php echo $data['rowCount']['rowsWithData']; ?></td>
                                <td><?php echo $data['rowCount']['rowsWithoutData']; ?></td>
                                <td><?php echo number_format($data['percentageOccupancy'], 2); ?>%</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="todo">
                <div class="container">
                    <canvas id="myChart" width="350" height="500" aria-label="chart" role="img"></canvas>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src="js/custom.js"></script>    
            </div>
        </div>
    </main>
</section>

<!-- Ensure jQuery and Bootstrap JavaScript are included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    window.onload = function() {
        var dataPoints = [
            <?php foreach ($tableData as $data): ?>
                { label: "<?php echo $data['tableName']; ?>", y: <?php echo $data['percentageOccupancy']; ?> },
            <?php endforeach; ?>
        ];

        var chart = new CanvasJS.Chart("chartsContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Occupancy Percentage"
            },
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: dataPoints
            }]
        });
        chart.render();
    }
</script>
<script src="script2.js"></script>
</body>
</html>
