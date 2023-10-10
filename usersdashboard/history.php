<?php
include 'session.php';
include 'fetchDB.php';

// Fetch ridebooking data from the database
try {
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session

    $query = "SELECT rb.*
    FROM ridebooking rb
    INNER JOIN users_registration ur ON rb.user_id = ur.id
    WHERE rb.user_id = ?
    ORDER BY rb.created_at DESC"; // Specify 'rb' before 'created_at' to indicate the 'created_at' column from 'ridebooking' table

    
    $stmt = $db->prepare($query);
    $stmt->execute([$user_id]);
    $ridebookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
  
  

  <!-- cancel ride  -->
  <?php

            include 'fetchDB.php'; // Include your database connection file

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Check if the form was submitted via POST

                // Get the values from the form
                $cancel_ride = $_POST['cancel_ride'];
                $bookingId = $_POST['booking_id'];

                // Prepare an SQL UPDATE query
                $updateQuery = "UPDATE ridebooking SET schedule = :cancel_ride WHERE id = :id";

                try {
                    // Prepare the SQL statement
                    $stmt = $db->prepare($updateQuery);

                    // Bind parameters
                    $stmt->bindParam(':cancel_ride', $cancel_ride, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $bookingId, PDO::PARAM_INT);

                    // Execute the update query
                    $stmt->execute();
                    $cancelUpdate = 'cancelled successfully!.';
                    // Redirect back to the previous page or wherever you need to go
                    header("location: history.php?cancelled=" . urlencode($cancelUpdate));

                } catch (PDOException $e) {
                    // Handle any database errors here
                    echo "Error: " . $e->getMessage();
                }
            }

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>My Ride History</title>
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
                            <h4 class="page-title pull-left">My Ride History</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="./">Dashboad</a></li>
                                <li><span>History</span></li>
                            </ul>
                        </div>
                    </div>
                    <?php include 'subMenu.php'; ?>
                </div>
            </div>
                    <!-- Dark table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">My Booking History</h4>
                                <?php if (isset($_GET['successUpdate'])) : ?>
                                        <div class="alert alert-success">
                                            <?php echo urldecode($_GET['successUpdate']); ?>
                                        </div>
                                <?php endif; ?>
                                
                                <!-- cancelled  -->
                                <?php if (isset($_GET['cancelUpdate'])) : ?>
                                        <div class="alert alert-warning">
                                            <?php echo urldecode($_GET['cancelUpdate']); ?>
                                        </div>
                                <?php endif; ?>


                                <div class="data-tables datatable-dark">
                                <?php if (isset($_GET['success'])) : ?>
                                    <div class="alert alert-success">
                                        <?php echo urldecode($_GET['success']); ?>
                                    </div>
                                <?php endif; ?>
                                    <table id="dataTable3" class="text-center">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>REF ID</th>
                                                <th>Pickup Address <i class="fa fa-map-pin"></i></th>
                                                <th>Adult | Kid <i class="fa fa-users"></i></th>
                                                <th>Schedule <i class="fa fa-calendar-check-o"></i></th>
                                                <th>Created <i class="fa fa-clock-o"></i></th>
                                                <th>Delete</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($ridebookings as $booking) : ?>
                                            <tr>
                                                <td>#<?= $booking['uniqueID'] ?></td>
                                                <td><?= $booking['address'] ?>, <?= $booking['city'] ?></td>
                                                <td><?= $booking['num_adult'] ?> Adult(s) | <?= $booking['num_kids'] ?> Kid(s)</td>
                                                <td>
                                                    
                                                        <span class="badge badge-<?php if ($booking['schedule'] == "cancelled"):?>warning<?php else:?>success<?php endif;?>"><?= $booking['schedule'] ?></span>
                                                        
                                                </td>
                                                <td><?php $timestamp = strtotime($booking['created_at']);
                                                // Convert the database timestamp to a Unix timestamp
                                                $formatted_date = date('D jS M, Y, g:ia', $timestamp);
                                                echo $formatted_date; ?></td>
                                                
                                                <?php
                                                $todays = date('l jS'); // Get the current date and format as "Day Date"

                                                // Calculate the date 7 days from the date created on DB
                                                $OneTimeAvaliability = date('l jS', strtotime($booking['created_at']));
                                                $BiWeeklyAvaliability = date('l jS', strtotime($booking['created_at'] )); 
                                                $EverySundayAvaliability = date('l jS', strtotime($booking['created_at'])); 
                                                ?>
                                                <!-- edit Biweekly -->
                                                
                                                <td>
                                                    <?php if ($booking['schedule'] == "Bi-weekly" && $BiWeeklyAvaliability == $todays): ?>
                                                            <button class="badge badge-primary p-2" style="border: none" data-toggle="modal" data-target="#edit<?= $booking['id']; ?>">Edit pickup</button>
                                                            <button class="badge badge-warning text-light p-2" style="border: none" data-toggle="modal" data-target="#cancel<?= $booking['id']; ?>">Cancel Ride</button>
                                                    
                                                        <?php elseif ($booking['schedule'] == "one-time" && $OneTimeAvaliability == $todays): ?>
                                                            <button class="badge badge-primary p-2" style="border: none" data-toggle="modal" data-target="#edit<?= $booking['id']; ?>">Edit pickup</button>
                                                            <button class="badge badge-warning text-light p-2" style="border: none" data-toggle="modal" data-target="#cancel<?= $booking['id']; ?>">Cancel Ride</button>
                                                    
                                                        <?php elseif ($booking['schedule'] == "Every Sunday" && $EverySundayAvaliability == $todays): ?>
                                                            <button class="badge badge-primary p-2" style="border: none" data-toggle="modal" data-target="#edit<?= $booking['id']; ?>">Edit Pickup</button>
                                                            <button class="badge badge-warning text-light p-2" style="border: none" data-toggle="modal" data-target="#cancel<?= $booking['id']; ?>">Cancel Ride</button>
                                                    <?php else: ?>
                                                        <?php if ($booking['schedule'] == "cancelled"):?>
                                                            <button class="badge badge-warning p-2" disabled style="border: none">cancelled</button>
                                                            <?php else: ?>
                                                                <button class="badge badge-danger p-2" disabled style="border: none">unavaliable</button>
                                                            <?php endif; ?>
                                                    <?php endif; ?>
                                                <td>
                                                    <b class="text text-warning">pending</b>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <span class="p-4 m-3 float-right"><a href="calendar.php"> View calendar <i class="fa fa-calendar"></i></a></span>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Dark table end -->
                </div>
            </div>
        </div>
    </div>

  

                  <!-- Button trigger modal -->
                                <!-- <button type="button" class="btn btn-primary btn-flat btn-lg mt-3" data-toggle="modal" data-target="#editEverySun">Launch demo modal</button> -->
                                <!-- Modal -->
                                <?php foreach ($ridebookings as $booking) : ?>
                                    <? include 'editaddress.php'; ?>

                                <!-- cancel  -->
                                <form method="post">
                                        <div class="modal fade" id="cancel<?= $booking['id']; ?>">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">Cancel Ride</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="alert alert-success">Are you sure you want to cancel this ride Ref ID: <strong>#<?= $booking['uniqueID']; ?></strong> </p>
                                                </div>
                                                <input type="text" hidden name="cancel_ride" value="cancelled">
                                                <input type="text" hidden name="booking_id" value="<?= $booking['id']; ?>">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Yes, cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                    <?php endforeach; ?>
                                
      

                                
        <!-- main content area end -->
        <!-- footer area start-->
        <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

                        
    