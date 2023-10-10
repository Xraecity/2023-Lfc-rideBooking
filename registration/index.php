<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Registration</title>
    <?php include "../usersdashboard/links.php"; ?>
    <script src="auth.js"></script>
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
    //<?php //include ("../usersdashboard/headerMenu.php"); ?>

    
        <script src="../googleMap/googleMap.js"></script>
    <div class="main-content-inner">
        <div class="container">
            <div class="row">
    <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Registration</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="./" class="text-danger">visit website</a></li>
                                <li><span>Registration</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix bg-danger">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../usersdashboard/assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Hi <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="../usersdashboard/profile.php">Profile</a>
                                <a class="dropdown-item" href="#register">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="login-box ptb--100" id="register">
                <form class="needs-validation" action="config.php" id="form-validate" method="POST" novalidate="">
                    <div class="login-form-head">
                    <a href="./"><img src="../img/logo/logo.png" width="100px" alt="logo"></a>
                        <h4>Sign up</h4>
                        <p>Hello there, Sign up and Join with Us</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="lastName">last Name</label>
                            <input type="text" name="lname" id="lastName">
                            <i class="ti-user"></i>
                            <div class="error text-danger" id="invalidLastName">last name can not be empty*</div>
                        </div>
                        <div class="form-gp">
                            <label for="firstName">First Name</label>
                            <input type="text" name="fname" id="firstName">
                            <i class="ti-user"></i>
                            <div class="error text-danger" id="invalidFirstName">first name can not be empty*</div>
                        </div>
                        <div class="form-gp">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone">
                            <i class="fa fa-phone"></i>
                            <div class="error text-danger" id="invalidPhone">please enter a valid number*</div>
                        </div>
                        <div class="form-gp">
                            <label for="email">Email address</label>
                            <input type="email" name="email" id="email">
                            <i class="ti-email"></i>
                            <div class="error text-danger" id="invalidEmail">please enter a valid email*</div>
                        </div>
                        <div class="form-gp">
                            <label for="location-input">Address</label>
                            <input type="text" name="address" id="location-input" placeholder="">
                            <i class="fa fa-map-pin"></i>
                            <div class="error text-danger" id="invalidAddress">please enter a valid Address*</div>
                        </div>
                        <div class="form-gp">
                            <label for="locality-input">City</label>
                            <input type="text" name="city" id="locality-input">
                            <i class="fa fa-location-arrow"></i>
                            <div class="error text-danger" id="invalidCity">please enter a valid city*</div>
                        </div>
                        <div class="row ">
                            <div class="col-6">
                                <div class="form-gp">
                                    <label for="male">Male</label>
                                    <input type="radio" id="male" name="gender" value="male">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-gp">
                                    <label for="female">Female</label>
                                    <input type="radio" id="female" name="gender" value="female">
                                </div>
                            </div>
                            <div class="error text-danger" id="invalidGender">please select gender*</div>
                        </div>
                            <div class="form-gp">
                                <label for="firstTimer" class="text-dark">Are you a new member / is this your first time to church ? (Optional) </label>
                                <br>
                                <br>
                                <br>
                                    <select name="firstTime" required id="firstTimer" class="col-form-label col-lg-12 aling-center text-center bg-danger user-profile text-light" onchange="toggleReferralInput()" style="cursor: pointer">
                                        <option value="" disabled selected>-- Select Option --</option>
                                        <option value="Yes, am new to church">Yes, am new to church</option>
                                        <option value="no">No, am not new</option>
                                    </select>
                                    <div id="referralInput" class="mt-4">
                                        <div class="form-gp">
                                            <label for="fTime">Who invited you? or How do you hear about us? (Optional)</label>
                                            <input type="text" id="fTime" name="fTime" required>
                                            <i class="fa fa-bolt"></i>
                                        </div>
                                    </div>
                                    
                            </div>
                            
                        <div class="form-gp">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="psw" onkeyup="getValues()">
                            <i class="ti-lock"></i>
                            <div class="text-danger error" id="invalidPassword">Please enter a password*</div>
                        </div>
                        <div class="form-gp">
                            <label for="confirmPass">Confirm Password</label>
                            <input type="password" id="confirmPass" onkeyup="getValues()">
                            <i class="ti-lock"></i>
                            <div class="text-danger error" id="invalidConfirmPass">Password do not match</div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                            <div class="login-other row mt-4">
                                <div class="col-6">
                                    <a class="fb-login" href="#">Sign up with <i class="fa fa-facebook"></i></a>
                                </div>
                                <div class="col-6">
                                    <a class="google-login" href="#">Sign up with <i class="fa fa-google"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Already a user? <a href="../login">Sign in</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="map" id="gmp-map" style="display: none;"></div>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1W-Ozu30HBRPesfZcEN2ftAo2y_gBzqY&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC" async defer></script>
    
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