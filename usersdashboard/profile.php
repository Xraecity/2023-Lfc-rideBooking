<?php
include 'session.php';
// Display the dashboard content for logged-in users
?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Profile - <?= $user['fname']; ?></title>
    <?php include "links.php"; ?>
</head>

<body class="body-bg">
    
    <?php include ("headerMenu.php"); ?>
    <div class="main-content-inner">
        <div class="container">
            <div class="row">
    <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">My Profile</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="./">Dashboad</a></li>
                                <li><span>Profile</span></li>
                            </ul>
                        </div>
                    </div>
                    <?php include 'submenu.php'; ?>
                </div>
            </div>

            
                    <div class="col-lg-12 col-ml-12">
                        <div class="row">
                            <!-- Textual inputs start -->
                            <div class="col-lg-6">
                                <div class="card mt-5"  style="border-top: 2px solid purple">
                                    <div class="card-body">
                                        <h4 class="header-title">My Profile Information</h4>
                                        <?php include 'profileUpdate.php'; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Server side end -->

                            
                            <!-- basic form start -->
                            <div class="col-lg-3 mt-5">
                                <div class="card" style="border-top: 2px solid dodgerblue">
                                    <div class="card-body">
                                        <h4 class="header-title">Change Password</h4>
                                        <?php include 'updatePassword.php'; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- basic form start -->
                            <div class="col-lg-3 mt-5">
                                <div class="card" style="border-bottom: 2px solid #8914fe ">
                                    <div class="card-body">
                                        <h4 class="header-title">Change Avartar</h4>
                                        <?php include 'avatar.php'; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- basic form end -->
                        </div>
                    </div>
                </div>
                    <div class="col-lg-10 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Close my Account </h4>
                                <p>I want <code>to close</code> my <code>Account</code> for now.</p>
                                <!-- Button trigger modal -->
                                            <div class="col-lg-3 mr-0">
                                                <button type="button" class="btn btn-danger btn-block btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Next</button>
                                            </div>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Account <i class="fa fa-trash"></i></h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Deactivating your account, you agree to lose all your information </p>
                                                <p>Instead you can suspend your account, by <a href="report.php">reporting</a> to an Admin</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Close Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>

    <?php include 'footer.php'; ?>
</body>

</html>
