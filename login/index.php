<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <?php include "../usersdashboard/links.php"; ?>
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
   <?php //include ("../usersdashboard/headerMenu.php"); ?>

    
    <div class="main-content-inner">
        <div class="container">
            <div class="row">
    <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Login</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="./" class="text-danger">visit website</a></li>
                                <li><span>Login</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix bg-danger">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../usersdashboard/assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">... <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="../usersdashboard/profile.php">Profile</a>
                                <a class="dropdown-item" href="#login">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="login-box ptb--100">
                <form class="needs-validation" action="process_login.php"  method="POST">
                    <div class="login-form-head">
                    <a href="./"><img src="../img/logo/logo.png" width="100px" alt="logo"></a>
                        <h4>Sign in</h4>
                        <p>Hello there, please Sign in to access your ride</p>
                    </div>
                    <div class="login-form-body" id="login">
                    <?php if (isset($_GET['invalidCredentials'])) : ?>
                        <div class="alert alert-danger">
                            <?php echo urldecode($_GET['invalidCredentials']); ?>
                        </div>
                        <?php endif; ?>
                        <div class="form-gp">
                            <label for="email">Email address</label>
                            <input type="email" name="email" id="email">
                            <i class="ti-email"></i>
                            <div class="error text-danger" id="invalidEmail">please enter a valid email*</div>
                        </div>
                            
                        <div class="form-gp">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="psw">
                            <i class="ti-lock"></i>
                            <div class="text-danger error" id="invalidPassword">Please enter a password*</div>
                        </div>
                        
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">login <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <small class="text-muted">forgot password? <a href="../registration">Rest now</a></small>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">new user? <a href="../registration">Sign up</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->
<style>
    .error{
        display: none;
    }
    #referralInput{
        display: none;
    }
</style>
    <!-- jquery latest version -->
    <script src="../usersdashboard/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../usersdashboard/assets/js/popper.min.js"></script>
    <script src="../usersdashboard/assets/js/bootstrap.min.js"></script>
    <script src="../usersdashboard/assets/js/owl.carousel.min.js"></script>
    <script src="../usersdashboard/assets/js/metisMenu.min.js"></script>
    <script src="../usersdashboard/assets/js/jquery.slimscroll.min.js"></script>
    <script src="../usersdashboard/assets/js/jquery.slicknav.min.js"></script>
    
    <!-- others plugins -->
    <script src="../usersdashboard/assets/js/plugins.js"></script>
    <script src="../usersdashboard/assets/js/scripts.js"></script>
    
</body>

</html>