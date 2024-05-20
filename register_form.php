<?php
session_start();
include 'config.php';
//include 'query.php';


if(isset($_POST['signup'])){

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$mname = $_POST['middlename'];
$email =  $_POST['email'];
$contact =$_POST['contact'];
$birthday = $_POST['birthday'];
$position =$_POST['position'];
$pass = ($_POST['password']);
$hash = password_hash( $_POST['password'], PASSWORD_DEFAULT);
$message = "$fname $lname would like to request an account.";


$query = "INSERT INTO `requests` (`id`, `firstname`, `lastname`, `middlename`,`email`, `contact`, `birthday`, `position`,`password`,`password_hash`,`message`, `date`) 
      VALUES(NULL, '$fname','$lname','$mname','$email', '$contact', '$birthday', '$position','$pass','$hash','$message', CURRENT_TIMESTAMP)";
         if(performQuery($query)){
             // Return success message as response to AJAX request
          echo "<script language='javascript'>alert('Successfully Requested, Wait for the approval')</script>";
         }else{
             // Return error message as response to AJAX request
             echo "<script>alert('Unknown error occured.')</script>";
         }
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign-Up</title>
   <script
   src="https://code.jquery.com/jquery-3.7.0.min.js"
   integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
   crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style1.css">

</head>
<body>
   <div class="form-container">
      <form id="signup-form" method="post">
         <h3>Sign-up</h3>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            };
         };
         ?>
         <label for="fname">Enter your Firstname</label><br>
         <input type="text" name="firstname" required placeholder="Firstname">
         <label for="lname">Enter your Lastname</label><br>
         <input type="text" name="lastname" required placeholder="Lastname">
         <label for="mname">Enter your Middlename </label><br>
         <input type="text" name="middlename" required placeholder="Middlename">
         <label for="email">Enter your email</label><br>
         <input type="email" name="email" required placeholder="Email">
         <label for="contacts">Contact Number</label><br>
         <input type="contacts" name="contact" required placeholder="Active Contact Number: +639123456789">
         <label for="Date">Date of Birth</label><br>
         <input type="date" name="birthday" required placeholder="date">
         <label for="">Position</label>
         <select name="position" class="form-control">
            <option value="">Select Position</option>
            <option value="1"> Admin </option>
            <option value="2"> Staff </option>
         </select><br>
         <label for="password">Create Password</label><br>
         <input type="password" name="password" required placeholder="Create your password">
         <label for="password">Repeat Password</label><br>
         <input type="password" name="repeat-password" required placeholder="confirm your password">
         <input type="submit" name="signup" value="Sign-up now" class="form-btn signup">
         <p>already have an account? <a href="login_form.php">login now</a></p>
      </form>
   </div>
   
   <!-- Include jQuery -->
   <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
   <!-- Include SweetAlert -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
   
   <!-- Custom JavaScript -->
   <script>
   $(document).ready(function() {
      $('.signup').on('submit', function(event) {
         event.preventDefault();
   
         // Get form data
         const formData = $(this).serialize();
   
         // AJAX post request to handle form submission
         $.ajax({
            type: 'POST',
            url: 'query.php', // URL of the PHP processing file
            data: formData,
            success: function(response) {
               // Display SweetAlert success message on successful form submission
               if (response === "success") {
                  Swal.fire({
                     icon: 'success',
                     title: 'Good job!',
                     text: 'You successfully signed up!',
                     showConfirmButton: false,
                     timer: 2000 // Display for 2 seconds
                  }).then(function() {
                     // Redirect to another page after displaying the success message (optional)
                     window.location.href = 'login_form.php';
                  });
               } else {
                  // Display error message if form submission fails
                  Swal.fire({
                     icon: 'error',
                     title: 'Oops...',
                     text: 'Something went wrong! Please try again.',
                  });
               }
            },
            error: function() {
               // Display error message if form submission fails
               Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong! Please try again.',
               });
            }
         });
      });
   });
   </script>

</body>
</html>