<?php
$conn = mysqli_connect("localhost","root","","user_db");
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            function getTableCounts($conn) {
                $tables = array(
                    'areano1', 'areano2', 'areano3', 'areano4',
                    'areano5', 'areano6', 'areano7', 'areano8'
                );
                $counts = array();
            
                foreach ($tables as $table) {
                    $sql = "SELECT COUNT(*) AS count FROM $table";
                    $result = $conn->query($sql);
            
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $counts[$table] = $row['count'];
                    } else {
                        $counts[$table] = 0;
                    }
                }
            
                return $counts;
            }
            
            $tableCounts = getTableCounts($conn);
            
            // Return the data as JSON
            header('Content-Type: application/json');
            echo json_encode($tableCounts);
            
      



?>