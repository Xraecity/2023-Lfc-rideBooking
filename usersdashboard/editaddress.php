<?php

include 'fetchDB.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form was submitted via POST

    // Get the values from the form
    $bookingId = $_POST['booking_id'];
    $newAddress = $_POST['address'];
    $newCity = $_POST['city'];

    // Prepare an SQL UPDATE query
    $updateQuery = "UPDATE ridebooking SET address = :address, city = :city WHERE id = :id";

    try {
        // Prepare the SQL statement
        $stmt = $db->prepare($updateQuery);

        // Bind parameters
        $stmt->bindParam(':address', $newAddress, PDO::PARAM_STR);
        $stmt->bindParam(':city', $newCity, PDO::PARAM_STR);
        $stmt->bindParam(':id', $bookingId, PDO::PARAM_INT);

        // Execute the update query
        $stmt->execute();
        $successUpdate = 'updated successfully!.';
        // Redirect back to the previous page or wherever you need to go
        header("location: history.php?success=" . urlencode($successUpdate));

    } catch (PDOException $e) {
        // Handle any database errors here
        echo "Error: " . $e->getMessage();
    }
}

?>

