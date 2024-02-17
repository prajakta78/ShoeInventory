<!-- renew.php -->
<?php
session_start();
include('include/conn.php');

// Check if the user is logged in
if (!isset($_SESSION['expired_email'])) {
    header("Location: login.php");
    exit();
}

$expired_email = $_SESSION['expired_email'];

// Handle the renewal logic here
// For example, update the subscription expiry date in the database

// After successful renewal, redirect to the dashboard
header("Location: dashboard.php");
exit();
?>
