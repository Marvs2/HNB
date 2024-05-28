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

function get_user_data($user_id) {
    // Prepare the query to select user data based on the user ID
    $query = "SELECT * FROM user_form WHERE id = ?";
    // Execute the query with the user ID as the parameter
    $result = performQuery($query, [$user_id]);

    // Check if there is at least one row returned
    if ($result->num_rows == 1) {
        // Fetch the first row of the result as an associative array
        $row = $result->fetch_assoc();
        // Construct an associative array with user data
        $user_data = array(
            'id' => $row['id'],
            'position' => $row['position'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            // Add other fields as needed
        );

        // Return the user data array
        return $user_data;
    } else {
        // Return null if no user data is found
        return null;
    }
}

function get_client_data($client_id) {
    // Prepare the query to select user data based on the user ID
    $query = "SELECT * FROM client_form WHERE id = ?";
    // Execute the query with the user ID as the parameter
    $result = performQuery($query, [$client_id]);

    // Check if there is at least one row returned
    if ($result->num_rows == 1) {
        // Fetch the first row of the result as an associative array
        $row = $result->fetch_assoc();
        // Construct an associative array with user data
        $client_data = array(
            'id' => $row['id'],
            'position' => $row['position'],
            'firstname' => $row['firstname'],
            'middlename' => $row['middlename'],
            'lastname' => $row['lastname'],
            'email' => $row['email'],
            'contact' => $row['contact'],
            'status' => $row['status'],
            'clientNum' => $row['clientnum'], // Ensure this field is correct
            // Add other fields as needed
        );

        // Return the user data array
        return $client_data;
    } else {
        // Return null if no user data is found
        return null;
    }
}

function check_client_exists_in_areano1($clientNum) {
    // Prepare the query to check if clientNum exists in areano1 table
    $query = "SELECT * FROM areano1 WHERE clientNum = ?";
    // Execute the query with the clientNum as the parameter
    $result = performQuery($query, [$clientNum]);

    // Initialize an array to store client data
    $client_areaNo_data = [];

    // Check if there is at least one row returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch each row
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array with client data for each row
            $client_row = array(
                'areaOneId' => $row['areaOneId'],
                'clientNum' => $row['clientNum'],
                'dpNum' => $row['dpNum'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'graveNo' => $row['graveNo'],
                'dateofBirth' => $row['dateofBirth'],
                'dateOfDeath' => $row['dateOfDeath'],
                'dateofBuried' => $row['dateofBuried'],
                'status' => $row['status'],
                'statCol' => $row['statCol'],
                'areaNo' => $row['areaNo'],
                'graveType' => $row['graveType'],
                'buriedStatus' => $row['buriedStatus'],
                'maintenanceStatus' => $row['maintenanceStatus'],
                'lastMaintenanceDate' => $row['lastMaintenanceDate'],
            );

            // Push the client data array into the main client_areaNo_data array
            $client_areaNo_data[] = $client_row;
        }
    }

    // Return the client data array
    return $client_areaNo_data;
}

function get_data_by_area($areaOneId) {
    // Prepare the query to fetch data based on areaOneId
    $query = "SELECT * FROM areano1 WHERE areaOneId = ?";
    // Execute the query with the areaOneId as the parameter
    $result = performQuery($query, [$areaOneId]);

    // Initialize an array to store the data
    $data = [];

    // Check if there is at least one row returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch each row
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array with data for each row
            $data_row = array(
                'areaOneId' => $row['areaOneId'],
                'clientNum' => $row['clientNum'],
                'dpNum' => $row['dpNum'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'graveNo' => $row['graveNo'],
                'dateofBirth' => $row['dateofBirth'],
                'dateOfDeath' => $row['dateOfDeath'],
                'dateofBuried' => $row['dateofBuried'],
                'status' => $row['status'],
                'statCol' => $row['statCol'],
                'areaNo' => $row['areaNo'],
                'graveType' => $row['graveType'],
                'buriedStatus' => $row['buriedStatus'],
                'maintenanceStatus' => $row['maintenanceStatus'],
                'lastMaintenanceDate' => $row['lastMaintenanceDate'],
                // Add other fields as needed
            );

            // Push the data array into the main data array
            $data[] = $data_row;
        }
    }

    // Return the data array
    return $data;
}

