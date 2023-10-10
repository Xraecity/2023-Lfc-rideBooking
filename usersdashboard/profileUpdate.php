<?php

require_once 'fetchDB.php'; // Include your database connection file


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['city'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];

        // Validate the new data (add more validation if necessary)
        if (!empty($fname) && !empty($lname) && !empty($email) && !empty($phone) && !empty($address) && !empty($city)) {
            try {
                // Update the user's information in the database
                $stmt = $db->prepare("UPDATE users_registration SET fname = ?, lname = ?, email = ?, phone = ?, address = ?, city = ? WHERE email = ?");
                $stmt->execute([$fname, $lname, $email, $phone, $address, $city, $_SESSION['email']]);

                // Update the session data
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $phone;
                $_SESSION['address'] = $address;
                $_SESSION['city'] = $city;

                // Redirect to the profile page or any other desired page
                echo  '<div class="alert alert-success">information Updated, to view changes please <a onclick="refreshPage()" class="text-danger" style="cursor: pointer"> click here</a> </div>';
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        
        else {
            $error_message = "All fields must be filled.";
            echo "<p>redirected</p>";
        }
    }
}
?>
<script>
        function refreshPage() {
            location.reload(); // Reload the current page
        }
    </script>
<form class="needs-validation" novalidate="" autocomplete = "off" method="POST">
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="fname">First name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user-md"></i> </span>
                </div>
                <input type="text" class="form-control" name="fname" id="fname" placeholder="<?= $user['fname']; ?>" value="<?= $user['fname']; ?>" required="">
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please choose a first name.
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="lname">Last name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user-md"></i> </span>
                </div>
                <input type="text" class="form-control" name="lname" id="lname" placeholder="<?= $user['lname']; ?>" value="<?= $user['lname']; ?>" required="">
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please choose a last name.
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="email">email</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                </div>
                <input disabled class="form-control"  id="validationCustomfname" placeholder="<?= $user['email']; ?>" aria-describedby="inputGroupPrepend" >
                <input class="form-control" hidden name="email"  id="email"  value="<?= $user['email']; ?>" aria-describedby="inputGroupPrepend" >
                <div class="invalid-feedback">
                    Please choose a fname.
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="phone">Phone</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-mobile-phone"></i></span>
                </div>
                <input type="tel" class="form-control" name="phone"  id="phone" value="<?= $user['phone']; ?>" placeholder="<?= $user['phone']; ?>" required="">
                <div class="invalid-feedback">
                    Please provide a phone number.
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="location-input">Address</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="ti-map-alt"></i> </span>
                </div>
                <input type="text" class="form-control" name="address" id="location-input" value="<?= $user['address']; ?>" placeholder="<?= $user['address']; ?>" required="">
                <div class="invalid-feedback">
                    Please provide a valid address.
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="locality-input">City</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="ti-map-alt"></i> </span>
                </div>
                <input type="text" class="form-control" name="city"  id="locality-input" value="<?= $user['city']; ?>" placeholder="<?= $user['city']; ?>" required="">
                <div class="invalid-feedback">
                    Please provide a valid address.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary user-profile" onclick="display()" id="next" data-toggle="modal" data-target="#exampleModalCenter">Next <i class="ti-arrow-right"></i></button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Changes</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body bg-dark">
                                <p class="text-light">
                                    Please confirm the following changes
                                </p>
                                <div class="col-lg-12">
                                <div class="card" style="border-top: 2px solid purple; box-shadow: 5px 5px 5px 5px white">
                                    <div class="card-body">
                                        <h6 class="header-title text-center">My Profile Information</h6>
                                            <p class="mt-3"><b>First Name:</b> <?= $user['fname']; ?> <code>to</code> <b><span id="fname-display"></span></b> </p>
                                            <p class="mt-3"><b>Last Name:</b> <?= $user['lname']; ?> <code>to</code> <b> <span id="lname-display"></span></b> </p>
                                            <p class="mt-3"><b>Phone:</b> <?= $user['phone']; ?> <code>to</code> <b> <span id="phone-display"></span> </b></p>
                                            <p class="mt-3"><b>Address:</b> <?= $user['address']; ?><br> <code>to</code> <b> <span id="address-display"></span> </b></p>
                                            <p class="mt-3"><b>City:</b> <?= $user['city']; ?> <code>to</code> <b> <span id="city-display"></span> </b></p>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-secondary user-profile" type="submit">Submit form</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
                    
</form>

<script>


    let next = document.getElementById("next");

    function display() {
        let fname = document.getElementById("fname").value;
        let lname = document.getElementById("lname").value;
        let phone = document.getElementById("phone").value;
        let address = document.getElementById("location-input").value;
        let city = document.getElementById("locality-input").value;

        
        let display_fname = document.getElementById("fname-display");
        let display_lname = document.getElementById("lname-display");
        let display_phone = document.getElementById("phone-display");
        let display_address = document.getElementById("address-display");
        let display_city = document.getElementById("city-display");

        display_fname.innerHTML = " " + fname;
        display_lname.innerHTML = " " + lname;
        display_phone.innerHTML = " " + phone;
        display_address.innerHTML = " " + address;
        display_city.innerHTML = " " + city;
    };

</script>