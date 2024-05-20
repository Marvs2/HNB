<?php
    session_start();
    require 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="User.css">
  </head>
    <body>
    <div class="topnav" id="myTopnav">
    <div class="topnav-1" style="font-size:3vw;">	
      <a href="#index" class="active">CEMETERY INFORMATION SYSTEM</a>
    </div>
      <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
      <a href="dperson-view.php">Deceased Person</a>
      <a href="dperson-create.php">Add Dead Person</a>
      <a href="Aboutus.php">About Us</a>
    </div>
  
    <div class="container mt-4">

        <?php include('message.php'); ?>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                        <div class="card-header">
                            <h4 style="padding-bottom: 10px;">View of the Dead</h4>
                                <form action="" method="GET">
                                    <div class="input-group mb-7"style="padding-bottom: 15px;">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </h4>
                        </div>
                        <div class="column">
                            <div class="card mt-4">
                                <h4 style="padding-left:15px; padding-top:10px;">Result List of the Dead</h4>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Deceased Firstname</th>
                                                <th>Deceased Lastname</th>
                                                <th>Deceased Middlename</th>
                                                <th>Date of Birth</th>
                                                <th>Date of Death</th>
                                                <th>Grave number</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $conn = mysqli_connect("localhost","root","","user_db");
            
                                                if(isset($_GET['search']))
                                                {
                                                    $filtervalues = $_GET['search'];
                                                    $query = "SELECT * FROM dperson WHERE CONCAT(firstname,lastname,middlename,DofBirth,DofDeath,Graveno) LIKE '%$filtervalues%' ";
                                                    $query_run = mysqli_query($conn, $query);
            
                                                    if(mysqli_num_rows($query_run) > 0)
                                                    {
                                                        foreach($query_run as $items)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td><?= $items['firstname']; ?></td>
                                                                <td><?= $items['lastname']; ?></td>
                                                                <td><?= $items['middlename']; ?></td>
                                                                <td><?= $items['DofBirth']; ?></td>
                                                                <td><?= $items['DofDeath']; ?></td>
                                                                <td><?= $items['Graveno']; ?></td>
                                                                <td>
                                                                    <form action="code.php" method="POST" class="d-inline">
                                                                    <a href="view.php?id=<?= $items['id']; ?>" class="btn btn-info btn-sm">View</a>
                                                                    <a href="dperson-edit.php?id=<?= $items['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                                        <button type="submit" name="delete_dperson" value="<?=$items['id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                            <tr>
                                                                <td colspan="4">No Record Found</td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Deceased Person Details
                                    </h4>
                                </div>
                                <div class="card-body">

                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Middle Name</th>
                                                <th>Date of Birth</th>
                                                <th>Date of Death</th>
                                                <th>Grave Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = "SELECT * FROM dperson";
                                                $query_run = mysqli_query($conn, $query);

                                                if(mysqli_num_rows($query_run) > 0)
                                                {
                                                    foreach($query_run as $dperson)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td><?= $dperson['id']; ?></td>
                                                            <td><?= $dperson['firstname']; ?></td>
                                                            <td><?= $dperson['lastname']; ?></td>
                                                            <td><?= $dperson['middlename']; ?></td>
                                                            <td><?= $dperson['DofBirth']; ?></td>
                                                            <td><?= $dperson['DofDeath']; ?></td>
                                                            <td><?= $dperson['Graveno']; ?></td>
                                                            <td>
                                                                <a href="dperson-view.php?id=<?= $dperson['id']; ?>" class="btn btn-info btn-sm">View</a>
                                                            </td>
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
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
