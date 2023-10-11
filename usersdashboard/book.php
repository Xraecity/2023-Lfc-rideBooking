<?php
include 'session.php';
include 'fetchDB.php';

// Get the current date
$currentDate = new DateTime();

// Calculate the date of the next Sunday
$nextSunday = clone $currentDate;
$nextSunday->modify('next Sunday');

// Calculate the date of the second Sunday
$secondSunday = clone $nextSunday;
$secondSunday->modify('+1 week');

// Format the dates
$nextSundayFormatted = $nextSunday->format('l jS M');
$secondSundayFormatted = $secondSunday->format('l jS M');


?>

<!Doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Get a Ride</title>
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
                                        <li><span>Get Ride</span></li>
                                    </ul>
                                </div>
                            </div>
                            <?php include 'subMenu.php' ?>
                        </div>
                    </div>

        <!-- check if the user booked a ride  -->
       
                
                <?php

                        $ridebookingData = array();
                                        
                        // Fetch ridebooking data from the database
                        $query = "SELECT * FROM ridebooking WHERE user_id = :user_id ORDER BY created_at DESC";
                        $dis = ''; // Initialize the message
                        $scheduleEverySunday = false; // Initialize a flag
                        $scheduleBiWeekly = false; // Initialize a flag
                        $scheduleOneTime = false; // Initialize a flag

                        try {
                            // Prepare and execute the query
                            $stmt = $db->query($query);

                            // Check if there are any records
                            if ($stmt->rowCount() > 0) {
                                // Loop through the results and store data in the array
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $ridebookingData[] = $row;
                                }
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }

                        // Now you can access ridebooking data outside the loop
                        foreach ($ridebookingData as $row) {
                            $bookedDate = new DateTime($row['created_at']); // Example date, replace with actual date

                            // Get the current date
                            $currentDate = new DateTime();

                            // Calculate the difference in days between the current date and booked date
                            $dateDifference = $bookedDate->diff($currentDate)->days;
                            
                            $todays = date('l jS'); // Get the current date and format as "Day Date"

                            // Calculate the date 7 days from the date created on DB
                            $OneTimeAvaliability = date('l jS', strtotime($row['created_at'] . ' +7 days'));

                            $BiWeeklyAvaliability = date('l jS', strtotime($row['created_at'] . ' +14 days'));

                            // Check if 'schedule' key exists in the $row array and if it's "Every Sunday"
                                    if (isset($row['schedule']) && $row['schedule'] == "Every Sunday") {
                                        $scheduleEverySunday = true; // Set the flag to true
                                        break; // Exit the loop, no need to check further
                                    }
                                    if (isset($row['schedule']) && $row['schedule'] == "Bi-weekly") {
                                        $scheduleBiWeekly = true; // Set the flag to true
                                        break; // Exit the loop, no need to check further
                                    }
                                    if (isset($row['schedule']) && $row['schedule'] == "one-time") {
                                        $scheduleOneTime = true; // Set the flag to true
                                        break; // Exit the loop, no need to check further
                                    }

                        }
                                        
                    if ($scheduleEverySunday) {
                        // Display the alert message if the schedule is "Every Sunday"
                        $dis = '<div class="alert alert-warning pl-4 mt-5" role="alert">
                            <h4 class="alert-heading">Oups!</h4>
                            <p>Aww, sorry you are unable to book another ride!.</p>
                            <hr>
                            <p class="mb-0">"We apologize, but it seems you are unable to book another ride throughtout this year till further notice due to your schedule being set for every Sunday.
                            If you have any urgent travel needs or need to make changes to your schedule, please <a href="report.php">contact</a> our admin team for assistance or you can <a href="history.php"> Edit</a> your pickup address only. We are here to help you find a solution that suits your requirements. Thank you for choosing our services, and we appreciate your understanding.</p>
                        </div>';
                    }
                    if ($scheduleBiWeekly) {
                        // Display the alert message if the schedule is "Every Sunday"
                        $dis = '<div class="alert alert-warning pl-4 mt-5" role="alert">
                            <h4 class="alert-heading">Oups!</h4>
                            <p>Aww, sorry you are unable to book another ride at till upper week.</p>
                            <hr>
                            <p class="mb-0">"We apologize, but it seems you are unable to book another ride until after <b>' .$secondSundayFormatted. '</b> due to your schedule being set for Bi weekly.
                            If you have any urgent travel needs or need to make changes to your schedule, please <a href="report.php">contact</a> our admin team for assistance or you can <a href="history.php"> Edit</a> your pickup address only. We are here to help you find a solution that suits your requirements. Thank you for choosing our services, and we appreciate your understanding.</p>
                        </div>';
                    }if ($scheduleOneTime) {
                        // Display the alert message if the schedule is "Every Sunday"
                        $dis = '<div class="alert alert-warning pl-4 mt-5" role="alert">
                            <h4 class="alert-heading">Oups!</h4>
                            <p>Aww, sorry you are unable to book another ride.</p>
                            <hr>
                            <p class="mb-0">"We apologize, but it seems you are unable to book another ride till next week Saturday due to your schedule being set one time (Tomorrow ' .$OneTimeAvaliability . ' ).
                            If you have any urgent travel needs or need to make changes to your schedule, please <a href="report.php">contact</a> our admin team for assistance or you can <a href="history.php"> Edit</a> your pickup address only. We are here to help you find a solution that suits your requirements. Thank you for choosing our services, and we appreciate your understanding.</p>
                        </div>';
                    }


                    if($scheduleEverySunday)
                        echo $dis;
                    else
                        if($scheduleOneTime && $OneTimeAvaliability != $todays)
                        echo $dis;
                        elseif($scheduleBiWeekly && $BiWeeklyAvaliability != $todays)
                        echo $dis;
                        else{
                           echo include 'rideBooking.php';
                        }
                ?>
                
                </div>
            </div>
        </div>
    </div>
