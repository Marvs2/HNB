<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Himlayan ng Bayan</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
    <link rel="stylesheet" href="css/user.css">
    <style>
      /* Custom CSS for Navbar */
      .navbar {
          height: 80px; /* Decrease the height of the navbar */
      }

      /* Custom CSS for Hero Sections */
      .clean-hero {
          background-size: cover;
          background-position: center;
          color: rgb(12, 11, 11);
          padding: 50px 0;
          text-align: center;
      }

      /* Custom CSS for Text Content */
      .block-heading {
          font-size: 20px;
      }

      /* Custom CSS for Responsive Box */
      /* #box {
            background-color: rgba(194, 48, 48, 0.8);
            border-radius: 20px;
            padding: 10px;
            margin: 10px;
            max-width: 500px;
            max-height: 400px; Adjust max height as needed
        } */
        #box {
    background-color: rgba(92, 115, 198, 0.8);
    border-radius: 20px;
    padding: 20px;
    margin: 20px;
    width: 100%; /* Make the box fill the width of its container */
    height: 100%; /* Make the box fill the height of its container */
}

.scroll-box {
    max-width: 100%; /* Adjust max width to fit the container */
    max-height: 100%; /* Adjust max height to fit the text */
    overflow-x: hidden; /* Hide the horizontal scrollbar */
    overflow-y: hidden; /* Show vertical scrollbar when needed */
    animation: scroll-text 60s linear infinite; /* Animation for scrolling */
    font-size: 16px; /* Adjust font size as needed */
    line-height: 1.5; /* Adjust line height as needed */
}

.boom {
    width: 100%; /* Make the .boom content fill the width of the box */
    height: 100%; /* Make the .boom content fill the height of the box */
    white-space: pre-line; /* Allow wrapping */
    text-align: justify;
}


      /* Custom CSS for Footer */
      .footer {
        color:white;
          padding: 10px 0;
          background-color: #032030;
      }

      /* .scroll-box {
    max-width: 80vw; Adjust the percentage as needed
    max-height: 100%; Adjust max height to fit the text
    white-space: pre-line; Allow wrapping
    overflow-x: hidden; Hide the horizontal scrollbar
    overflow-y: hidden; Show vertical scrollbar when needed
    animation: scroll-text 60s linear infinite; Animation for scrolling
} */

      /* @keyframes scroll-text {
          0% { transform: translateY(100%); }
          100% { transform: translateY(-100%); }
      } */
  </style>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg- #000d1a clean-navbar" style="background-color: #032030;">
        <div class="container">
        <a class="navbar-brand logo" href="#" style="font-family: Arial, sans-serif; font-weight: bold; font-size: 20px; color: white;">Himlayan ng Bayan</a>
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
    <div class="page landing-page">
        <section class="clean-block clean-hero" style="background-image:url('assets/img/homepage.jpg'); color:rgba(9, 162, 255, 0); background-size: cover; background-position: center;">
            <div class="text" style="color: rgb(45, 24, 24);">
                <h2>Find a grave!!</h2>
                <p>Register the grave of your loved one for easy search and tracking of their grave</p>
            </div>
        </section>
        <section class="clean-block clean-hero" style="background-image:url('assets/img/login.jpg');color:rgba(9, 162, 255, 0); background-size: cover; background-position: center;">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-items-center"> <!-- Adjusted size to medium -->
                <h1 class="text-secondary" style="font-size: 2.3vw; color:white;">Himlayang Pilipino Memorial Park</h1>
            </div>
            <div class="col-lg-6 d-flex align-items-center justify-content-center"> <!-- Adjusted size to medium -->
                <div id="box">
                    <div class="scroll-box">
                          <div class="boom">
                                In 1971, the Aguirre Group acquired a 5-hectare memorial park located at Brgy. Pasong Tamo, Quezon City from its original owners, the Francisco Bautista family. The new management of Himlayang Pilipino, Inc. paved way to the introduction of a unique memorial park concept. In planning the development of the memorial park, the Company deviated from the traditionally Western orientation of existing memorial parks. The Himlayang Pilipino Memorial Park is made to symbolize the Filipino spirit and reflect the history and culture of the country.
                        </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </section>
    </div>
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted" style="background-color:rgba(9, 162, 255, 0);">

        <!-- Section: Links  -->
        <section class="footer">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3" style="font-size: 13px">Contact no.</i>
                            <Span style="font-size: 13px"> 09123456789</Span>
                        </h6>
                        <p style="font-size: 13px"><span style="font-size: 13px"> Email: <a href="gmailto:himlayanngbayan@gmail.com" style="font-size: 15px">himlayanngbayan@gmail.com</a></span></p>
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
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                        </h6>
                    </div>

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <button class="buttonfoot"><a href="contact.php" class="text-uppercase fw-bold bg-transparent mb-4" style="background-color: rgb(35, 115, 10); font-size: 13px;">Himlayan Map</a></button>
                        <p><button class="buttonfoot"><a href="FAQs.php" class="text-uppercase fw-bold bg-transparent mb-4 " style="background-color: rgb(35, 115, 10); font-size: 13px;">FAQs</a></button></p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

    </footer>
    <!-- Footer -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>

</body>

</html>
