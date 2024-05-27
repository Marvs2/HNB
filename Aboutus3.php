<?php
session_start();
include 'config.php'; // Include the config file to define $conn
include 'query.php';

$search = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = trim($_POST['search']);
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
                    <table id="searchTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($search)) {
                            $conn = mysqli_connect("localhost", "root", "", "user_db");
                            $search = mysqli_real_escape_string($conn, $search);
                            $query = "SELECT * FROM areano1 WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR middlename LIKE '%$search%'";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $index => $dperson) {
                                    ?>
                                    <tr>
                                        <td><?= $dperson['firstname']; ?></td>
                                        <td><?= $dperson['lastname']; ?></td>
                                        <td>
                                            <a class="btn btn-primary btn-sm viewSelection"
                                               data-toggle="modal"
                                               data-target="#displayPerson"
                                               data-darea="Area: <?php echo ceil($dperson['graveNo'] / 60) ?>"
                                               data-graveno="Graveyard: <?php echo $dperson['graveNo'] ?>"
                                               data-name="<?php echo $dperson['firstname'] . ' ' . $dperson['lastname'] . ' ' . $dperson['middlename'] ?>"
                                               data-death="<?php echo $dperson['dateOfDeath'] ?>"
                                               data-birth="<?php echo $dperson['dateofBirth'] ?>"
                                               data-dareaimg="images/area<?php echo $index + 1 ?>.webp" href="#">View</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='3'><h5>No Record Found</h5></td></tr>";
                            }
                            mysqli_close($conn);
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN -->

    <!-- Modal -->
    <div class="modal fade" id="displayPerson" tabindex="-1" role="dialog" aria-labelledby="displayPersonLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="displayPersonLabel">Deceased Person Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="darea"></p>
                    <p id="graveno"></p>
                    <p>Deceased Name: <span id="name"></span></p>
                    <p>Date of Birth: <span id="birth"></span></p>
                    <p>Date of Death: <span id="death"></span></p>
                    <img src="#" alt="area image" id="img-links" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button id="closeModalBtns" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
