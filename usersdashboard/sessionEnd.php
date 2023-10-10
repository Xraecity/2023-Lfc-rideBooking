<?php
include 'fetchDB.php';
session_start();

        $email = $_SESSION['email'];
        $stmt = $db->prepare("SELECT session_id FROM users_registration WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       
        if ($row && $row['session_id'] == 0) {
            // Session_id is 0, stay on sessionEnd.php
            // Display a message or perform other actions as needed
            $error_message = "Your session has expired. Please log in again.";
        } 
        else{
            header('Location: index.php');
            exit();
        }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $password = $_POST['password'];
        
                // Check if the user is still authenticated
                if (isset($_SESSION['email'])) {
                    // Check the password against the database
                    $query = "SELECT * FROM users_registration WHERE email = ?";
                    $stmt = $db->prepare($query);
                    $stmt->execute([$email]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
                    if ($user && password_verify($password, $user['psw'])) {
                        // Session_id is 1, update the session_id in the users_dashboard table to 1
            
                        $error_message = "correct";
                        $stmt = $db->prepare("UPDATE users_registration SET session_id = 1 WHERE email = ?");
                        $stmt->execute([$email]);
                        // // Password is correct, redirect to the dashboard
                        $_SESSION['authenticated'] = true;
                        $_SESSION['last_activity'] = time();
                        // header('Location: index.php');
                        // exit();
                        // if (isset($_SESSION['previous_page'])) {
                            // Redirect the user back to the previous page
                            header('Location: ' . $_SESSION['previous_page']);
                            unset($_SESSION['previous_page']); // Remove the stored URL
                            exit();
                        // }
                        }else {
                            // If the previous page URL is not stored, redirect to the default page (e.g., index.php)
                            header('Location: ../login');
                            exit();
                        }
                    } else {
                        $error_message = "You entered an incorrect password. Please try again.";
                    }
                } else {
                    $error_message = 'Session expired. Please log in again.';
                }
            
        




                                $email = $_SESSION['email'];

                                $stmt = $db->prepare("SELECT * FROM users_registration WHERE email = ?");
                                $stmt->execute([$email]);
                                $user = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Timeout</title>
    <?php include "links.php"; ?>
</head>

<body class="body-bg">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <!-- <div id="preloader">
        <div class="loader"></div>
    </div> -->
    <!-- preloader area end -->
    <!-- main wrapper start -->
    <?php include ("headerMenu.php"); ?>
    <!-- page title area start -->

    <div class="login-area login-bg">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST">
                    <div class="login-form-head">
                        <h4>Session Timeout</h4>
                        <p>Oups! <b><?= $user['fname']; ?></b> you've been logged out!.</p>
                        <?php if (isset($error_message)): ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                <strong>Hello <?= $user['fname']; ?>!</strong> <?= $error_message ?> or click <a href="../login"> here</a> to manually login
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                                </button>
                            </div>
                            <?php endif; ?>
                    </div>
                    <div class="login-form-body">
                   
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" id="exampleInputPassword1">
                            <input name="session_id" value="1" hidden >
                            <i class="ti-lock"></i>
                        </div>
                        <div class="submit-btn-area mt-5">
                            <button id="form_submit" type="submit">Unlock <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>