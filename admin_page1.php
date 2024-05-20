<?php  
 $conn = mysqli_connect('localhost','root','','user_db'); 
 $query ="SELECT * FROM dperson";  
 $result = mysqli_query($conn, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
           <title>Himalayan ng bayan</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
           <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
           <script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
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
               <a href="admin_page1.php">Home</a>
             </div>
        <!--<nav class="navbar navbar-light navbar-expand-lg fixed-top bg- #000d1a clean-navbar" style="background-color:  #032030; height: 120px;">
            <div class="container"><a class="navbar-brand logo" href="#" style="font-family: Copperplate, Papyrus, Fantasy; font-weight: bold; font-size:35px; color:white;">Himlayan ng Bayan</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php" style="font-size: 15px; color:white;">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="service.php">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="Aboutus3.php" style="font-size: 15px; color:white;">Deceased</a></li>
                        <li class="nav-item"><a class="nav-link" href="Aboutuser.php" style="font-size: 15px; color:white;">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="login_form.php" style="font-size: 15px; color:white;">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>-->
        <main class="page landing-page">
            <br /><br />  
           <div class="container">  
                <h3 text-align="Left">List of the Dead</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Firstname</td>
                                    <td>Lastname</td>
                                    <td>Middlename </td>  
                                    <td>DofBirth</td>  
                                    <td>DofDeath</td>  
                                    <td>Graveno</td>  
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["firstname"].'</td>  
                                    <td>'.$row["lastname"].'</td>  
                                    <td>'.$row["middlename"].'</td>  
                                    <td>'.$row["DofBirth"].'</td>  
                                    <td>'.$row["DofDeath"].'</td>
                                    <td>'.$row["Graveno"].'</td>    
                               </tr>  
                               ';  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
        </main>
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/bootstrap/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
            <script src="assets/js/smoothproducts.min.js"></script>
            <script src="assets/js/theme.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>    
            <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
            <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
            
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#dperson_data').dataTable({  
      "pagingType": "10",
           "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
 
          });
     });         
 </script>  