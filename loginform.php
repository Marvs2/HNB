<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sliding Login Forms</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
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
        .container {
            width: 600px; /* Doubled from 300px */
            overflow: hidden;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 1200px; /* Doubled from 600px */
        }
        .form-container {
            width: 600px; /* Doubled from 300px */
            padding-left: 25px; /* Adjusted padding */
            padding-right: 50px; /* Adjusted padding */
        }
        .form-container h1 {
            text-align: center;
        }
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container .form-btn {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #0b5b40;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        .form-container .form-btn:hover {
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
        .toggle-buttons {
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #0b5b40;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .toggle-buttons button {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .toggle-buttons button:hover {
            text-decoration: underline;
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
 <?php
 if (isset($message)) {
     foreach ($message as $message) {
         echo '<span class="error-msg">' . $message . '</span>';
     }
 }
 ?>
<div class="container">
    <div class="toggle-buttons">
        <button onclick="showForm('admin')">Admin Login</button>
        <button onclick="showForm('client')">Client Login</button>
    </div>
    <div class="slider" id="slider">
        <div class="form-container" id="admin-form">
            <form action="" method="POST">
                <h1>Admin Login</h1>
                <label for="email">Enter your Email</label><br>
                <input type="email" name="email" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : "" ?>" required placeholder="email">
                <label for="password">Enter your Password</label><br>
                <input type="password" name="password" required placeholder="password">
                <input type="hidden" name="position" value="1"> <!-- Hidden input for position -->
                <input type="submit" name="admin_submit" value="login now" class="form-btn">
                <p>don't have an account? <a href="slidingregis.php">register now</a> or <a href="index.php" style="color: rgb(11, 91, 64)"> BACK </a></p>
            </form>
        </div>
        <div class="form-container" id="client-form">
            <form action="" method="POST">
                <h1>Client Login</h1>
                <label for="email">Enter your Email</label><br>
                <input type="email" name="email" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : "" ?>" required placeholder="email">
                <label for="password">Enter your Password</label><br>
                <input type="password" name="password" required placeholder="password">
                <input type="hidden" name="position" value="2"> <!-- Hidden input for position -->
                <input type="submit" name="client_submit" value="login now" class="form-btn">
                <p>don't have an account? <a href="slidingregis.php">register now</a> or <a href="index.php" style="color: rgb(11, 91, 64)"> BACK </a></p>
            </form>
        </div>
    </div>
</div>

<script>
    function showForm(formType) {
        const slider = document.getElementById('slider');
        if (formType === 'admin') {
            slider.style.transform = 'translateX(0)';
        } else {
            slider.style.transform = 'translateX(-600px)'; /* Adjusted transform */
        }
    }
</script>

</body>
</html>

<?php
if (isset($_POST['admin_submit'])) {
    $conn = mysqli_connect('localhost', 'root', '', 'user_db');
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $position = mysqli_real_escape_string($conn, $_POST['position']); // Get the position value

    $select = "SELECT * FROM user_form WHERE email = '$email' AND position = '$position'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) == 1) {
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
            $redirectUrl = ($position == 2) ? 'loginform.php' : 'index2.php';
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
<?php
if (isset($_POST['client_submit'])) {
    $conn = mysqli_connect('localhost', 'root', '', 'user_db');
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $position = mysqli_real_escape_string($conn, $_POST['position']); // Get the position value

    $select = "SELECT * FROM client_form WHERE email = '$email' AND position = '$position'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) == 1) {
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
        } else {
            // Check if password is stored as plain text or hash
            if ($pass === $row['password'] || (isset($row['password_hash']) && password_verify($pass, $row['password_hash']))) {
                $_SESSION['client_id'] = $row['id']; // Store user ID in session
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['position'] = $row['position'];
                $_SESSION['clientNum'] = $row['clientnum']; // Store clientNum in session

                // Redirect to appropriate page based on position
                $redirectUrl = ($position == 1) ? 'loginform.php' : 'clientindex.php';

                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Welcome " . $_SESSION['firstname'] . "!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = '$redirectUrl';
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
