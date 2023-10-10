<?php 
// In session.php

// Set session timeout to 1hr 30mins
session_start();
include 'fetchDB.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: ../login');
    exit();
}

// stire the previous page 
$_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];

// Check the session timeout
$timeout = 1800; // 5mins minutes
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    // Session expired, redirect to password re-entry page
    $email = $_SESSION['email'];
    $stmt = $db->prepare("UPDATE users_registration SET session_id = 0 WHERE email = ?");
    $stmt->execute([$email]);
    header('Location: sessionEnd.php');
    exit();
}

// Update the last activity timestamp
$_SESSION['last_activity'] = time();




?>
