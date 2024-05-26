<?php
session_start();
include 'config.php'; // Assuming you have the database configuration in this file

if (isset($_POST['submit'])) {
    // Establish connection to the database
    $conn = mysqli_connect('localhost', 'root', '', 'user_db') or die('Connection failed');

    // Get form input values and sanitize them
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $status = 'Inactive'; // Set status as Inactive

    // Insert user data into the 'user_form' table
    $query = "INSERT INTO `user_form`(`firstname`, `middlename`, `lastname`, `email`, `contact`, `birthday`, `position`, `password`, `password_hash`, `status`) 
              VALUES ('$firstname', '$middlename', '$lastname', '$email', '$contact', '$birthday', '$position', '$password', '$password_hash', '$status')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = 'success';
    } else {
        $_SESSION['message'] = 'error';
    }

    // Close the database connection
    mysqli_close($conn);
    
    // Redirect to the same page to display the notification
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registration Form</title>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<div class="form-container">
   <form action="" method="POST">
      <h3>Register Now</h3>
      <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<span class="error-msg">' . $msg . '</span><br>';
            }
        }
      ?>
      <label for="firstname">First Name</label><br>
      <input type="text" name="firstname" required placeholder="Enter your first name"><br>
      
      <label for="middlename">Middle Name</label><br>
      <input type="text" name="middlename" required placeholder="Enter your middle name"><br>
      
      <label for="lastname">Last Name</label><br>
      <input type="text" name="lastname" required placeholder="Enter your last name"><br>
      
      <label for="email">Email</label><br>
      <input type="email" name="email" required placeholder="Enter your email"><br>
      
      <label for="contact">Contact</label><br>
      <input type="text" name="contact" required placeholder="Enter your contact number"><br>
      
      <label for="birthday">Birthday</label><br>
      <input type="date" name="birthday" required><br>
      
      <label for="position">Position</label>
      <select name="position" class="form-control">
         <option value="">Select Position</option>
         <option value="1">Admin</option>
         <option value="2">Staff</option>
      </select><br>
      
      <label for="password">Password</label><br>
      <input type="password" name="password" required placeholder="Enter your password"><br>
      
      <input type="submit" name="submit" value="Register Now" class="form-btn"><br>
      <p>Already have an account? <a href="login_form.php">Login now</a></p>
   </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    <?php
    if (isset($_SESSION['message'])) {
        if ($_SESSION['message'] == 'success') {
            echo "Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful',
                    text: 'You have been successfully registered!',
                  //   position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });";
        } elseif ($_SESSION['message'] == 'error') {
            echo "Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: 'There was an error registering your account. Please try again.',
                  //   position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });";
        }
        unset($_SESSION['message']); // Clear the message after displaying it
    }
    ?>
});
</script>

</body>
</html>
