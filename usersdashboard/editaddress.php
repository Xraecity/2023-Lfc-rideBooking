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

<form method="post">
                                        <div class="modal fade" id="edit<?= $booking['id']; ?>">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-light">
                                                    <h5 class="modal-title">Edit Pickup Address</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="alert alert-success">Please Edit your pickup address for Ref ID: <strong>#<?= $booking['uniqueID']; ?></strong> before the count down</p>
                                                    <label for="location-input">Address</label>
                                                    <input type="text" class="form-control" name="address" id="location-input" value="<?= $booking['address']; ?>" placeholder="<?= $booking['address']; ?>" required>
                                                    <label for="locality-input">City</label>
                                                    <input type="text" class="form-control" name="city" id="locality-input" value="<?= $booking['city']; ?>" placeholder="<?= $booking['city']; ?>" required>
                                                </div>
                                                <input type="text" hidden name="booking_id" value="<?= $booking['id']; ?>">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>