// Fetch data for a specific area
$areaOneId = 1; // Example value
$area_data = get_data_by_area($areaOneId);
#==============================================================================
#area 2
function get_data_by_area2($areaTwoId) {
    // Prepare the query to fetch data based on areaOneId
    $query = "SELECT * FROM areano2 WHERE areaTwoId = ?";
    // Execute the query with the areaOneId as the parameter
    $result = performQuery($query, [$areaTwoId]);

    // Initialize an array to store the data
    $datatwo = [];

    // Check if there is at least one row returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch each row
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array with data for each row
            $data_row = array(
                'areaTwoId' => $row['areaTwoId'],
                'clientNum' => $row['clientNum'],
                'dpNum' => $row['dpNum'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'graveNo' => $row['graveNo'],
                'dateofBirth' => $row['dateofBirth'],
                'dateOfDeath' => $row['dateOfDeath'],
                'dateofBuried' => $row['dateofBuried'],
                'status' => $row['status'],
                'statCol' => $row['statCol'],
                'areaNo' => $row['areaNo'],
                'graveType' => $row['graveType'],
                'buriedStatus' => $row['buriedStatus'],
                'maintenanceStatus' => $row['maintenanceStatus'],
                'maintenanceStatusDate' => $row['maintenanceStatusDate'],
                // Add other fields as needed
            );

            // Push the data array into the main data array
            $datatwo[] = $data_row;
        }
    }

    // Return the data array
    return $datatwo;
}

// Fetch data for a specific area
$areaTwoId = 2; // Example value
$area_data = get_data_by_area2($areaTwoId);



function getAdminResponses($message_id) {
    global $conn;

    // Query to select admin responses for a specific message
    $query = "SELECT `id`, `admin_id`, `response_message`, `response_date` FROM `admin_responses` WHERE `message_id` = $message_id ORDER BY `response_date` DESC";

    // Perform the query
    $result = mysqli_query($conn, $query);

    // Check if query failed
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Return the result set
    return $result;
}







#=========================================================================#
#1
function get_client_data_for_grave_numbers($graveNumbers) {
    // Prepare the query to fetch client data for given grave numbers
    $placeholders = implode(',', array_fill(0, count($graveNumbers), '?'));
    $query = "SELECT * FROM areano1 WHERE graveNo IN ($placeholders)";
    
    // Execute the query with the grave numbers as parameters
    $result = performQuery($query, $graveNumbers);

    // Initialize an array to store client data
    $client_data = [];

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch each row
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array with client data for each row
            $client_row = array(
                'areaOneId' => $row['areaOneId'],
                'clientNum' => $row['clientNum'],
                'dpNum' => $row['dpNum'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'graveNo' => $row['graveNo'],
                'dateofBirth' => $row['dateofBirth'],
                'dateOfDeath' => $row['dateOfDeath'],
                'dateofBuried' => $row['dateofBuried'],
                'status' => $row['status'],
                'statCol' => $row['statCol'],
                'areaNo' => $row['areaNo'],
                'graveType' => $row['graveType'],
                'buriedStatus' => $row['buriedStatus'],
                'maintenanceStatus' => $row['maintenanceStatus'],
                'lastMaintenanceDate' => $row['lastMaintenanceDate'],
            );

            // Push the client data array into the main client_data array
            $client_data[] = $client_row;
        }
    }

    // Return the client data array
    return $client_data;
}



#2
function get_client_data_for_grave_numbers_two($gravetwoNumbers) {
    // Prepare the query to fetch client data for given grave numbers
    $placeholders = implode(',', array_fill(0, count($gravetwoNumbers), '?'));
    $query = "SELECT * FROM areano2 WHERE graveNo IN ($placeholders)";
    
    // Execute the query with the grave numbers as parameters
    $result = performQuery($query, $gravetwoNumbers);

    // Initialize an array to store client data
    $client_two_data = [];

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch each row
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array with client data for each row
            $client_two_row = array(
                'areaTwoId' => $row['areaTwoId'],
                'clientNum' => $row['clientNum'],
                'dpNum' => $row['dpNum'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'graveNo' => $row['graveNo'],
                'dateofBirth' => $row['dateofBirth'],
                'dateOfDeath' => $row['dateOfDeath'],
                'dateofBuried' => $row['dateofBuried'],
                'status' => $row['status'],
                'statCol' => $row['statCol'],
                'areaNo' => $row['areaNo'],
                'graveType' => $row['graveType'],
                'buriedStatus' => $row['buriedStatus'],
                'maintenanceStatus' => $row['maintenanceStatus'],
                'maintenanceStatusDate' => $row['maintenanceStatusDate'],
            );

            // Push the client data array into the main client_data array
            $client_two_data[] = $client_two_row;
        }
    }

    // Return the client data array
    return $client_two_data;
}

