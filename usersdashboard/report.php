<?php
include 'session.php';
// Display the dashboard content for logged-in users
include 'fetchDB.php';

    

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $situation = $_POST['situation'];
    $unique_id = $_POST['unique_id'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Server-side validation
    if (empty($situation) || empty($subject)|| empty($unique_id) || empty($message)) {
        $empty = "Please fill in all the required fields.";
    } else {
        // Insert data into the database (you need to create the table and connection)
        $query = "INSERT INTO report (situation, subject, unique_id, message) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$situation, $subject, $unique_id, $message]);

        if ($stmt) {
            $successful = "Message Sent sucessfully";
            header("refresh:5;url=report.php");
        } else {
            $error = "Error inserting data into the database.";
        }
    }
}
?>
<!Doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Create a Ticket</title>
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
                                    <h4 class="page-title pull-left">Create a Ticket</h4>
                                    <ul class="breadcrumbs pull-left">
                                        <li><a href="./">Dashboad</a></li>
                                        <li><span>Ticket</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 clearfix">
                                <div class="user-profile pull-right">
                                    <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                                    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">PRINCE XRAE <i class="fa fa-angle-down"></i></h4>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Message</a>
                                        <a class="dropdown-item" href="profile.php">Profile</a>
                                        <a class="dropdown-item" href="#">Log Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <form class="needs-validation" novalidate="" method="POST">
                    <div class="row">
                        <div class="col-lg-4 mt-5">
                            <div class="card" style="border-bottom: 5px solid purple; box-shadow: 9px 2px 9px black;">
                                <div class="card-body">
                                    <h4 class="header-title">Information</h4>
                                        <fieldset disabled>
                                            <div class="form-group">
                                                <label for="disabledTextInput">Legal Full name</label>
                                                <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $user['fname']; ?> <?= $user['lname']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledTextInput">Address</label>
                                                <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $user['address'] . ", " .$user['city']; ?>">
                                            </div>
                                        </fieldset>
                                    </div>
                            </div>
                        </div>
                        <?php 
                            include 'fetchDB.php';
                             try {
                                $stmt = $db->prepare("SELECT * FROM report WHERE unique_id = ?");
                                $stmt->execute([$_SESSION['user_id']]);
                                $reportSheet = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                                // Count the number of bookings
                                $reportingCount = count($reportSheet);
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }

                                ?>

                        <?php if($reportingCount > 0): ?>
                            <div class="col-lg-4 mt-5">
                                <?php else: ?>
                                    <div class="col-lg-8 mt-5">
                                    <?php endif; ?>
                            <div class="card" style="border-top: 5px solid purple; box-shadow: 9px 9px 9px 9px black;">
                                <div class="card-body">
                                    <?php if(isset($successful)):?>  
                                        <div class="alert alert-success"><?= $successful; ?></div>
                                    <?php endif; ?>
                                    <?php if(isset($error)):?>  
                                        <div class="alert alert-danger"><?= $error; ?></div>
                                    <?php endif; ?>
                                    <?php if(isset($empty)):?>  
                                        <div class="alert alert-danger"><?= $empty; ?></div>
                                    <?php endif; ?>
                                    <h4 class="header-title">Report | Complaint | Message | Review</h4>
                                    <p class="text-muted mb-3">Create a ticket for report or complain or write a message to the administrative. You can as well write a review </p>
                                
                                        <div class="row">
                                            
                                            <div class="col-lg-12">
                                            <select name="situation" required id="situation" class="col-form-label col-lg-12 aling-center text-center bg-dark user-profile text-light" onchange="toggleReferralInput()" style="cursor: pointer">
                                                <option value="" disabled selected>-- Select Option --</option>
                                                <option value="Report">I want to <b>Report</b></option>
                                                <option value="Complaint">I have a <b>Complaint</b></option>
                                                <option value="Admin">A message to <b>Admin</b></option>
                                                <option value="Review">I want to write a <b>Review</b></option>
                                            </select>
                                            </div>
                                            </div>
                                                
                                            <div class="col-lg-12 mt-4">
                                                <div class="form-group">
                                                    <input type="text" id="validationCustomUsername" name="subject" class="form-control" placeholder="Subject" required>
                                                </div>
                                                <small class="invalid-feedback">
                                                    Please enter a subject
                                                </small>
                                            </div>
                                                
                                            <div class="col-lg-12 mt-4">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Message</span>
                                                    </div>
                                                    <textarea class="form-control" name="message" aria-label="With textarea" required placeholder="..."></textarea>
                                                </div>
                                                <code id="wordCountDisplay" >300 words left</code>
                                            </div>
                                            <hr style="margin: 20px; background: purple; height: 1px; border-radius: 100%;">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <button type="submit" class="btn btn-secondary user-profile mt-4 pr-4 pl-4">Report</button>
                                                        </div>
                                                        <div class="col-4">
                                                            <button type="reset" class="btn btn-danger mt-4 pr-4 pl-4">Start over</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="unique_id" value="<?= $user['id']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>

                                
                            
                                
                        <?php if($reportingCount > 0): ?>
                            <div class="col-lg-4">
                                <?php else: ?>
                                    <div class="col-lg-0">
                                    <?php endif; ?>
                        
                        <?php if($reportingCount > 0): ?>
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-md-12 mx-auto">
                                        <div class="chat-container">
                                            <h5 class="text-center mt-3">My Ticket History</h5>
                                <?php foreach ($reportSheet as $report) : ?>
                                                <div class="col-lg-12 mb-4 mt-4">
                                                    <span class="alert alert-info text-right">A ticket created for <b><?= $report['situation']; ?></b></span>
                                                </div>
                                            <div class="chat-message user-message p-3 m-2">
                                                <strong>- <?= $report['subject'];?></strong>
                                                <br>
                                                <?= $report['message']; ?>
                                                <br>
                                                <span class="badge" style="color: lightgrey; font-size: 8px">
                                                    <?php 
                                                        date_default_timezone_set("America/Winnipeg");
                                                        $timestamp = strtotime($report['created_at']);
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
                                            
                                            <div class="chat-message admin-message p-3 m-2">
                                                <strong>Admin:</strong> Hi there! Hello!Hello!Hello!Hello! Hello!Hello!Hello! Hello!Hello!Hello!Hello! Hello!Hello!Hello!
                                                <br>
                                                <span class="badge badge-secondary">-1min ago</span>
                                            </div>

                                            <?php endforeach; ?>
                                            <!-- Add more chat messages dynamically -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                                <style>
                                    /* Add your custom CSS styles here */
                                    .chat-container {
                                        border: 1px solid #ccc;
                                        border-radius: 5px;
                                        height: 400px;
                                        overflow-y: scroll;
                                    }

                                    .chat-message {
                                        padding: 10px;
                                        margin: 5px;
                                        border-radius: 0px 30px 0px 30px;
                                    }

                                    .user-message {
                                        background-color: #8914fe;
                                        text-align: right;
                                        color: white;
                                    }

                                    .admin-message {
                                        background-color: #EAEAEA;
                                        text-align: left;
                                    }
                                </style>

    <!-- Add your jQuery and JavaScript code for sending and receiving messages here -->
   

                            </div>
                    </div>
            </div>
            </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
       
    </script>
