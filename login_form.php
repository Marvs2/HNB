<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>
   
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="POST">
      <h3>login now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<span class="error-msg">'.$message.'</span>';
         }
      }
      ?>
      <label for="email">Enter your Email</label><br>
      <input type="email" name="email"
      value="<?php echo (isset($_GET['email']))?$_GET['email']:"" ?>"required placeholder="email">
      <label for="password">Enter your Password</label><br>
      <input type="password" name="password" required placeholder="password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a> or <a href="index.php" style="color: rgb(11, 91, 64)"> BACK </a></p>
   </form>


</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){
   $conn = mysqli_connect('localhost','root','','user_db') or die('connection failed');
   $email =$_POST['email'];
   $pass =$_POST['password'];

   $select = " SELECT * FROM user_form WHERE email = '$email' ";

   $result = mysqli_query($conn, $select);
   $total = mysqli_num_rows($result);


   if($total==1){
      $_SESSION['password'] = true;
      $_SESSION['firstname'] = $email;
      echo "<script language='javascript'>alert('WELCOME " . $_SESSION['firstname'] . " ')</script>";	
      echo"<Script> window.location. href = 'index2.php';</script>";
   }else{
      echo "<script language='javascript'>alert('Incorrect Email / Password!!')</script>";	
   }

}
?>