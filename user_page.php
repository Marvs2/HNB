<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
<link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
<link rel="stylesheet" href="assets/css/smoothproducts.css">
<link rel="stylesheet" href="css/user.css">
</head>
<body>

<div class="topnav" id="myTopnav">
  <div class="topnav-1">	
  <a href="#index" class="active">Himlayan ng Bayan</a>
  </div>
   <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
  <a href="Aboutus2.php">Deceased List</a>
  <a href="#home">Home</a>
</div>
<div class="main" style="padding-left:50px">
  <h2><b>Kalampag sa Papag Cemetery</b></h2>
  <p><b>Kalampag sa Papag Cemetery is a public cemetery, 
    our public cemetery is a peaceful and respectful final resting place for our community members. 
    We strive to provide a dignified and well-maintained environment for those who have passed away, 
    and offer a range of burial options to suit individual needs and preferences. 
    Our cemetery is open to people of all backgrounds and beliefs, 
    and we believe that every life is deserving of honor and respect. 
    As a cultural and historical resource, we are proud to preserve the legacies of those who have 
    gone before us through the markers and monuments that dot our grounds. Thank you for choosing 
    our cemetery as the final resting place for your loved ones.</b></p>
</div>
<div class="footer">
  <footer>
    <!-- Section: Links  -->
    <section class="">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>Contact :
              <Span> No. 09123456789</Span>
            </h6>
            <p>Us: <span> Email: <a href="emailto:kalampagsapapag@gmail.com"> kalampagsapapag@gmail.com</a></span></p>
          </div>
          <!-- Grid column -->
            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                </h6>
            </div>
              <!-- Grid column -->

  
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h5 class="text-uppercase fw-bold mb-4">Customer Services</h5>
            <h5 class="text-uppercase fw-bold mb-4">FAQs</h5>
          </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->
</footer>
</div>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

</body>
</html>