</body>
</html>

                            </div>
                        </form>
                    </div>
            </div>
            </div>
            </div>
            <script>
    // JavaScript validation
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('form').addEventListener('submit', function (e) {
            let situation = document.getElementById('situation').value;
            let subject = document.getElementById('validationCustomUsername').value;
            let message = document.querySelector('textarea').value;

            if (!situation || !subject || !message) {
                alert('Please fill in all the required fields.');
                e.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        const textarea = document.querySelector('textarea');
        const wordCountDisplay = document.getElementById('wordCountDisplay');
        const maxWords = 300;

        // Function to update word count and display
        function updateWordCount() {
            const words = textarea.value.trim().split(/\s+/).filter(Boolean);
            const wordCount = words.length;

            if (wordCount <= maxWords) {
                wordCountDisplay.textContent = `${maxWords - wordCount} words left`;
                textarea.removeAttribute('readonly'); // Remove readonly attribute
                if (maxWords - wordCount < 300) {
                    wordCountDisplay.style.color = 'red';
                } else {
                    wordCountDisplay.style.color = 'green'; // Reset to black if not less than 300
                }
            } else {
                textarea.value = words.slice(0, maxWords).join(' ');
                wordCountDisplay.textContent = 'Maximum word limit reached';
                textarea.setAttribute('readonly', 'readonly'); // Set readonly attribute
            }
        }

        // Initial word count update
        updateWordCount();

        // Event listener for input in the textarea
        textarea.addEventListener('input', updateWordCount);

        // Allow users to delete characters even if the limit is reached
        textarea.addEventListener('keydown', function (event) {
            if (event.keyCode === 8 && textarea.value.length >= maxWords) {
                textarea.removeAttribute('readonly'); // Remove readonly attribute when backspace key is pressed
            }
        });
    });
</script>

            <footer>
            <div class="footer-area">
                <p>© Copyright 2018 by <a href="https://xraecity.com/wp/">xraecity</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
            </div>
        </div>
</body>
    <!-- offset area end -->
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
