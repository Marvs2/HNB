<?php
if (isset($_POST['update_dperson']) && isset($_POST['dperson_id'])) {
    $dperson_id = $_POST['dperson_id'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $mname = $_POST['middlename'];
    $dofBirth = $_POST['dofBirth'];
    $dofDeath = $_POST['dofDeath'];
    $graveNo = $_POST['graveNo'];

    // Validate the input data (you can add additional validation as needed)
    if (empty($fname) || empty($lname) || empty($dofBirth) || empty($graveNo)) {
        $_SESSION['message'] = "Please fill in all required fields.";
        header("Location: edit.php?id=" . $dperson_id);
        exit();
    }

    // Check the validity of graveNo and uniqueness using the isUniquegraveNo() function
    if (!isUniquegraveno($graveNo) || $graveNo > 540) {
        $_SESSION['message'] = "graveNo already exists or graveNo exceeded 540. Please enter a unique graveNo less than or equal to 540.";
        header("Location: edit.php?id=" . $dperson_id);
        exit();
    }

    if (isUniquegraveNo($graveNo)) {
        // Use prepared statements with named placeholders to prevent SQL injection
        $query = "UPDATE dperson SET firstname=:firstname, lastname=:lastname, middlename=:middlename, dofBirth=:dofBirth, dofDeath=:dofDeath, graveNo=:graveNo WHERE id=:id";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bindParam(':firstname', $fname);
            $stmt->bindParam(':lastname', $lname);
            $stmt->bindParam(':middlename', $mname);
            $stmt->bindParam(':dofBirth', $dofBirth);
            $stmt->bindParam(':dofDeath', $dofDeath);
            $stmt->bindParam(':graveNo', $graveNo);
            $stmt->bindParam(':id', $dperson_id);

            try {
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Deceased Person Updated Successfully";
                    header("Location: index2.php"); // Redirect to the page that displays the updated records.
                    exit();
                } else {
                    $_SESSION['message'] = "Deceased Person Update Failed";
                    header("Location: edit.php?id=" . $dperson_id);
                    exit();
                }
            } catch (PDOException $e) {
                if ($e->getCode() === '23000') {
                    $_SESSION['message'] = "Grave number already exists. Please enter a unique grave number.";
                } else {
                    $_SESSION['message'] = "An error occurred while updating the record.";
                }
                header("Location: edit.php?id=" . $dperson_id);
                exit();
            }
        } else {
            $_SESSION['message'] = "Error in the database query.";
            header("Location: edit.php?id=" . $dperson_id);
            exit();
        }
    }
} else {
    // If 'update_dperson' or 'dperson_id' is not set, redirect back to the edit page with the ID parameter
    // You can also display an error message or handle the situation differently based on your requirements.
    header("Location: edit.php?id=" . $dperson_id);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $dperson_id = $_POST["id"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $middlename = $_POST["middlename"];
    $dofBirth = $_POST["dofBirth"];
    $dofDeath = $_POST["dofDeath"];
    $graveNo = $_POST["graveNo"];

    // Assuming you have a database connection established
    $query = "UPDATE dperson SET firstname=?, lastname=?, middlename=?, dofBirth=?, dofDeath=?, graveNo=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("", $firstname, $lastname, $middlename, $dofBirth, $dofDeath, $graveNo, $dperson_id);

    if ($stmt->execute()) {
        // Update successful, redirect to index or wherever you want
        header("Location: index2.php");
        exit();
    } else {
        // Update failed, handle the error or redirect to an error page
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
