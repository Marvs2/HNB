<?php
session_start();
include 'config.php'; // Assuming you have the database configuration in this file

if (isset($_POST['admin_signup'])) {
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


// Fetch the last clientNum value from the database to determine the starting point
$result = $conn->query("SELECT clientNum FROM client_form ORDER BY clientNum DESC LIMIT 1");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastClientNum = intval(substr($row['clientNum'], 2)); // Get the numeric part of the clientNum
} else {
    $lastClientNum = 999; // Start from Cl1000 if no records are found
}

if (isset($_POST['client_signup'])) {
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

    // Generate the new clientNum
    $clientNum = 'Cl' . (++$lastClientNum);

    // Insert user data into the 'user_form' table
    $query = "INSERT INTO `client_form`(`clientNum`, `firstname`, `middlename`, `lastname`, `email`, `contact`, `birthday`, `position`, `status`, `password`, `password_hash`) 
              VALUES ('$clientNum', '$firstname', '$middlename', '$lastname', '$email', '$contact', '$birthday', '$position', '$status', '$password', '$password_hash')";

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
      body {
          font-family: Arial, sans-serif;
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
          margin: 0;
          position: relative;
          overflow: hidden;
      }
      .svg-background {
         background-color: #0e4166;
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: -1;
      }
      .form-container {
        display: flex;
        width: 900px;
        height: 650px;
        color: #fff; /* Fallback color */
        background-image: linear-gradient(to bottom, #bf560f, darkgreen); /* Gradient */
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
        z-index: 1;
      }

      .white-section, .color-section {
          flex: 1;
          padding: 15px;
          transition: opacity 0.3s ease-in-out, background-color 0.3s ease-in-out;
      }
      .white-section {
          background-color: #2a683f;
          color: #fff;
      }
      .color-section {
          background-color: #0b5b40;
          color: #fff;
      }
      .form-container:hover .white-section {
         opacity: 0.1;
      }
      .form-container:hover .color-section {
          opacity: 0.1;
      }
      .form-container .white-section:hover {
          opacity: 1;
          background-color: #1e5333;
      } 
      .form-container .color-section:hover ~ .white-section,  {
         filter: blur(2px);
          /* color: #0b5b40;*/
          /* background-color: #0b5b40; 
          */
      }
      .form-container .white-section:hover ~ .color-section,  {
         filter: blur(2px);
          /* color: #0b5b40;
          background-color: #0b5b40; */
      }
      .form-container .color-section:hover {
          opacity: 1;
          background-color: #0b5b40;
      }
      .form-container h1 {
          margin-bottom: 10px;
          align-items: center; /*its not working*/
          padding: 20px;
      }
      .form-container label {
          display: block;
          margin-top: 5px;
      }
      .form-container input[type="text"],
      .form-container input[type="email"],
      .form-container input[type="password"],
      .form-container input[type="date"],
      .form-container input[type="contacts"],
      .form-container select {
          width: 100%;
          padding: 12px;
          margin: 4px 0 15px;
          border: 1px solid #ccc;
          border-radius: 5px;
      }
      .form-btn {
          width: 100%;
          padding: 12px;
          background-color: #0b5b40;
          border: none;
          color: white;
          cursor: pointer;
          border-radius: 5px;
      }
      .form-btn:hover {
          background-color: #084d34;
      }
      .form-container p {
          margin-top: 20px;
          text-align: center;
      }
      .form-container a {
          color: #0b5b40;
          text-decoration: none;
      }
      .form-container a:hover {
          text-decoration: underline;
      }
      .color-section a {
          color: #fff;
      }
      .form-columns {
          display: flex;
          flex-wrap: wrap;
          gap: 10px;
      }
      .form-columns .form-group {
          flex: 1 1 calc(50% - 20px);
          min-width: calc(50% - 20px);
      }
      @media (max-width: 600px) {
          .form-columns .form-group {
              flex: 1 1 100%;
              min-width: 100%;
          }
      }
  </style>
</head>
<body>
   <svg class="svg-background" version="1.1" xmlns="http://www.w3.org/2000/svg"
   xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="100%" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">
   <defs>
      <linearGradient id="bg">
         <stop offset="0%" style="stop-color:rgba(130, 158, 249, 0.06)"></stop>
         <stop offset="50%" style="stop-color:rgba(76, 190, 255, 0.6)"></stop>
         <stop offset="100%" style="stop-color:rgba(115, 209, 72, 0.2)"></stop>
      </linearGradient>
      <path id="wave" fill="url(#bg)" d="M-363.852,502.589c0,0,236.988-41.997,505.475,0
s371.981,38.998,575.971,0s293.985-39.278,505.474,5.859s493.475,48.368,716.963-4.995v560.106H-363.852V502.589z" />
   </defs>
   <g>
      <use xlink:href='#wave' opacity=".3">
         <animateTransform
       attributeName="transform"
       attributeType="XML"
       type="translate"
       dur="10s"
       calcMode="spline"
       values="270 230; -334 180; 270 230"
       keyTimes="0; .5; 1"
       keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
       repeatCount="indefinite" />
      </use>
      <use xlink:href='#wave' opacity=".6">
         <animateTransform
       attributeName="transform"
       attributeType="XML"
       type="translate"
       dur="8s"
       calcMode="spline"
       values="-270 230;243 220;-270 230"
       keyTimes="0; .6; 1"
       keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
       repeatCount="indefinite" />
      </use>
      <use xlink:href='#wave' opacity=".9">
         <animateTransform
       attributeName="transform"
       attributeType="XML"
       type="translate"
       dur="6s"
       calcMode="spline"
       values="0 230;-140 200;0 230"
       keyTimes="0; .4; 1"
       keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
       repeatCount="indefinite" />
      </use>
   </g>
</svg>
<div class="form-container">
    <div class="white-section">
        <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<span class="error-msg">' . $msg . '</span><br>';
            }
        }
      ?>
        <form id="signup-form" method="post">
            <h1>Sign-up for Admin</h1>
            <div class="form-columns">
                <div class="form-group">
                    <label for="fname">Enter your Firstname</label>
                    <input type="text" name="firstname" required placeholder="Firstname">
                </div>
                <div class="form-group">
                    <label for="lname">Enter your Lastname</label>
                    <input type="text" name="lastname" required placeholder="Lastname">
                </div>
                <div class="form-group">
                    <label for="mname">Enter your Middlename</label>
                    <input type="text" name="middlename" required placeholder="Middlename">
                </div>
                <div class="form-group">
                    <label for="email">Enter your email</label>
                    <input type="email" name="email" required placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="contacts">Contact Number</label>
                    <input type="contacts" name="contact" required placeholder="Active Contact Number: +639123456789">
                </div>
                <div class="form-group">
                    <label for="Date">Date of Birth</label>
                    <input type="date" name="birthday" required>
                </div>
                <div class="form-group">
                    <label for="position">Position</label>
                    <select name="position" class="form-control">
                        <option value="">Select Position</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Create Password</label>
                    <input type="password" name="password" required placeholder="Create your password">
                </div>
            </div>
            <input type="submit" name="admin_signup" value="Sign-up now" class="form-btn signup">
            <p>Already have an account? <a href="loginform.php" style="color: #fff">login now</a></p>
        </form>
    </div>
    <div class="color-section">
        <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<span class="error-msg">' . $msg . '</span><br>';
            }
        }
      ?>
        <form id="signup-form" method="post">
            <h1>Sign-up for Client</h1>
           <div class="form-columns">
            <div class="form-group">
                <label for="fname">Enter your Firstname</label>
                <input type="text" name="firstname" required placeholder="Firstname">
            </div>
            <div class="form-group">
                <label for="lname">Enter your Lastname</label>
                <input type="text" name="lastname" required placeholder="Lastname">
            </div>
            <div class="form-group">
                <label for="mname">Enter your Middlename</label>
                <input type="text" name="middlename" required placeholder="Middlename">
            </div>
            <div class="form-group">
                <label for="email">Enter your email</label>
                <input type="email" name="email" required placeholder="Email">
            </div>
            <div class="form-group">
                <label for="contacts">Contact Number</label>
                <input type="contacts" name="contact" required placeholder="Active Contact Number: +639123456789">
            </div>
            <div class="form-group">
                <label for="Date">Date of Birth</label>
                <input type="date" name="birthday" required>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <select name="position" class="form-control">
                    <option value="">Select Position</option>
                    <option value="2">Staff</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Create Password</label>
                <input type="password" name="password" required placeholder="Create your password">
            </div>
        </div>        
            <input type="submit" name="client_signup" value="Register now" class="form-btn signup" style="background-color:#0b5b40">
            <p>Already have an account? <a href="loginform.php">login now</a></p>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        <?php
        if (isset($_SESSION['message'])) {
            if ($_SESSION['message'] == 'success') {
                echo "Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful',
                        text: 'successfully registered! wait for approval',
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