<?php
session_start();
include 'config.php';
include 'query.php';

function showNotification($title, $text, $icon) {
    echo "<script type='text/javascript'>showNotification('$title', '$text', '$icon');</script>";
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_data = get_user_data($user_id);
    if ($user_data !== null) {
        $firstname = $user_data['firstname'];
        $lastname = $user_data['lastname'];
    } else {
        showNotification('Error', 'No user data found!', 'error');
        exit();
    }
} else {
    showNotification('Error', 'User is not logged in!', 'error');
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

    // Calculate rows without data as 30 - rows with data
    $rowWithoutData = 30 - $rowWithData;

    return array(
        'rowsWithData' => $rowWithData,
        'rowsWithoutData' => $rowWithoutData,
        'totalRows' => $totalRows
    );
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableNames = array('areano1', 'areano2', 'areano3', 'areano4', 'areano5', 'areano6', 'areano7', 'areano8');
$tableData = array();

$totalRowsWithData = 0;
$totalRowsWithoutData = 0;
$totalPercentageOccupancy = 0;
$totalPossibleRows = count($tableNames) * 30;

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

// Calculate the total percentage occupancy
$totalPercentageOccupancy = ($totalRowsWithData / $totalPossibleRows) * 100;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Occupancy Percentage</title>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>
    <h2>Occupancy Percentage</h2>
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
        <tfoot>
            <tr>
                <td colspan="2">Total</td>
                <td><?php echo $totalRowsWithData; ?></td>
                <td><?php echo $totalRowsWithoutData; ?></td>
                <td><?php echo number_format($totalPercentageOccupancy, 2); ?>%</td>
            </tr>
        </tfoot>
    </table>

    <div id="chartContainer" style="height: 370px; width: 100%;"></div>

    <script>
        window.onload = function() {
            var dataPoints = [
                <?php foreach ($tableData as $data): ?>
                    { label: "<?php echo $data['tableName']; ?>", y: <?php echo $data['percentageOccupancy']; ?> },
                <?php endforeach; ?>
            ];

            var chart = new CanvasJS.Chart("chartContainer", {
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
</body>
</html>
