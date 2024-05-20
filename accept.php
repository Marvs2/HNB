<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM `requests` WHERE `id` = '$id'; ";
    $result = fetchAll($query);

    if (count($result) > 0) {
        $row = $result[0]; // Only fetch the first row, assuming id is unique

        $fname = $row['firstname'];
        $mname = $row['middlename'];
        $lname = $row['lastname'];
        $email = $row['email'];
        $contact = $row['contact'];
        $birthday = $row['birthday'];
        $position = $row['position'];
        $pass = $row['password'];
        $hash = password_hash($row['password'], PASSWORD_DEFAULT);

        // Insert data into the 'user_form' table
        $query = "INSERT INTO `user_form` (`id`, `firstname`, `middlename`, `lastname`, `email`, `contact`, `birthday`, `position`, `password`, `password_hash`)
                  VALUES (NULL, '$fname', '$mname', '$lname', '$email', '$contact', '$birthday', '$position', '$pass', '$hash');";

        if (performQuery($query)) {
            // Delete the request from the 'requests' table
            $deleteQuery = "DELETE FROM `requests` WHERE `id` = '$id';";
            if (performQuery($deleteQuery)) {
                echo "Account has been accepted.";
            } else {
                echo "Failed to delete the request. Please try again.";
            }
        } else {
            echo "Failed to insert data into the 'user_form' table. Please try again.";
        }
    } else {
        echo "Error: Request with the provided ID does not exist.";
    }
} else {
    echo "Error: Missing ID parameter.";
}
?>
<br/><br/>
<a href="list.php" class="btn btn-primary">Back</a>
