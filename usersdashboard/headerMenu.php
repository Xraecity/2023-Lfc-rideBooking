<?php
include 'fetchDB.php';

// Fetch ridebooking data from the database
    try {
        $stmt = $db->prepare("SELECT * FROM ridebooking WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $ridebookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Count the number of bookings
        $bookingCount = count($ridebookings);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        };



        try {
            $stmt = $db->prepare("SELECT * FROM report WHERE unique_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Count the number of bookings
            $reportCount = count($reports);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            };

            $email = $_SESSION['email'];

$stmt = $db->prepare("SELECT * FROM users_registration WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$_SESSION['user_id'] = $user['id'];


// Display user data
if (!$user) {
    header("location: ../login");
    // Display other user information
}
    ?>


<div class="horizontal-main-wrapper">
        <!-- main header area start -->
        <div class="mainheader-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="./"><img src="../img/logo/logo.png" alt="logo"></a>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-9 clearfix text-right">
                        <div class="d-md-inline-block d-block mr-md-4">
                            <ul class="notification-area">
                                <li id="full-view"><i class="ti-fullscreen"></i></li>
                                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                                <li class="dropdown">
                                    <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                    
                                        <span><?php if ($bookingCount > 0) : ?><?php echo $bookingCount; ?> <?php else : ?>0<?php endif; ?></span>
                                        
                                    </i>
                                    <div class="dropdown-menu bell-notify-box notify-box">
                                        <span class="notify-title"><?php if ($bookingCount > 0) : ?>You have <?php echo $bookingCount; ?> new notifications  <?php else : ?>you have no notification<?php endif; ?> <a href="history.php">view all</a></span>
                                        <div class="nofity-list">
                                            <?php

                                                                                                    
                                                        // Fetch ridebooking data from the database
                                                        try {
                                                            $user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session

                                                            $query = "SELECT rb.*
                                                            FROM ridebooking rb
                                                            INNER JOIN users_registration ur ON rb.user_id = ur.id
                                                            WHERE rb.user_id = ?
                                                            ORDER BY rb.created_at DESC";
                                                            
                                                            $stmt = $db->prepare($query);
                                                            $stmt->execute([$user_id]);
                                                            $ridebookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        } catch (PDOException $e) {
                                                            echo "Error: " . $e->getMessage();
                                                        }
                                                        ?>
                                                        
                                            <?php foreach ($ridebookings as $booking) : ?>
                                            <?php if ($bookingCount > 0) : ?>
                                                <a href="#" class="notify-item">
                                                    <div class="notify-thumb"><i class="ti-car btn-danger"></i></div>
                                                    <div class="notify-text">
                                                        <p>You booked a ride for <div class="text-danger"><?= $booking["schedule"]; ?></div> </p>
                                                        <small class="text-danger">Pickup: <?= $booking["address"]; ?>, <?= $booking["city"]; ?> </small>
                                                        <br>
                                                        <span>
                                                            <?php 
                                                        date_default_timezone_set("America/Winnipeg");
                                                        $timestamp = strtotime($booking['created_at']);
                                                        $timeDifference = time() - $timestamp;
                                                        
                                                        if ($timeDifference <= 60) {
                                                            $formattedTime = "just now";
                                                        } elseif ($timeDifference < 3600) {
                                                            $minutes = floor($timeDifference / 60);
                                                            $formattedTime = ($minutes == 1) ? "1 min ago" : $minutes . " mins ago";
                                                        } elseif ($timeDifference < 86400) {
                                                            $hours = floor($timeDifference / 3600);
                                                            $formattedTime = ($hours == 1) ? "1 hr ago" : $hours . " hrs ago";
                                                        } elseif ($timeDifference < 2592000) { // 30 days
                                                            $days = floor($timeDifference / 86400);
                                                            $formattedTime = ($days == 1) ? "1 day ago" : $days . " days ago";
                                                        } elseif ($timeDifference < 31536000) { // 12 months
                                                            $months = floor($timeDifference / 2592000);
                                                            $formattedTime = ($months == 1) ? "1 month ago" : $months . " months ago";
                                                        } else {
                                                            $years = floor($timeDifference / 31536000);
                                                            $formattedTime = ($years == 1) ? "1 year ago" : $years . " years ago";
                                                        }
                                                        
                                                        // echo $formattedTime;

                                                                            ?>
                                                                            <?= $formattedTime; ?></span>
                                                    </div>
                                                </a>
                                                <?php else: ?>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            <a href="#" class="notify-item">
                                                <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                                <div class="notify-text">
                                                    <p>New message from Admin</p>
                                                    <span>30 Seconds ago</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <i class="fa fa-envelope-o dropdown-toggle" data-toggle="dropdown"><span>3</span></i>
                                    <div class="dropdown-menu notify-box nt-enveloper-box">
                                        <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                        <div class="nofity-list">
                                            <a href="#" class="notify-item">
                                                <div class="notify-thumb">
                                                    <img src="assets/images/author/author-img1.jpg" alt="image">
                                                </div>
                                                <div class="notify-text">
                                                    <p>Aglae Mayer</p>
                                                    <span class="msg">Hey I am waiting for you...</span>
                                                    <span>3:15 PM</span>
                                                </div>
                                            </a>
                                            <a href="#" class="notify-item">
                                                <div class="notify-thumb">
                                                    <img src="assets/images/author/author-img1.jpg" alt="image">
                                                </div>
                                                <div class="notify-text">
                                                    <p>Aglae Mayer</p>
                                                    <span class="msg">Hey I am waiting for you...</span>
                                                    <span>3:15 PM</span>
                                                </div>
                                            </a>
                                            <a href="#" class="notify-item">
                                                <div class="notify-thumb">
                                                    <img src="assets/images/author/author-img3.jpg" alt="image">
                                                </div>
                                                <div class="notify-text">
                                                    <p>Aglae Mayer</p>
                                                    <span class="msg">Hey I am waiting for you...</span>
                                                    <span>3:15 PM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main header area end -->
        <!-- header area start -->
        <div class="header-area header-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9  d-none d-lg-block">
                        <div class="horizontal-menu">
                            <nav>
                                <ul id="nav_menu">
                                    <li class="active">
                                        <a href="../usersdashboard/./"><i class="ti-dashboard"></i><span>dashboard</span></a>
                                    </li>
                                    <li>
                                        <a href="../usersdashboard/book.php"><i class="ti-car"></i><span>Book a ride</span></a>
                                    </li>
                                    <li>
                                        <a href="../usersdashboard/history.php"><i class="ti-pie-chart"></i><span>History</span></a>
                                    </li>
                                    <li>
                                        <a href="../usersdashboard/report.php"><i class="ti-slice"></i><span>Ticket</span></a>
                                    </li>
                                    <li>
                                        <a href="../usersdashboard/profile.php"><i class="ti-slice"></i><span>Profile</span></a>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="javascript:void(0)"><i class="ti-layers-alt"></i> <span>Pages</span></a>
                                        <ul class="submenu">
                                            <li><a href="calendar.php">Calendar</a></li>
                                            <li><a href="reset-pass.html">reset password</a></li>
                                            <li><a href="pricing.html">Pricing</a></li>
                                            <li><a href="maps.html"><i class="ti-map-alt"></i> <span>maps</span></a></li>
                                            <li><a href="invoice.html"><i class="ti-receipt"></i> <span>Invoice Summary</span></a></li>
                                            <li><a href="accordion.html">Accordion</a></li>
                                            <li><a href="alert.html">Alert</a></li>
                                            <li><a href="badge.html">Badge</a></li>
                                            <li><a href="button.html">Button</a></li>
                                            <li><a href="button-group.html">Button Group</a></li>
                                            <li><a href="cards.html">Cards</a></li>
                                            <li><a href="dropdown.html">Dropdown</a></li>
                                            <li><a href="list-group.html">List Group</a></li>
                                            <li><a href="media-object.html">Media Object</a></li>
                                            <li><a href="modal.html">Modal</a></li>
                                            <li><a href="pagination.html">Pagination</a></li>
                                            <li><a href="popovers.html">Popover</a></li>
                                            <li><a href="progressbar.html">Progressbar</a></li>
                                            <li><a href="tab.html">Tab</a></li>
                                            <li><a href="typography.html">Typography</a></li>
                                            <li><a href="book.php">book</a></li>
                                            <li><a href="grid.html">grid system</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- nav and search button -->
                    <!-- <div class="col-lg-3 clearfix">
                        <div class="search-box">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div> -->
                    <!-- mobile_menu -->
                    <div class="col-12 d-block d-lg-none">
                        <div id="mobile_menu"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header area end -->
        