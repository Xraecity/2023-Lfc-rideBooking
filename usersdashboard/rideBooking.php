<form method="POST" action="updateRide.php" id="form">
                                    <div class="row">
                                        <div class="col-lg-12 pl-4 mt-5">
                                            <div class="card" style="border-bottom: 5px solid purple; box-shadow: 9px 2px 9px black;">
                                                <div class="card-body">
                                                    <h4 class="header-title">Information</h4>
                                                        <fieldset disabled>
                                                            <div class="form-group">
                                                                <label for="disabledTextInput">Legal Full name</label>
                                                                <input type="text" hidden id="" class="form-control" value="<?= $user['fname']; ?>" placeholder="prince Xrae">
                                                                <input type="text" hidden id="" class="form-control" value="<?= $user['lname']; ?>" placeholder="prince Xrae">
                                                                <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $user['fname']; ?> <?= $user['lname']; ?>">
                                                            </div>
                                                        </fieldset>
                                                            <div class="row">
                                                                <div class="col-lg-8">
                                                                <label for="location-input">Pickup Address <i class="ti-help-alt text-danger" style="cursor:pointer" data-toggle="popover" title="POV:" data-placement="bottom" data-content="This address,
                                                                        <?= $user['address']; ?> and city, <?= $user['city']; ?> will be use as your pick up address"></i></label> <b><a style="font-size: 10px;" id="edit" class="text-danger alert"> Edit location</a></b>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control"  id="addressHidden" disabled placeholder="<?= $user['address']; ?>">
                                                                        <input type="text" class="form-control" name="address" id="location-input" value="<?= $user['address']; ?>" placeholder="<?= $user['address']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label for="location-input" class="mt-3"></label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="addressHidden2" disabled placeholder="<?= $user['city']; ?>">
                                                                        <input type="text" class="form-control" name="city" id="locality-input" value="<?= $user['city']; ?>" placeholder="<?= $user['city']; ?>">
                                                                    </div>
                                                                </div>
                                                                
                                                                <?php if (isset($_GET['error_location'])) : ?>
                                                                    <div class="col-lg-12">
                                                                        <div class="alert alert-danger">
                                                                            <?php echo urldecode($_GET['error_location']); ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>
                                                            </div>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 pl-4 mt-5">
                                            <div class="card" style="border-top: 5px solid purple; box-shadow: 9px 9px 9px 9px black;">
                                                <div class="card-body">
                                                    <h4 class="header-title">Select number of Riders</h4>
                                                    <?php if (isset($_GET['error_message_select'])) : ?>
                                                        <div class="alert alert-danger">
                                                            <?php echo urldecode($_GET['error_message_select']); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <p class="text-muted mb-3" >We are delighted to have you join us for our upcoming church ride or pickup event. <b>Please Note: </b>
                                                    <span class="text-success"> the number of kid(s) or adult(s) selected determine the number of rider(s) from you.</span> </p>
                                                        <div class="row">
                                                            <div class="col-5 pb-3 p-4 ml-3">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="num_adult" id="kidsRadio">
                                                                    <label class="custom-control-label" for="kidsRadio">Kids</label>
                                                                </div>
                                                                <div class="form-group" id="kidsSelect">
                                                                    <select class="custom-select bg-dark text-light" id="kidSelection" name="num_kids">
                                                                        <option selected value="0">Select number of kids</option>
                                                                        <option value="0">none</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                        <option value="4">Four</option>
                                                                        <option value="5">Five</option>
                                                                        <option value="6">Six</option>
                                                                        <option value="7">Seven</option>
                                                                        <option value="8">Eight</option>
                                                                        <option value="9">Nine</option>
                                                                        <option value="10">Ten</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-5 pb-3 p-4 ml-3">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"  name="adult" id="adultRadio">
                                                                    <label class="custom-control-label" for="adultRadio">Adult</label>
                                                                </div>
                                                                <div class="form-group" id="adultSelect">
                                                                    <select class="custom-select bg-secondary text-light" id="adultSelection" name="num_adult">
                                                                        <option selected value="0">Select number of Adult</option>
                                                                        <option value="0">none</option>
                                                                        <option value="1">Myself</option>
                                                                        <option value="2">myself + 1</option>
                                                                        <option value="3">myself + 2</option>
                                                                        <option value="4">myself + 3</option>
                                                                        <option value="5">myself + 4</option>
                                                                        <option value="6">myself + 5</option>
                                                                        <option value="7">myself + 6</option>
                                                                        <option value="8">myself + 7</option>
                                                                        <option value="9">myself + 8</option>
                                                                        <option value="10">myself + 9</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-4">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" value="just me" name="num_adult" id="justMe">
                                                                    <label class="custom-control-label" for="justMe">Just me</label>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <style>
                                                #adultSelect, #kidsSelect, #location-input, #locality-input{
                                                    display: none;
                                                }
                                                a{
                                                    cursor: pointer;
                                                }
                                            </style>

                                            <script>
                                                let newLocation = document.getElementById("edit");
                                                let addressHidden = document.getElementById("addressHidden");
                                                let addressHidden2 = document.getElementById("addressHidden2");
                                                let address = document.getElementById("location-input");
                                                let city = document.getElementById("locality-input");
                                                const kidsRadio = document.getElementById("kidsRadio");
                                                const adultRadio = document.getElementById("adultRadio");
                                                const kidsSelect = document.getElementById("kidsSelect");
                                                const adultSelect = document.getElementById("adultSelect");

                                                // Add event listeners to the radio buttons
                                                kidsRadio.addEventListener("change", updateSelectVisibility);
                                                adultRadio.addEventListener("change", updateSelectVisibility);

                                                // Function to update the visibility of the select elements based on radio button selection
                                                function updateSelectVisibility() {
                                                    if (kidsRadio.checked && adultRadio.checked) {
                                                        kidsSelect.style.display = "block";
                                                        adultSelect.style.display = "block";
                                                    } else if (kidsRadio.checked) {
                                                        kidsSelect.style.display = "block";
                                                        adultSelect.style.display = "none";
                                                    } else if (adultRadio.checked) {
                                                        kidsSelect.style.display = "none";
                                                        adultSelect.style.display = "block";
                                                    } else {
                                                        kidsSelect.style.display = "none";
                                                        adultSelect.style.display = "none";
                                                    }
                                                }
                                                newLocation.addEventListener("click", addNewLocation);

                                                function addNewLocation(){
                                                    address.style.display = "block";
                                                    city.style.display = "block";
                                                    addressHidden.style.display = "none";
                                                    addressHidden2.style.display = "none";
                                                    address.focus();
                                                }
                                            </script>


                                        <div class="col-lg-6 pl-4 mt-5">
                                            <div class="card" style="border-bottom: 5px solid purple; box-shadow: 9px 2px 9px black;">
                                                <div class="card-body">
                                                    <h4 class="header-title">Schedule your booking</h4>
                                                    
                                                    <?php if (isset($_GET['error_message_schedule'])) : ?>
                                                        <div class="alert alert-danger">
                                                            <?php echo urldecode($_GET['error_message_schedule']); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="radio" class="custom-control-input" value="Every Sunday" name="schedule" id="customCheck3">
                                                                    <label class="custom-control-label" for="customCheck3">Every sunday</label>
                                                                </div>
                                                                <i style="cursor: pointer" class="ti-help-alt text-danger" data-toggle="popover" title="POV:" data-placement="bottom" data-content="Selecting this you confirm your ride for every sunday until you terminate your schedule"> <small>Break-down</small> </i>

                                                            </div>
                                                            
                                                            <div class="col-4">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="radio" class="custom-control-input" value="one-time" name="schedule" id="customCheck4">
                                                                    <label class="custom-control-label" for="customCheck4">  one time </label>
                                                                </div>
                                                                <i style="cursor: pointer" class="ti-help-alt text-danger" data-toggle="popover" title="POV:" data-placement="bottom" data-content="By selecting this you confirm your booking for just this sunday <?= $nextSundayFormatted; ?>"> <small>Break-down</small> </i>
                                                            </div>

                                                            
                                                            <div class="col-4">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="radio" class="custom-control-input" value="Bi-weekly" name="schedule" id="customCheck5">
                                                                    <label class="custom-control-label" for="customCheck5">Bi-weekly</label>
                                                                </div>
                                                                <i style="cursor: pointer" class="ti-help-alt text-danger" data-toggle="popover" title="POV:" data-placement="bottom" data-content="By selecting this you confirm your booking for bi-weekly (2weeks from <?= $nextSundayFormatted; ?> and next on <?= $secondSundayFormatted; ?>...) "> <small>Break-down</small> </i>
                                                            </div>
                                                        </div>
                                                            <hr style="margin: 20px; background: purple; height: 1px; border-radius: 100%;">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <button type="button" class="btn btn-secondary user-profile" onclick="display()" id="next" data-toggle="modal" data-target="#exampleModalCenter">Next <i class="ti-arrow-right"></i></button>

                                                                </div>
                                                                <div class="col-6">
                                                                    <button type="reset" class="btn btn-danger mt-4 pr-4 pl-4">Start over</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                        <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Preview</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body bg-dark">
                                                    <div id="pleaseVerify"></div>
                                                    <div class="col-lg-12">
                                                    <div class="card" style="border-top: 2px solid purple; box-shadow: 5px 5px 5px 5px white">
                                                        <div class="card-body">
                                                            <h6 class="header-title text-center">Pickup Location</h6>
                                                                <p class="mt-3"><b>Address:</b><span id="address-display"></span>  </p>
                                                                <p class="mt-3"><b>City:</b><span id="city-display"></span> </p>
                                                                <p class="mt-3"><b>Contact number: <?= $user['phone'] ?></b> </p>
                                                        </div>
                                                    </div>
                                                    <div class="card pt-4" style="border-top: 2px solid purple; box-shadow: 5px 5px 5px 5px white">
                                                        <div class="card-body">
                                                            <h6 class="header-title text-center">Riders</h6>
                                                            <i>You can select either kids or adult or both, least one is required</i>
                                                                <p class="mt-3"><b>Number of Kid(s):</b><span id="kids-display"></span> </p>
                                                                <p class="mt-3"><b>Number of Adult(s):</b><span id="adults-display"></span>  </p>
                                                        </div>
                                                    </div>
                                                    <div class="card pt-4" style="border-top: 2px solid purple; box-shadow: 5px 5px 5px 5px white">
                                                        <div class="card-body">
                                                            <h6 class="header-title text-center">Schedule</h6>
                                                                <p class="mt-3"><b>Ride Frequency:</b><span id="schedule-display"></span> </p>
                                                        </div>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary mt-4 pr-4 pl-4" data-dismiss="modal">Close</button>
                                                    <button type="submit" id="submit" class="btn btn-secondary user-profile mt-4 pr-4 pl-4">Book Ride</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        
                
                    