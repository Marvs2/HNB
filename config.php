<?php
define('DBINFO', 'mysql:host=localhost;dbname=user_db');
define('DBUSER', 'root');
define('DBPASS', '');

// Define $conn as a global variable
global $conn;

// Establish a MySQLi connection
$conn = new mysqli("localhost", DBUSER, DBPASS, "user_db");
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
        $pdo = new PDO(DBINFO, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
?>
<style>
 .error {
    color: red;
 }
</style>