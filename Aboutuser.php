<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Himlayan ng Bayan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
    <link rel="stylesheet" href="css/user.css">
    <style>
        /* Custom CSS for the carousel */
        .carousel {
            width: 100%;
            height: 100vh; /* Make it full height of the viewport */
            overflow: hidden; /* Hide overflow */
        }
        
        .carousel-inner {
            width: 100%;
            height: 100%;
        }
        
        .carousel-inner .item {
            width: 100%;
            height: 100%;
        }
        
        .carousel-inner .item img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure images cover the entire slide */
        }
            /* Custom CSS for rounded carousel indicators */
    .carousel-indicators {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }

    .carousel-indicators li {
        width: 10px; /* Adjust the size of the indicator */
        height: 10px; /* Adjust the size of the indicator */
        background-color: rgba(94, 150, 227, 0.5); /* Change the color of the indicator */
        border-radius: 75%; /* Make the indicator round */
        margin: 0 5px; /* Adjust spacing between indicators */
        cursor: pointer;
    }

    .carousel-indicators .active {
        background-color: rgba(235, 230, 230, 0.9); /* Change the color of the active indicator */
    }
    </style>
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
                    <li class="nav-item"><a class="nav-link" href="login_form.php" style="font-size: 10px; color:white;">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    &nbsp;
    &nbsp;

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"> </li>
            <li data-target="#myCarousel" data-slide-to="1"> </li>
            <li data-target="#myCarousel" data-slide-to="2"> </li>
            <li data-target="#myCarousel" data-slide-to="3"> </li>
            <li data-target="#myCarousel" data-slide-to="4"> </li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <section class="clean-block clean-hero" style="background-image:url(&quot;assets/img/foggyforest.jpg&quot;);color:rgba(9, 162, 255, 0);">
                    <div class="text">
                        <h2 style="text-align:center; font-size:25px; ">About the System</h2>
                    </div>
                </section>
            </div>

            <div class="item">
                <section class="clean-block clean-hero" style="background-image:url(&quot;assets/img/dahon.webp&quot;);color:rgba(9, 162, 255, 0);">
                    <div class="container">    
                        <div class="block-heading">
                            <div style="font-weight:bold; color:White;">
                                <h2 style="text-align:center; font-size:25px; ">Introduction</h2>
                                <p style="font-size:15px; text-align:justify; ">
                                    Welcome to our Cemetery Information System! We are dedicated to providing a modern and efficient platform for cemetery management and memorialization. Our system aims to streamline administrative processes, enhance visitor experiences, and preserve the rich heritage of our cemetery. With advanced technology and a user-friendly interface, we strive to meet the evolving needs of our community and honor the memory of those who have been laid to rest here.
                                </p> 
                            </div>
                        </div>
                    </div>          
                </section>
            </div>
          
            <div class="item">
                <section class="clean-block clean-hero" style="background-image:url(&quot;assets/img/dahon.webp&quot;);color:rgba(9, 162, 255, 0);">
                    <div class="container">    
                        <div class="block-heading">
                            <div style="font-weight:bold;">
                                <h2 style="text-align: center; font-size:25px; ">Mission</h2>
                                <p style="font-size:15px; text-align:justify;"> 
                                    Our mission is to create a comprehensive and accessible Cemetery Information System that simplifies cemetery operations, empowers visitors, and fosters a sense of connection to our shared history.  Through our system, we seek to honor the memory of individuals while providing a supportive and informative platform for families, historians, and visitors.
                                </p>
                            </div>    
                        </div>
                    </div>          
                </section>
            </div>
            <div class="item">
                <section class="clean-block clean-hero" style="background-image:url(&quot;assets/img/dahon.webp&quot;);color:rgba(9, 162, 255, 0);">
                    <div class="container">    
                        <div class="block-heading">
                            <div style="font-weight:bold;">
                                <h2 style="text-align: center; font-size:25px; ">Vision</h2>
                                <p style="font-size:15px; text-align:justify;">
                                    We envision a future where our Cemetery Information System becomes a vital resource for all who have a connection to our cemetery. We aspire to be at the forefront of cemetery management technology, continuously improving our system to meet the needs of our community. We envision a platform that fosters a deeper understanding and appreciation of our cemetery's history, culture, and natural beauty, making it a place of remembrance and reflection for generations to come.
                                </p>
                            </div>
                        </div>
                    </div>          
                </section>
              </div>
            
              <div class="item">
                <section class="clean-block clean-hero" style="background-image:url(&quot;assets/img/dahon.webp&quot;);color:rgba(9, 162, 255, 0);">
                    <div class="container">    
                        <div class="block-heading">
                            <div style="font-weight:bold;">
                                <h2 style="text-align: center; font-size:25px; ">Privacy and Security</h2>
                                <p style="font-size:15px; text-align:justify;">
                                    At our Cemetery Information System, privacy and security are of utmost importance to us. We understand the sensitivity and confidentiality of the data entrusted to us. We have implemented robust security measures to protect all personal information, burial records, and other data shared through our system. Our platform complies with industry standards and employs encryption protocols to safeguard data transmission and storage. We are committed to maintaining the privacy of our users and ensuring that their information remains secure at all times.
                                </p>
                            </div>
                        </div>
                    </div>          
                </section>
              </div>
              <div class="item">
                <section class="clean-block clean-hero" style="background-image:url(&quot;assets/img/dahon.webp&quot;);color:rgba(9, 162, 255, 0);">
                    <div class="container">    
                        <div class="block-heading">
                            <div style="font-weight:bold;">
                                <h2 style="text-align: center; font-size:25px; ">What's for</h2>
                                <p style="font-size:15px; text-align:justify;">
                                    It is a showcase of Filipino art and culture and a testimony to the courage and strength of the Filipino soul. With the assistance of the Bayaning Filipino Foundation, Inc., HPI became a home to the remains of two Filipino historical figures, Melchora “Tandang Sora” Aquino and Emilio Jacinto. Although Tandang Sora’s remains were already transferred in 2011 to her own national shrine at Banlat Road, Quezon City, HPI took pride in commemorating her bravery, patriotism, and kindness through a mural which is still maintained as of this day.
                                The Tandang Sora shrine at Himlayang Pilipino Memorial Park can also be remembered as the site where the prestigious Tandang Sora Awards Ceremony was annually held to honor outstanding Filipino women in their respective fields of endeavor. The once 5-hectare Park has now grown to over 37 hectares, and is continuing to develop. Today, HPI is one of the leaders in the industry.
                                </p>
                            </div>
                        </div>
                    </div>          
                </section>
              </div>
        </div> 

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

      <!-- Footer -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
