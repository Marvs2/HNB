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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap and Boxicons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/index2/css/style2.css">
    <link rel="stylesheet" href="css/index2/css/style.css">
    <title>Deceased Person - Dashboard</title>
    <style>
        /* Additional CSS for layout and styling */
    </style>
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="index2.php" class="brand">
        <span class="text" style="padding-left: 15px;"> Himlayan ng Bayan</span>
    </a>
    <ul class="side-menu top">
        <li class="active">
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
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Welcome <?php echo htmlspecialchars($firstname); ?></h1>
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
                    <p>Requests: <?php echo $requests_count; ?></p>
                </span>
            </li>
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <p>Deceased Counts: <?php echo $dpersons_count; ?></p>
                </span>
            </li>
        </ul>

        <div class="table-data">
            <div>
                <h2>Dp List Data</h2>

                <?php if ($areano1_data_length > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Client Num</th>
                            <th>DP Num</th>
                            <th>First Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($areano1_data as $row) : 
                            $buriedDate = new DateTime($row['dateofBuried']);
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
                            <tr>
                                <td><?php echo htmlspecialchars($row['clientNum']); ?></td>
                                <td><?php echo htmlspecialchars($row['dpNum']); ?></td>
                                <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                                <td>
                                    <button class="viewDetails" 
                                        data-toggle="modal" 
                                        data-target="#graveDetailsModal"
                                        data-clientnum="<?php echo htmlspecialchars($row['clientNum']); ?>"
                                        data-dpnum="<?php echo htmlspecialchars($row['dpNum']); ?>"
                                        data-firstname="<?php echo htmlspecialchars($row['firstname']); ?>"
                                        data-lastname="<?php echo htmlspecialchars($row['lastname']); ?>"
                                        data-graveno="<?php echo htmlspecialchars($row['graveNo']); ?>"
                                        data-dateofbirth="<?php echo htmlspecialchars($row['dateofBirth']); ?>"
                                        data-dateofdeath="<?php echo htmlspecialchars($row['dateOfDeath']); ?>"
                                        data-dateofburied="<?php echo htmlspecialchars($row['dateofBuried']); ?>"
                                        data-status="<?php echo htmlspecialchars($row['status']); ?>"
                                        data-statcol="<?php echo htmlspecialchars($row['statCol']); ?>"
                                        data-areano="<?php echo htmlspecialchars($row['areaNo']); ?>"
                                        data-gravetype="<?php echo htmlspecialchars($row['graveType']); ?>"
                                        data-buriedstatus="<?php echo htmlspecialchars($row['buriedStatus']); ?>"
                                        data-maintenancestatus="<?php echo htmlspecialchars($row['maintenanceStatus']); ?>"
                                        data-lastmaintenancedate="<?php echo htmlspecialchars($row['lastMaintenanceDate']); ?>"
                                        data-alertclass="<?php echo $alertClass; ?>"
                                        data-alertmessage="<?php echo $alertMessage; ?>"
                                        data-yearssinceburial="<?php echo $years; ?>"
                                        data-monthssinceburial="<?php echo $months; ?>"
                                        data-dayssinceburial="<?php echo $days; ?>"
                                    >View</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>                        
                    </tbody>
                </table>
            <?php else : ?>
                <p>No records found for clientNum <?php echo htmlspecialchars($clientNum); ?></p>
            <?php endif; ?>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>First Name:</strong> <span id="modalFirstName"></span></p>
                                    <p><strong>Last Name:</strong> <span id="modalLastName"></span></p>
                                    <p><strong>Client Number:</strong> <span id="modalClientNum"></span></p>
                                    <p><strong>DP Number:</strong> <span id="modalDpNum"></span></p>
                                    <p><strong>Grave Number:</strong> <span id="modalGraveNo"></span></p>
                                    <p><strong>Date of Birth:</strong> <span id="modalDateofBirth"></span></p>
                                    <p><strong>Date of Death:</strong> <span id="modalDateOfDeath"></span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date of Buried:</strong> <span id="modalDateofBuried"></span></p>
                                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                                    <p><strong>Status Column:</strong> <span id="modalStatCol"></span></p>
                                    <p><strong>Area Number:</strong> <span id="modalAreaNo"></span></p>
                                    <p><strong>Grave Type:</strong> <span id="modalGraveType"></span></p>
                                    <p><strong>Buried Status:</strong> <span id="modalBuriedStatus"></span></p>
                                    <p><strong>Maintenance Status:</strong> <span id="modalMaintenanceStatus"></span></p>
                                    <p><strong>Last Maintenance Date:</strong> <span id="modalLastMaintenanceDate"></span></p>
                                </div>
                            </div>
                            <div class="alert" id="modalAlert" role="alert">
                                <span id="modalAlertMessage"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
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
   $(document).ready(function() {
    $('.viewDetails').on('click', function() {
        var clientNum = $(this).data('clientnum');
        var dpNum = $(this).data('dpnum');
        var firstName = $(this).data('firstname');
        var lastName = $(this).data('lastname');
        var graveNo = $(this).data('graveno');
        var dateofBirth = $(this).data('dateofbirth');
        var dateOfDeath = $(this).data('dateofdeath');
        var dateofBuried = $(this).data('dateofburied');
        var status = $(this).data('status');
        var statCol = $(this).data('statcol');
        var areaNo = $(this).data('areano');
        var graveType = $(this).data('gravetype');
        var buriedStatus = $(this).data('buriedstatus');
        var maintenanceStatus = $(this).data('maintenancestatus');
        var lastMaintenanceDate = $(this).data('lastmaintenancedate');
        var alertClass = $(this).data('alertclass');
        var alertMessage = $(this).data('alertmessage');

        $('#modalClientNum').text(clientNum);
        $('#modalDpNum').text(dpNum);
        $('#modalFirstName').text(firstName);
        $('#modalLastName').text(lastName);
        $('#modalGraveNo').text(graveNo);
        $('#modalDateofBirth').text(dateofBirth);
        $('#modalDateOfDeath').text(dateOfDeath);
        $('#modalDateofBuried').text(dateofBuried);
        $('#modalStatus').text(status);
        $('#modalStatCol').text(statCol);
        $('#modalAreaNo').text(areaNo);
        $('#modalGraveType').text(graveType);
        $('#modalBuriedStatus').text(buriedStatus);
        $('#modalMaintenanceStatus').text(maintenanceStatus);
        $('#modalLastMaintenanceDate').text(lastMaintenanceDate);

        $('#modalAlert').removeClass('alert-danger alert-warning alert-info alert-success').addClass(alertClass);
        $('#modalAlertMessage').text(alertMessage);

        $('#graveDetailsModal').modal('show');
    });

    // Close the modal when the user clicks the close button
    $('.close').on('click', function() {
        $('#graveDetailsModal').modal('hide');
    });
});

</script>

<script src="script2.js"></script>
</body>
</html>
