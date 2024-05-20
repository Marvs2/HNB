<?php
    session_start();
    require 'config.php';

?>
<!DOCTYPE html>
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
      <a href="dperson-view.php">View</a>
      <a href="dperson-create.php">Add</a>
      <a href="admin_page.php">Home</a>
    </div>
  
    <div class="container mt-5">
        
        <div class="profile">
            <?php
               $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
               if(mysqli_num_rows($select) > 0){
                  $fetch = mysqli_fetch_assoc($select);
               }
               if($fetch['image'] == ''){
                  echo '<img src="images/default-avatar.png">';
               }else{
                  echo '<img src="uploaded_img/'.$fetch['image'].'">';
               }
            ?>
            <h3><?php echo $fetch['firstname']; ?></h3>
            <a href="update_profile.php" class="btn">update profile</a>
            <a href="login_form.php?logout=<?php echo $user_form_id; ?>" class="delete-btn">logout</a>
            <p>new <a href="login_form.php">login</a> or <a href="register_form.php">register</a></p>
         </div>
      

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
