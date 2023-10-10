<?php
include 'session.php';
include 'fetchDB.php';

try {
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session

    $query = "SELECT * FROM ridebooking WHERE user_id = ? ORDER BY created_at ASC";
    
    $stmt = $db->prepare($query);
    $stmt->execute([$user_id]);
    $ridebookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($ridebookings as $booking) {
        $dateString = $booking['created_at']; // Get the "created_at" date from the database
        $schedule = $booking['schedule']; 


        if ($schedule === "Bi-weekly") {
            // Convert the date string to a timestamp and then format it as the day
            $timestamp = strtotime($dateString);
            $dayName = date("l", $timestamp); // "l" represents the full day name

            // Calculate the nearest Sunday based on the "created_at" date
            if ($dayName === "Sunday") {
                // If "created_at" is already a Sunday, use the same date
                $nextSundayFormatted = date('Y-m-d', $timestamp);
            } else {
                // If "created_at" is not a Sunday, calculate the next Sunday
                $nextSunday = new DateTime($dateString);
                $nextSunday->modify('next Sunday');
                $nextSundayFormatted = $nextSunday->format('Y-m-d');
            }

            // Calculate the second Sunday (add 7 days to the next Sunday)
            $secondSunday = new DateTime($nextSundayFormatted);
            $secondSunday->add(new DateInterval('P14D'));
            $secondSundayFormatted = $secondSunday->format('Y-m-d');
        }
        elseif ($schedule === "Every Sunday") {
            // Convert the date string to a timestamp and then format it as the day
            $timestamp = strtotime($dateString);
            $dayName = date("l", $timestamp); // "l" represents the full day name

            // Calculate the nearest Sunday based on the "created_at" date
            if ($dayName === "Sunday") {
                // If "created_at" is already a Sunday, use the same date
                $nextSundayFormatted = date('Y-m-d', $timestamp);
            } else {
                // If "created_at" is not a Sunday, calculate the next Sunday
                $nextSunday = new DateTime($dateString);
                $nextSunday->modify('next Sunday');
                $nextSundayFormatted = $nextSunday->format('Y-m-d');
            }

            // Calculate the second Sunday (add 7 days to the next Sunday)
            $secondSunday = new DateTime($nextSundayFormatted);
            $secondSunday->add(new DateInterval('P7D'));
            $secondSundayFormatted = $secondSunday->format('Y-m-d');
        }
        elseif ($schedule === "one-time") {
            // Convert the date string to a timestamp and then format it as the day
            $timestamp = strtotime($dateString);
            $dayName = date("l", $timestamp); // "l" represents the full day name

            // Calculate the nearest Sunday based on the "created_at" date
            if ($dayName === "Sunday") {
                // If "created_at" is already a Sunday, use the same date
                $nextSundayFormatted = date('Y-m-d', $timestamp);
            } else {
                // If "created_at" is not a Sunday, calculate the next Sunday
                $nextSunday = new DateTime($dateString);
                $nextSunday->modify('next Sunday');
                $nextSundayFormatted = $nextSunday->format('Y-m-d');
            }

            // Calculate the second Sunday (add 7 days to the next Sunday)
            $secondSunday = new DateTime($nextSundayFormatted);
            $secondSunday->add(new DateInterval('P0D'));
            $secondSundayFormatted = $secondSunday->format('Y-m-d');
        }

         else {
            // Handle other schedule types here if needed
            // For non-bi-weekly schedules
            $nextSundayFormatted = "Not Applicable";
            $secondSundayFormatted = "Not Applicable";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


<!Doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Calendar</title>
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
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="container">
                    <div class="row">
            <!-- page title area start -->
                    <div class="page-title-area">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="breadcrumbs-area clearfix">
                                    <h4 class="page-title pull-left">Book a Ride</h4>
                                    <ul class="breadcrumbs pull-left">
                                        <li><a href="./">Dashboad</a></li>
                                        <li><span>My Schedule</span></li>
                                    </ul>
                                </div>
                            </div>
                            <?php include 'subMenu.php' ?>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-lg-8 pl-4 mt-5">
                        <div class="card" style="border-bottom: 5px solid purple; box-shadow: 9px 2px 9px black;">
                            <div class="card-body">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                events: [
                    {
                        title: 'this Sunday',
                        start: '<?= $nextSundayFormatted ?>',
                        color: '#8914fe',
                        textColor: 'white'
                    },
                    {
                        title: 'My next pickup',
                        start: '<?= $secondSundayFormatted ?>',
                        color: 'brown',
                        textColor: 'white'
                    }
                ],
                defaultView: 'month',
                editable: false
            });
        });
    </script>
    
       <!-- offset area end -->
    <!-- jquery latest version -->
    <!-- <script src="assets/js/vendor/jquery-2.2.4.min.js"></script> -->
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