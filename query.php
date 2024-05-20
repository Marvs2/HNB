<?php

// function getDperson($conn){
//   $stmt = $conn->prepare("SELECT * FROM dperson");
//   $stmt->execute();
//   return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }
function getDperson($conn){
    $query = "SELECT *,
                TIMESTAMPDIFF(YEAR, dofBuried, CURDATE()) AS yearspent,
                TIMESTAMPDIFF(MONTH, dofBuried, CURDATE()) % 12 AS monthspent,
                TIMESTAMPDIFF(DAY, dofBuried, CURDATE()) % 30 AS dayspent
              FROM dperson";
    $result = performQuery($query);

    if ($result->num_rows >= 1) {
        $dpersons = array();
        while ($row = $result->fetch_assoc()) {
            $dpersons[] = array(
                'graveNo' => $row['graveNo'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'dofDeath' => $row['dofDeath'],
                'dofBirth' => $row['dofBirth'],
                'dofBuried' => $row['dofBuried'],
                'status' => $row['status'],
                'yearspent' => $row['yearspent'],
                'monthspent' => $row['monthspent'],
                'dayspent' => $row['dayspent']
                // Add other fields as needed
            );
        }
        return $dpersons;
    } else {
        return array();
    }
}

// function getId() {
//     global $conn;
//     if ($conn === null) {
//         // Handle the case when $conn is null
//         return array(); // Return an empty array or handle the error in a different way
//     }
//     $stmt = $conn->prepare("SELECT * FROM dperson");
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

function get_user_data($position) {
    $query = "SELECT * FROM user_form WHERE position = ?";
    $result = performQuery($query, [$position]);

    if ($result->num_rows >= 1) {
        $row = $result->fetch_assoc();
        $user_data = array(
            'position' => $row['position'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            // Add other fields as needed
        );

        return $user_data;
    } else {
        return null;
    }
}

function getId() {
    global $conn;
    if ($conn === null) {
        // Handle the case when $conn is null
        return 0; // Return 0 or handle the error in a different way
    }

    // Prepare the query to count the rows in the dperson table
    $query = "SELECT COUNT(*) as count FROM dperson";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc(); // Use fetch_assoc() for MySQLi
        return $row['count']; // Return the count of rows
    } else {
        return 0; // Return 0 if query fails or no rows found
    }
}
function getRequest() {
    global $conn;
    if ($conn === null) {
        // Handle the case when $conn is null
        return 0; // Return 0 or handle the error in a different way
    }

    // Prepare the query to count the rows in the requests table
    $query = "SELECT COUNT(*) as count FROM requests";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc(); // Use fetch_assoc() for MySQLi
        return $row['count']; // Return the count of rows
    } else {
        return 0; // Return 0 if query fails or no rows found
    }
}

$dpersons_count = getId();
$requests_count = getRequest();

// function getRequest() {
//     global $conn;
//     if ($conn === null) {
//         // Handle the case when $conn is null
//         return array(); // Return an empty array or handle the error in a different way
//     }
//     $stmt = $conn->prepare("SELECT * FROM requests");
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

function viewDperson($conn, $id) {
  $query = "SELECT * FROM dperson WHERE id = :id";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  if ($stmt->rowCount() >= 1) {
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } else {
    return null;
  }
}

?>
