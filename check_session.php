<?php
session_start(); // Start the session at the beginning

// Check if the user is not logged in
if (!isset($_SESSION["password"])) {
    // Redirect to the login page with a query string to show the message
    header("Location: login_form.php?message=access_denied");
    exit(); // Ensure no further code is executed
}

// Place your protected content here
echo "Welcome to the protected page!";
$message = [];
if (isset($_GET['message']) && $_GET['message'] == 'access_denied') {
    $message[] = 'You don\'t have access to this page. Please login first.';
}

?>