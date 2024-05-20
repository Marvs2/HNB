<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the deleted record ID
$dperson_id = $_GET['id'];

// Query the database to get the deleted record
$query = "SELECT * FROM dperson WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $dperson_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the record exists
if ($result->num_rows > 0) {
    // Get the record data
    $row = $result->fetch_assoc();

    // Add the record to the deleted table
    $insertQuery = "INSERT INTO history (id, firstname, middlename, lastname, dofBirth, dofDeath, graveNo) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("issssss", $row['id'], $row['firstname'], $row['middlename'], $row['lastname'], $row['dofBirth'], $row['dofDeath'], $row['graveNo']);

    if ($insertStmt->execute()) {
        // Deletion successful, now delete the record from the original table
        $deleteQuery = "DELETE FROM dperson WHERE id=?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $dperson_id);

        if ($deleteStmt->execute()) {
            $_SESSION['message'] = "Deceased Person Deleted Successfully";
            header('location: index2-view.php?m=1');
        } else {
            echo "Error deleting record: " . $deleteStmt->error;
        }
    } else {
        echo "Error inserting into history table: " . $insertStmt->error;
    }
} else {
    echo "Record does not exist";
}

// Close prepared statements and connection
$stmt->close();
$insertStmt->close();
$deleteStmt->close();
$conn->close();
?>