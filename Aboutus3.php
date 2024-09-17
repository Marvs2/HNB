<?php
session_start();
include 'config.php'; // Include the config file to define $conn
include 'query.php';
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
    <link rel="stylesheet" href="css/user.css">
    <title>Search Deceased Person</title>
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg- #000d1a clean-navbar" style="background-color: #032030; height: 80px;">
        <div class="container">
            <a class="navbar-brand logo" href="#" style="font-family: Arial, sans-serif font-weight: bold; font-size:20px; color:white;">Himlayan ng Bayan</a>
            {{-- <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button> --}}
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php" style="font-size: 10px; color:white;">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="Aboutus3.php" style="font-size: 10px; color:white;">Deceased</a></li>
                    <li class="nav-item"><a class="nav-link" href="Aboutuser.php" style="font-size: 10px; color:white;">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="loginform.php" style="font-size: 10px; color:white;">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    &nbsp;
    &nbsp;
<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="profile">
            <?php
            $user_data = get_user_data(1); // Pass the position value directly
            if ($user_data !== null) {
                echo $user_data['firstname'];
            } else {
                echo "Connection is null!";
            }
            ?>
        </a>
    </nav>
    <!-- MAIN -->
    <main>
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
    </main>
    <!-- MAIN -->
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
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
