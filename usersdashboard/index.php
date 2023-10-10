<?php
include 'session.php';
// Display the dashboard content for logged-in users
?>




<!Doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LFC - <?php echo $user['fname']; ?></title>
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
    <div class="main-content-inner">
            <div class="container">
                <div class="row">
            <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">My Dashbaord</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="./">Home</a></li>
                                    <li><span><?= $user['lname']; ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <?php include 'submenu.php'; ?>
                    </div>
                </div>

                    <!-- seo fact area start -->
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-6 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact bg-dark">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="fa fa-automobile"></i> Total Ride <br>
                                                <h4><?php echo $bookingCount; ?></h4>
                                            </div>
                                            <canvas id="seolinechart3" height="60"></canvas>
                                        </div>
                                        <a href="book.php"><button class="btn btn-primary mb-4 mr-4 float-right">Book ride</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact bg-primary">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="ti-share"></i> Total Report <br>
                                                <h4><?php if ($reportCount > 0) : ?><?php echo $reportCount; ?> <?php else : ?> 0 <?php endif; ?></h4>
                                            </div>
                                        </div>
                                        <a href="report.php"><button class="btn btn-dark mb-4 mr-4 float-right">Send a report</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- seo fact area end -->
                    <!-- Social Campain area start -->
                    <!-- <div class="col-lg-4 mt-5">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h4 class="header-title">Social ads Campain</h4>
                                <div id="socialads" style="height: 245px;"></div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Social Campain area end -->
                    <!-- Statistics area start -->
                    <!-- <div class="col-lg-8 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">User Statistics</h4>
                                <div id="user-statistics"></div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Statistics area end -->
                    <!-- Advertising area start -->
                    <!-- <div class="col-lg-4 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Advertising & Marketing</h4>
                                <canvas id="seolinechart8" height="233"></canvas>
                            </div>
                        </div>
                    </div> -->
                    <!-- Advertising area end -->
                    <!-- sales area start -->
                    <div class="col-xl-8 col-lg-8 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Sunday Blog</h4>
                                <div class="card-body">
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur corporis soluta cupiditate veritatis, provident ipsa velit quas culpa impedit cumque porro aliquid atque aspernatur fuga accusamus, dignissimos earum in nihil.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- sales area end -->
                    <!-- timeline area start -->
                    <div class="col-xl-4 col-lg-4 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Timeline</h4>
                                <div class="timeline-area">
                                    <div class="timeline-task">
                                        <div class="icon bg1">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="tm-title">
                                            <h4>Rashed sent you an email</h4>
                                            <span class="time"><i class="ti-time"></i>09:35</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                                        </p>
                                    </div>
                                    <div class="timeline-task">
                                        <div class="icon bg2">
                                            <i class="fa fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="tm-title">
                                            <h4>Rashed sent you an email</h4>
                                            <span class="time"><i class="ti-time"></i>09:35</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- timeline area end -->
                    <!-- map area start -->
                    <div class="col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Your Address</h4>
                                <div id="seomap"></div>
                            </div>
                        </div>
                    </div>
                    <!-- map area end -->
                    <!-- testimonial area start -->
                    <div class="col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-body bg1">
                                <h4 class="header-title text-white">Client Feadback</h4>
                                <div class="testimonial-carousel owl-carousel">
                                    <div class="tst-item">
                                        <div class="tstu-img">
                                            <img src="assets/images/team/team-author1.jpg" alt="author image">
                                        </div>
                                        <div class="tstu-content">
                                            <h4 class="tstu-name">Abel Franecki</h4>
                                            <span class="profsn">Designer</span>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae laborum ut nihil numquam a aliquam alias necessitatibus ipsa soluta quam!</p>
                                        </div>
                                    </div>
                                    <div class="tst-item">
                                        <div class="tstu-img">
                                            <img src="assets/images/team/team-author2.jpg" alt="author image">
                                        </div>
                                        <div class="tstu-content">
                                            <h4 class="tstu-name">Abel Franecki</h4>
                                            <span class="profsn">Designer</span>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae laborum ut nihil numquam a aliquam alias necessitatibus ipsa soluta quam!</p>
                                        </div>
                                    </div>
                                    <div class="tst-item">
                                        <div class="tstu-img">
                                            <img src="assets/images/team/team-author3.jpg" alt="author image">
                                        </div>
                                        <div class="tstu-content">
                                            <h4 class="tstu-name">Abel Franecki</h4>
                                            <span class="profsn">Designer</span>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae laborum ut nihil numquam a aliquam alias necessitatibus ipsa soluta quam!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- testimonial area end -->
                </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
      

    <?php include 'footer.php'; ?>
