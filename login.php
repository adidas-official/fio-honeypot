<?php
session_start();
// Check if the user is already logged in
//
if (isset($_SESSION['user'])) {
    // If the user is already logged in, redirect to welcome.php
    header("Location: index.php");
    exit();
}

// Define valid username and password (you can replace these with your own values)
$validUsername = 'user';
$validPassword = 'user';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user input (you can add more validation)
    if ($username === $validUsername && $password === $validPassword) {
        // Authentication successful, redirect to a secure page
        $_SESSION['user'] = $_POST['username'];
        header('Location: index.php');
        exit();
    } else {
        // Authentication failed, display an error message
        $errorMessage = 'Invalid username or password. Please try again.';
	header('Location: loginpage.php');
    }
}
?>