</div>
</div>

        <style>
            #submit{
                display: none;
            }
        </style>
<script>
    let next = document.getElementById("next");

function display() {
    let kids = document.getElementById("kidSelection");
    let adults = document.getElementById("adultSelection");
    let address = document.getElementById("location-input").value;
    let city = document.getElementById("locality-input").value;
    let everySunday = document.getElementById("customCheck3");
    let oneTime = document.getElementById("customCheck4");
    let biWeekly = document.getElementById("customCheck5");
    let pleaseVerify = document.getElementById("pleaseVerify");
    let submit = document.getElementById("submit");
    



    
    let display_address = document.getElementById("address-display");
    let display_city = document.getElementById("city-display");
    let display_kids = document.getElementById("kids-display");
    let display_adults = document.getElementById("adults-display");
    let display_schedule = document.getElementById("schedule-display");

    if(kids.value == 1)
    display_kids.innerHTML = ` <span class="badge badge-success"> One kid </span>`;
    if(kids.value == 2)
    display_kids.innerHTML = ` <span class="badge badge-success"> Two kids </span>`;
    if(kids.value == 3)
    display_kids.innerHTML = ` <span class="badge badge-success"> Three kids </span>`;
    if(kids.value == 4)
    display_kids.innerHTML = ` <span class="badge badge-success"> Four kids </span>`;
    if(kids.value == 5)
    display_kids.innerHTML = ` <span class="badge badge-success"> Five kids </span>`;
    if(kids.value == 6)
    display_kids.innerHTML = ` <span class="badge badge-success"> Six kids </span>`;
    if(kids.value == 7)
    display_kids.innerHTML = ` <span class="badge badge-success"> Seven kids </span>`;
    if(kids.value == 8)
    display_kids.innerHTML = ` <span class="badge badge-success"> Eight kids </span>`;
    if(kids.value == 9)
    display_kids.innerHTML = ` <span class="badge badge-success"> Nine kids </span>`;
    if(kids.value == 10)
    display_kids.innerHTML = ` <span class="badge badge-success"> Ten kids </span>`;
    if(kids.value == 0)
    display_kids.innerHTML = ` <span class="badge badge-danger"> No ride for kids !</span> `;

    if(adults.value == 1)
    display_adults.innerHTML = ` <span class="badge badge-success">Myself only </sapn>`;
    if(adults.value == 2)
    display_adults.innerHTML = ` <span class="badge badge-success">Two adults </sapn>`;
    if(adults.value == 3)
    display_adults.innerHTML = ` <span class="badge badge-success">Three adults </sapn>`;
    if(adults.value == 4)
    display_adults.innerHTML = ` <span class="badge badge-success">Four adults </sapn>`;
    if(adults.value == 5)
    display_adults.innerHTML = ` <span class="badge badge-success">Five adults </sapn>`;
    if(adults.value == 6)
    display_adults.innerHTML = ` <span class="badge badge-success">Six adults </sapn>`;
    if(adults.value == 7)
    display_adults.innerHTML = ` <span class="badge badge-success">Seven adults </sapn>`;
    if(adults.value == 8)
    display_adults.innerHTML = ` <span class="badge badge-success">Eight adults </sapn>`;
    if(adults.value == 9)
    display_adults.innerHTML = ` <span class="badge badge-success">Nine adults </sapn>`;
    if(adults.value == 10)
    display_adults.innerHTML = ` <span class="badge badge-success">Ten adults </sapn>`;
    if(adults.value == 0)
    display_adults.innerHTML = ` <span class="badge badge-danger"> No ride for either you or adults !</span> `;


    display_address.innerHTML =  " "+address;
    display_city.innerHTML =  " "+city;
    
    if(everySunday.checked)
    display_schedule.innerHTML = ` <span class="badge badge-success">Every Sunday </span>`;
    
    
    if(oneTime.checked)
        display_schedule.innerHTML = ` <span class="badge badge-success">One Time </span>`;
    
    
    if(biWeekly.checked)
        display_schedule.innerHTML = ` <span class="badge badge-success">Bi-weekly </span>`;
    
    
        if(!everySunday.checked && !biWeekly.checked && !oneTime.checked)
    display_schedule.innerHTML = ` <span class="badge badge-danger"> Please select a schedule !</span> `;

    if(adults.value == 0 && kids.value == 0 || !everySunday.checked && !biWeekly.checked && !oneTime.checked){
        pleaseVerify.innerHTML =`<p class="alert alert-danger">
                                    <i class="fa fa-warning"></i> Please verify your booking!
                                </p>`
        submit.setAttribute("style","display:none");
    }
    else{
        pleaseVerify.innerHTML = `<p class="alert alert-success">
                                    You are good to Go!
                                </p>`
        submit.setAttribute("style","display:block");
    }
};
</script>
                
        <?php include 'footer.php'; ?>
