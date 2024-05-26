<?php
define('DBINFO', 'mysql:host=localhost;dbname=user_db');
define('DBUSER', 'root');
define('DBPASS', '');

// // Define $conn as a global variable
// global $conn;

// Establish a MySQLi connection
$conn = new mysqli("localhost", "root", "", "user_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function performQuery($query, $params = []) {
    global $conn; // Access the global $conn variable

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    if (!empty($params)) {
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params); // Using splat operator to unpack $params
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result;
}

function fetchAll($query) {
    global $conn; // Access the global $conn variable

    try {
        $result = $conn->query($query);
        if (!$result) {
            die("Query failed: " . $conn->error);
        }
        $results = [];
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    } catch (Exception $e) {
        die("Query execution failed: " . $e->getMessage());
    }
}

?>
<style>
 .error {
    color: red;
 }
</style>