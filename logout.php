<?php
// Start or resume the session
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page (or any other page as needed)
    header("Location: loginpage.php");
    exit();
}

// If the user is logged in, unset or destroy the session
session_unset();  // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to the login page (or any other page as needed)
header("Location: loginpage.php");
exit();
?>
