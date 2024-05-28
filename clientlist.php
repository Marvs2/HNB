<?php
session_start();
include 'config.php';
include 'query.php';

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

function searchAllTables($conn, $search)
{
    $tableNames = array('areano1', 'areano2', 'areano3', 'areano4', 'areano5', 'areano6', 'areano7', 'areano8');
    $results = array();

    foreach ($tableNames as $tableName) {
        $query = "SELECT * FROM $tableName WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR middlename LIKE '%$search%' OR graveNo LIKE '%$search%' OR areaNo LIKE '%$search%'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
        }
    }

    return $results;
}

if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $searchResults = searchAllTables($conn, $search);
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
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Search Deceased Person Details</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search by name..." name="search" value="<?php echo $search ?? ''; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                        <!-- Your HTML code goes here -->

                        <?php if (isset($searchResults) && !empty($searchResults)): ?>
                        <table id="searchTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Grave No</th>
                                    <th>Area No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($searchResults as $dperson): ?>
                                    <tr>
                                        <td><?= $dperson['firstname']; ?></td>
                                        <td><?= $dperson['middlename']; ?></td>
                                        <td><?= $dperson['lastname']; ?></td>
                                        <td><?= $dperson['graveNo']; ?></td>
                                        <td><?= $dperson['areaNo']; ?></td>
                                        <td>
                                            <!-- Your action buttons or links go here -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <p>No records found.</p>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
        <div class="table-data">
            
            <div class="todo">
                <h1>Map per Area Given</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Button 1 -->
                            <button class="btn btn-primary btn-block mb-3"><a href="Area1.php">Area 1</a></button>
                            <!-- Area 2 -->
                            <button class="btn btn-primary btn-block mb-3"><a href="Area2.php">Area 2</a></button>
                            <!-- Area 3 -->
                            <button class="btn btn-primary btn-block mb-3">Area 3</button>
                            <!-- Area 4 -->
                            <button class="btn btn-primary btn-block mb-3">Area 4</button>
                        </div>
                        <div class="col-md-6">
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
<script>
    $(document).ready(function() {
        $('.viewSelection').on('click', function() {
            $('#darea').text($(this).data('darea'));
            $('#graveno').text($(this).data('graveno'));
            $('#name').text($(this).data('name'));
            $('#birth').text($(this).data('birth'));
            $('#death').text($(this).data('death'));
            $('#img-links').attr('src', $(this).data('dareaimg'));
            var modal = new bootstrap.Modal(document.getElementById('displayPerson'));
            modal.show();
        });
    });

    var closeModalBtn = document.getElementById("closeModalBtns");
    
    // Add a click event listener to the button
    closeModalBtns.addEventListener("click", function() {
        // Perform the redirection to index2-view.php
        window.location.href = "Aboutus3.php";
    });

    $(document).ready(function() {
        $('#searchTable').DataTable();
    });
</script>
<script src="script2.js"></script>
</body>
</html>