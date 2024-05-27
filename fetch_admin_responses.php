<?php
include 'config.php'; // Include your database connection
include 'query.php';

if (isset($_POST['messageId'])) {
    $messageId = $_POST['messageId'];

    // Fetch admin responses for the specified message ID
    $adminResponses = getAdminResponses($messageId);

    if ($adminResponses) {
        if (mysqli_num_rows($adminResponses) > 0) {
            // Output admin responses as HTML
            echo "<h5>Admin Responses</h5>";
            echo "<div class='admin-responses'>";
            while ($row = mysqli_fetch_assoc($adminResponses)) {
                echo "<div class='response'>";
                echo "<p class='response-content'>" . $row['response_message'] . "</p>";
                echo "<p class='response-date'>" . $row['response_date'] . "</p>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>No admin responses found.</p>";
        }
    } else {
        echo "Error: Unable to fetch admin responses.";
    }
} else {
    echo "Invalid request.";
}
?>
