<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_db";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $con = new mysqli($servername, $username, $password, $dbname);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $sql = "DELETE FROM requests WHERE id='$id';";
        $result = $con->query($sql);
        if($result){
            header('location:list.php?m=1');
            exit; // Add exit to terminate the script after redirecting
        } else {
            echo "Error deleting request: " . $con->error;
        }
    }
?>
<br/><br/>
<a href="list.php">Back</a>
