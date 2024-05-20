<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $update_fname = mysqli_real_escape_string($conn, $_POST['update_firstname']);
   $update_lname = mysqli_real_escape_string($conn, $_POST['update_lastname']);
   $update_mname = mysqli_real_escape_string($conn, $_POST['update_middlename']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_contact = mysqli_real_escape_string($conn, $_POST['update_contact']);
   $update_birthday = mysqli_real_escape_string($conn, $_POST['update_birthday']);
   $update_position = mysqli_real_escape_string($conn, $_POST['update_position']);
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_password']));
   $update_rpass = mysqli_real_escape_string($conn, md5($_POST['update_rpassword']));

   mysqli_query($conn, "UPDATE `user_form` SET firstname = '$update_fname', lastname = '$update_lname', middlename = '$update_mname', email = '$update_email', contact = '$update_contact', birthday = '$update_birthday', position = '$update_position', password = '$update_pass', rpassword = '$update_rpass' WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_password'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_password']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_password']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `user_form` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['firstname'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_firstname = $_FILES['update_image']['tmp_firstname'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `user_form` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
      }
   }

}

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
    <link rel="stylesheet" href="css/avatar.css">
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
      <a href="admin_page.php">About Company</a>
    </div>
  
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>username :</span>
            <input type="text" name="update_firstname" value="<?php echo $fetch['firstname']; ?>" class="box">
            <span>your email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>update your pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn">
      <a href="Aboutus.php" class="delete-btn">go back</a>
   </form>

</div>

</body>
</html>