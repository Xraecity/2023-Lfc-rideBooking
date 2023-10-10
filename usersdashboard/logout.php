<?php
session_start();
session_destroy(); // Destroy the session data

// Redirect to the login page after logging out
header("Location: ../login");
exit;
?>