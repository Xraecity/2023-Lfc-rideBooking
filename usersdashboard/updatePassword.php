
<?php
require_once 'fetchDB.php'; // Include your database connection file

if (!isset($_SESSION['email'])) {
    header("Location: ../login"); // Redirect to the login page if the user is not logged in
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission
    if (isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validate the form data
        if (!empty($old_password) && !empty($new_password) && !empty($confirm_password)) {
            // Check if the old password matches the current password in the database
            $stmt = $db->prepare("SELECT psw FROM users_registration WHERE email = ?");
            $stmt->execute([$_SESSION['email']]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && password_verify($old_password, $row['psw'])) {
                // Old password matches, now update the password
                if ($new_password === $confirm_password) {
                    // Hash the new password
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    
                    // Update the password in the database
                    $update_stmt = $db->prepare("UPDATE users_registration SET psw = ? WHERE email = ?");
                    $update_stmt->execute([$hashed_password, $_SESSION['email']]);
                    
                    // Redirect to a success page or the profile page
                    $error_message =  '<div class="alert alert-success">Password Updated</div>';
                } else {
                    $error_message = "New passwords do not match.";
                }
            } else {
                $error_message = "Invalid old password.";
            }
        } else {
            $error_message = "All fields must be filled.";
        }
    }
}
?>



<?php if (isset($error_message)) : ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
<form action="#" method="POST">
    <div class="form-group">
        <label for="old_password">Old Password</label>
        <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password" required>
    </div>
    <hr style="margin: 20px; background: dodgerblue; height: 1px; border-radius: 100%;">
    <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" required>
    </div>
    <div class="form-group">
        <label for="confirm_password">Repeat New Password</label>
        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Repeat Password" required>
    </div>
    <div class="form-check">
        <p><a href="#" style="cursor: pointer !important; color: purple;">Forgot password? Click here.</a></p>
    </div>
    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Change Password</button>
</form>