#3
function get_client_data_for_grave_numbers_three($graveNumbers) {
    // Prepare the query to fetch client data for given grave numbers
    $placeholders = implode(',', array_fill(0, count($graveNumbers), '?'));
    $query = "SELECT * FROM areano3 WHERE graveNo IN ($placeholders)";
    
    // Execute the query with the grave numbers as parameters
    $result = performQuery($query, $graveNumbers);

    // Initialize an array to store client data
    $client_data = [];

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch each row
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array with client data for each row
            $client_row = array(
                'areaThreeId' => $row['areaThreeId'],
                'clientNum' => $row['clientNum'],
                'dpNum' => $row['dpNum'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'graveNo' => $row['graveNo'],
                'dateofBirth' => $row['dateofBirth'],
                'dateOfDeath' => $row['dateOfDeath'],
                'dateofBuried' => $row['dateofBuried'],
                'status' => $row['status'],
                'statCol' => $row['statCol'],
                'areaNo' => $row['areaNo'],
                'graveType' => $row['graveType'],
                'buriedStatus' => $row['buriedStatus'],
                'maintenanceStatus' => $row['maintenanceStatus'],
                'maintenanceStatusDate' => $row['maintenanceStatusDate'],
            );

            // Push the client data array into the main client_data array
            $client_data[] = $client_row;
        }
    }

    // Return the client data array
    return $client_data;
}

#4
function get_client_data_for_grave_numbers_four($graveNumbers) {
    // Prepare the query to fetch client data for given grave numbers
    $placeholders = implode(',', array_fill(0, count($graveNumbers), '?'));
    $query = "SELECT * FROM areano4 WHERE graveNo IN ($placeholders)";
    
    // Execute the query with the grave numbers as parameters
    $result = performQuery($query, $graveNumbers);

    // Initialize an array to store client data
    $client_data = [];

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch each row
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array with client data for each row
            $client_row = array(
                'areaFourId' => $row['areaFourId'],
                'clientNum' => $row['clientNum'],
                'dpNum' => $row['dpNum'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'graveNo' => $row['graveNo'],
                'dateofBirth' => $row['dateofBirth'],
                'dateOfDeath' => $row['dateOfDeath'],
                'dateofBuried' => $row['dateofBuried'],
                'status' => $row['status'],
                'statCol' => $row['statCol'],
                'areaNo' => $row['areaNo'],
                'graveType' => $row['graveType'],
                'buriedStatus' => $row['buriedStatus'],
                'maintenanceStatus' => $row['maintenanceStatus'],
                'maintenanceStatusDate' => $row['maintenanceStatusDate'],
            );

            // Push the client data array into the main client_data array
            $client_data[] = $client_row;
        }
    }

    // Return the client data array
    return $client_data;
}

#5
function get_client_data_for_grave_numbers_five($graveNumbers) {
    // Prepare the query to fetch client data for given grave numbers
    $placeholders = implode(',', array_fill(0, count($graveNumbers), '?'));
    $query = "SELECT * FROM areano5 WHERE graveNo IN ($placeholders)";
    
    // Execute the query with the grave numbers as parameters
    $result = performQuery($query, $graveNumbers);

    // Initialize an array to store client data
    $client_data = [];

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch each row
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array with client data for each row
            $client_row = array(
                'areaFiveId' => $row['areaFiveId'],
                'clientNum' => $row['clientNum'],
                'dpNum' => $row['dpNum'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'graveNo' => $row['graveNo'],
                'dateofBirth' => $row['dateofBirth'],
                'dateOfDeath' => $row['dateOfDeath'],
                'dateofBuried' => $row['dateofBuried'],
                'status' => $row['status'],
                'statCol' => $row['statCol'],
                'areaNo' => $row['areaNo'],
                'graveType' => $row['graveType'],
                'buriedStatus' => $row['buriedStatus'],
                'maintenanceStatus' => $row['maintenanceStatus'],
                'maintenanceStatusDate' => $row['maintenanceStatusDate'],
            );

            // Push the client data array into the main client_data array
            $client_data[] = $client_row;
        }
    }

    // Return the client data array
    return $client_data;
}

#6
function get_client_data_for_grave_numbers_six($graveNumbers) {
    // Prepare the query to fetch client data for given grave numbers
    $placeholders = implode(',', array_fill(0, count($graveNumbers), '?'));
    $query = "SELECT * FROM areano6 WHERE graveNo IN ($placeholders)";
    
    // Execute the query with the grave numbers as parameters
    $result = performQuery($query, $graveNumbers);

    // Initialize an array to store client data
    $client_data = [];

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch each row
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array with client data for each row
            $client_row = array(
                'areaSixId' => $row['areaSixId'],
                'clientNum' => $row['clientNum'],
                'dpNum' => $row['dpNum'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'graveNo' => $row['graveNo'],
                'dateofBirth' => $row['dateofBirth'],
                'dateOfDeath' => $row['dateOfDeath'],
                'dateofBuried' => $row['dateofBuried'],
                'status' => $row['status'],
                'statCol' => $row['statCol'],
                'areaNo' => $row['areaNo'],
                'graveType' => $row['graveType'],
                'buriedStatus' => $row['buriedStatus'],
                'maintenanceStatus' => $row['maintenanceStatus'],
                'maintenanceStatusDate' => $row['maintenanceStatusDate'],
            );

            // Push the client data array into the main client_data array
            $client_data[] = $client_row;
        }
    }

    // Return the client data array
    return $client_data;
}

