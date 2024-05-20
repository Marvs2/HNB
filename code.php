<?php
session_start();
include 'config.php';
include 'query.php';

 
if(isset($_GET['search']))
{
 $filtervalues = $_GET['search'];
 $query = "SELECT * FROM dperson WHERE CONCAT(firstname,lastname,middlename,dofBirth,dofDeath,Area,graveNo) LIKE '%$filtervalues%' ";
 $query_run = mysqli_query($conn, $query);

if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $items)
    {
    ?>
        <tr>
            <td><?= $items['id']; ?></td>
            <td><?= $items['firstname']; ?></td>
            <td><?= $items['lastname']; ?></td>
            <td><?= $items['middlename']; ?></td>
            <td><?= $items['dofBirth']; ?></td>
            <td><?= $items['dofDeath']; ?></td>
            <td><?= $items['Area']; ?></td>
            <td><?= $items['graveNo']; ?></td>
        </tr>
    <?php
    }
    }
    else
    { 
    ?>
        <tr>
        <td colspan="4">No Record Found</td>
        </tr>
    <?php
    }
}
                
/*if(isset($_POST['delete_dperson']))
{
    $dperson_id = mysqli_real_escape_string($conn, $_POST['delete_dperson']);

    $query = "DELETE FROM dperson WHERE id='$dperson_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Deceased Person Deleted Successfully";
        header("Location: index2-view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Deceased Person Not Deleted";
        header("Location: index2-view.php");
        exit(0);
    }
}*/

/*function update_dperson($dperson_id, $firstname, $lastname, $middlename, $dofBirth, $dofDeath, $graveNo) {
  global $conn;

  $query = "UPDATE dperson SET firstname='$firstname', lastname='$lastname', middlename='$middlename', dofBirth='$dofBirth', dofDeath='$dofDeath', graveNo='$graveNo' WHERE id='$dperson_id' ";
  $query_run = $conn->query($query);

  if ($query_run) {
    return true;
  } else {
    return false;
  }
}*/

function isUniquegraveNo($graveNo)
{
    // Implement your logic to check for the uniqueness of graveNo here
    // For example, you can perform a database query to check if the graveNo already exists
    // and return true or false based on the result.
    // For now, let's assume that the graveNo is unique.
    return true;
}

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
    $query = "UPDATE dperson SET firstname=?, lastname=?, middlename=?, dofBirth=?, dofDeath=?, graveNo=? WHERE id=?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param('sssssss', $fname, $lname, $mname, $dofBirth, $dofDeath, $graveNo, $dperson_id);

        try {
            if ($stmt->execute()) {
                $_SESSION['message'] = "Deceased Person Updated Successfully";
                header("location: edit.php?id=". $dperson_id); // Redirect to the page that displays the updated records.
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

/*if (isset($_POST['save_dperson'])) {

    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $mname = mysqli_real_escape_string($conn, $_POST['middlename']);
    $dofBirth = mysqli_real_escape_string($conn, $_POST['dofBirth']);
    $dofDeath = mysqli_real_escape_string($conn, $_POST['dofDeath']);
    $graveNo = mysqli_real_escape_string($conn, $_POST['graveNo']);

    // ... Rest of the code ...
    if (empty($fname) || empty($lname) || empty($dofBirth) || empty($graveNo)) {
    $_SESSION['message'] = "Please fill in all required fields.";
    header("Location: add.php");
    exit();
}

// Check the validity of graveNo and uniqueness using the isUniquegraveNo() function
if ($graveNo > 540) {
    $_SESSION['message'] = "Please enter a unique graveNo less than or equal to 540.";
    header("Location: add.php");
    exit();
}

// Check if graveNo already exists using the isUniquegraveNo() function
if (!isUniquegraveNo($graveNo)) {
    $_SESSION['message'] = "graveNo already exists. Please enter a unique graveNo.";
    header("Location: add.php");
    exit();
}
if (isUniquegraveNo($graveno) && $graveno <= 540){
// Use prepared statements to prevent SQL injection
$query = "INSERT INTO dperson (firstname, lastname, middlename, dofBirth, dofDeath, graveNo) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);

$stmt->bind_param(1, $fname);
$stmt->bind_param(2, $lname);
$stmt->bind_param(3, $mname);
$stmt->bind_param(4, $dofBirth);
$stmt->bind_param(5, $dofDeath);
$stmt->bind_param(6, $graveNo);

if ($stmt->execute()) {
    $_SESSION['message'] = "Deceased Person Added Successfully";
    header("Location: add.php");
    exit();
} else {
    $_SESSION['message'] = "Deceased Person Added Failed";
    header("Location: add.php");
    exit();
}

$stmt->close();
}

}*/


?>