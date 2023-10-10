<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    if (isset($_POST['email']) && isset($_POST['psw'])) {
        $email = $_POST['email'];
        $password = $_POST['psw'];

        // Include your database connection script
        require_once '../connection/connect.php';

        // Retrieve user data from the database
        try {
            $stmt = $db->prepare("SELECT email, psw FROM users_registration WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['psw'])) {
                // Password is correct; start a session and store the email
                $_SESSION['email'] = $user['email'];
                header("Location: ../usersdashboard"); // Redirect to the dashboard upon successful login
                exit;
            } else {
                $invalidCredentials = 'Invalid Credential!.';
                 header("location: index.php?invalidCredentials=" . urlencode($invalidCredentials));
                exit;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Debugging: Print a message if email and password are not set
        echo "Email and password not set.";
    }
} else {
    // Handle invalid request
    header("Location: index.php");
    exit;
}
?>