#7
function get_client_data_for_grave_numbers_seven($graveNumbers) {
    // Prepare the query to fetch client data for given grave numbers
    $placeholders = implode(',', array_fill(0, count($graveNumbers), '?'));
    $query = "SELECT * FROM areano7 WHERE graveNo IN ($placeholders)";
    
    // Execute the query with the grave numbers as parameters
    $result = performQuery($query, $graveNumbers);

    // Initialize an array to store client data
    $client_data = [];

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch each row
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array with client data for each row
            $client_row = array(
                'areaSevenId' => $row['areaSevenId'],
                'clientNum' => $row['clientNum'],
                'dpNum' => $row['dpNum'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'graveNo' => $row['graveNo'],
                'dateofBirth' => $row['dateofBirth'],
                'dateOfDeath' => $row['dateOfDeath'],
                'dateofBuried' => $row['dateofBuried'],
                'status' => $row['status'],
                'statCol' => $row['statCol'],
                'areaNo' => $row['areaNo'],
                'graveType' => $row['graveType'],
                'buriedStatus' => $row['buriedStatus'],
                'maintenanceStatus' => $row['maintenanceStatus'],
                'maintenanceStatusDate' => $row['maintenanceStatusDate'],
            );

            // Push the client data array into the main client_data array
            $client_data[] = $client_row;
        }
    }

    // Return the client data array
    return $client_data;
}

#8
function get_client_data_for_grave_numbers_eight($graveNumbers) {
    // Prepare the query to fetch client data for given grave numbers
    $placeholders = implode(',', array_fill(0, count($graveNumbers), '?'));
    $query = "SELECT * FROM areano8 WHERE graveNo IN ($placeholders)";
    
    // Execute the query with the grave numbers as parameters
    $result = performQuery($query, $graveNumbers);

    // Initialize an array to store client data
    $client_data = [];

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and fetch each row
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array with client data for each row
            $client_row = array(
                'areaEightId' => $row['areaEightId'],
                'clientNum' => $row['clientNum'],
                'dpNum' => $row['dpNum'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'graveNo' => $row['graveNo'],
                'dateofBirth' => $row['dateofBirth'],
                'dateOfDeath' => $row['dateOfDeath'],
                'dateofBuried' => $row['dateofBuried'],
                'status' => $row['status'],
                'statCol' => $row['statCol'],
                'areaNo' => $row['areaNo'],
                'graveType' => $row['graveType'],
                'buriedStatus' => $row['buriedStatus'],
                'maintenanceStatus' => $row['maintenanceStatus'],
                'maintenanceStatusDate' => $row['maintenanceStatusDate'],
            );

            // Push the client data array into the main client_data array
            $client_data[] = $client_row;
        }
    }

    // Return the client data array
    return $client_data;
}

// Function to insert data into admin_responses table

// function get_client_data($client_id) {
//     // Prepare the query to select user data based on the user ID
//     $query = "SELECT * FROM client_form WHERE id = ?";
//     // Execute the query with the user ID as the parameter
//     $result = performQuery($query, [$client_id]);

//     // Check if there is at least one row returned
//     if ($result->num_rows == 1) {
//         // Fetch the first row of the result as an associative array
//         $row = $result->fetch_assoc();
//         // Construct an associative array with user data
//         $client_data = array(
//             'id' => $row['id'],
//             'position' => $row['position'],
//             'firstname' => $row['firstname'],
//             'lastname' => $row['lastname'],
//             'clientNum' => $row['clientNum'],
//             // Add other fields as needed
//         );

//         // Return the user data array
//         return $client_data;
//     } else {
//         // Return null if no user data is found
//         return null;
//     }
// }

// function get_area_one_data($clientNum) {
//     // Prepare the query to select area one data based on clientNum
//     $query = "SELECT * FROM areano1 WHERE clientNum = ?";
//     // Execute the query with the clientNum as the parameter
//     $result = performQuery($query, [$clientNum]);

//     // Initialize an array to store area one data
//     $area_one_data = [];

//     // Check if there is at least one row returned
//     if ($result->num_rows > 0) {
//         // Loop through the result set and fetch each row
//         while ($row = $result->fetch_assoc()) {
//             // Construct an associative array with area one data for each row
//             $area_one_row = array(
//                 'areaOneId' => $row['areaOneId'],
//                 'clientNum' => $row['clientNum'],
//                 'dpNum' => $row['dpNum'],
//                 'firstname' => $row['firstname'],
//                 'lastname' => $row['lastname'],
//                 // Add other fields as needed
//             );

//             // Push the area one data array into the main area_one_data array
//             $area_one_data[] = $area_one_row;
//         }
//     }

//     // Return the area one data array
//     return $area_one_data;
// }

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
