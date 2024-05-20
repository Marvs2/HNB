<?php
require 'config.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Himlayan ng bayan</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
    <link rel="stylesheet" href="User.css">
</head>

<body>
  <div class="topnav" id="myTopnav">
    <div class="topnav-1" style="font-size:3vw;">	
      <a href="#index" class="active">CEMETERY INFORMATION SYSTEM</a>
    </div>
    <a href="logout.php">Logout</a>
    <a href="dperson-view.php">View</a>
    <a href="dperson-create.php">Add</a>
    <a href="admin_page.php">Home</a>
  </div>
  <main class="page landing-page">
    <div class="column">
        <div class="card mt-4">
            <h4 style="padding-left:15px; padding-top:10px;">History List of the Dead</h4>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Deceased Firstname</th>
                            <th>Deceased Lastname</th>
                            <th>Deceased Middlename</th>
                            <th>Date of Birth</th>
                            <th>Date of Death</th>
                            <th>Grave number</th>
                        </tr>
                    </thead>    
                        <tbody>
                            <?php
                            $query = "SELECT * FROM dperson";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0 )
                            {
                                foreach($query_run as $dperson)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $dperson['firstname']; ?></td>
                                        <td><?= $dperson['lastname']; ?></td>
                                        <td><?= $dperson['middlename']; ?></td>
                                        <td><?= $dperson['DofBirth']; ?></td>
                                        <td><?= $dperson['DofDeath']; ?></td>
                                        <td><?= $dperson['Graveno']; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<h5> No Record Found </h5>";
                            }
                            ?>
                        </tbody>    
                </table>
            </div>
        </div>
    </div>      
  </main>
  <!-- Footer -->
  &nbsp;
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>