<?php

require_once '../connection/connect.php';

// Retrieve all data from the 'users_registration' table
try {
    $stmt = $db->prepare("SELECT * FROM users_registration");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
 ?>