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

// Query the database to get the data from history table
$query = "SELECT * FROM history";
$result = mysqli_query($conn, $query);

// Check if there are any records in the history table
if (mysqli_num_rows($result) > 0) {
    echo "<h2>History Table</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Middle Name</th><th>Date of Birth</th><th>Date of Death</th><th>Grave No.</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['middlename'] . "</td>";
        echo "<td>" . $row['dofBirth'] . "</td>";
        echo "<td>" . $row['dofDeath'] . "</td>";
        echo "<td>" . $row['graveNo'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found in the history table.";
}

// Close the connection
$conn->close();
?>