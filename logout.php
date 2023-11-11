<?php
session_start(); // Start the session

if(isset($_POST['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to the desired page after logout
    exit;
}
?>