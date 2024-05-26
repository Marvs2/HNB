<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>
   
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      .error-msg {
          color: red;
      }
  </style>
</head>
<body>
   
<div class="form-container">

   <form action="" method="POST">
      <h3>Login Now</h3>
      <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<span class="error-msg">' . $msg . '</span><br>';
            }
        }
      ?>
      <label for="email">Enter your Email</label><br>
      <input type="email" name="email" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : "" ?>" required placeholder="email">
      <label for="password">Enter your Password</label><br>
      <input type="password" name="password" required placeholder="password">
      <input type="submit" name="submit" value="Login Now" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register now</a> or <a href="index.php" style="color: rgb(11, 91, 64)"> BACK </a></p>
   </form>

</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){
   $conn = mysqli_connect('localhost', 'root', '', 'user_db');
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);

   $select = "SELECT * FROM user_form WHERE email = '$email'";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) == 1){
      $row = mysqli_fetch_assoc($result);
      
      // Check if the user is inactive
      if ($row['status'] == 'Inactive') {
         echo "<script>
            Swal.fire({
               icon: 'error',
               title: 'Account Inactive',
               text: 'Your account is inactive. Please contact the administrator.',
            });
         </script>";
      }
      
      // Check if password is stored as plain text
      elseif ($pass === $row['password']) {
         $_SESSION['user_id'] = $row['id']; // Store user ID in session
         $_SESSION['firstname'] = $row['firstname'];
         $_SESSION['position'] = $row['position'];
         echo "<script>
            Swal.fire({
               icon: 'success',
               title: 'Welcome " . $_SESSION['firstname'] . "!',
               showConfirmButton: false,
               timer: 1500
            }).then(() => {
               window.location.href = 'index2.php';
            });
         </script>";
      }
      // Check if password is stored as hash
      elseif (isset($row['password_hash']) && password_verify($pass, $row['password_hash'])) {
         $_SESSION['firstname'] = $row['firstname'];
         echo "<script>
            Swal.fire({
               icon: 'success',
               title: 'Welcome " . $_SESSION['firstname'] . "!',
               showConfirmButton: false,
               timer: 1500
            }).then(() => {
               window.location.href = 'index2.php';
            });
         </script>";
      } else {
         echo "<script>
            Swal.fire({
               icon: 'error',
               title: 'Oops...',
               text: 'Incorrect Email / Password!',
            });
         </script>";
      }
   } else {
      echo "<script>
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Incorrect Email / Password!',
         });
      </script>";
   }

   mysqli_close($conn);
}
?>