<?php

function generateReferenceID() {
    // Define a fixed prefix
    $prefix = "lfc-";

    // Generate a random unique number (you can use a more robust method)
    $uniqueNumber = mt_rand(100000, 999999);

    // Combine the prefix and the unique number
    $uniqueID = $prefix . $uniqueNumber;

    return $uniqueID;
}

// Example usage:
$uniqueID = generateReferenceID();

// Check if the "schedule" key exists in $_POST
if (isset($_POST['schedule'])) {

    if(!$_POST['address'] == null){

            if(isset($_POST['num_kids']) || isset($_POST['num_adult'])){

                // Get the number of kids and adults from the form
                    $num_kids = $_POST['num_kids'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $num_adult = $_POST['num_adult'];
                    $schedule = $_POST['schedule'];
                    $user_id = $_POST['user_id'];

                // Validate the form data (add more validation as needed)
                    if (!empty($num_kids) || !empty($num_adult) && !empty($address) && !empty($city) && !empty($schedule) && !empty($user_id)) {
                        try {
                            // Connect to the database (replace with your database connection code)
                            require_once "fetchDB.php";
                            
                            // Prepare and execute the SQL update statement
                            $stmt = $db->prepare("INSERT INTO ridebooking (user_id, uniqueID, num_kids, address, city, schedule, num_adult) VALUES (?, ?, ?, ?, ?, ?, ?)");
                            $stmt->execute([$user_id, $uniqueID, $num_kids, $address, $city, $schedule, $num_adult]);

                            // Check if the insertion was successful
                            if ($stmt->rowCount() > 0) {
                                // $_SESSION['user_id'] = $user['id'];
                                $success = 'Booking updated successfully!.';
                                header("location: history.php?success=" . urlencode($success)); 
                                exit; // Add an exit to prevent further execution
                            } else {
                                echo '<div class="alert alert-warning">No records updated. User not found or data already set to the same value.</div>';
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    } else {
                        $error_message_select = '<div class="alert alert-danger">Number of kids or adults are required.</div>';
                        header("location: book.php?error_message_select=" . urlencode($error_message_select)); 
                    }
            } else {
                $error_message_select = '<div class="alert alert-danger">Kids or Adult not selected.</div>';
                header("location: book.php?error_message_select=" . urlencode($error_message_select)); 
            }

        }else {
            $error_location = '<div class="alert alert-danger">Please confirm your new location.</div>';
            header("location: book.php?error_location=" . urlencode($error_location)); 
        }
    }else {
        $error_message_schedule = '<div class="alert alert-danger alert-sm">Schedule not selected.</div>';
        header("location: book.php?error_message_schedule=" . urlencode($error_message_schedule)); 
    }
    


?>