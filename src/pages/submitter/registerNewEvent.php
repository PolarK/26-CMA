<?php
// include "../others/template/functions.php";
include_once("./src/template/notification.php");

$fname = $lname = $affiliation = $email = $date = $time = "";
?>

<div id="content" class="container-fluid p-5">

    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center text-center h-100">
        <div class="card-body">
            <h1 class="display-4">Register to Your New Event!</h1>
            <p class="lead">Congrats on the offer, we were very happy with your submission and would like to hear about it more! So please, register here to talk about your finding to us. We cant wait to hear it from you!</p>
            <br>
            <!--Start Event Register Form-->
            <form id="EventRegisterForm" action="registerAppointment.php" method="post">

                <div class="form-group mb-2 mr-2">
                    <div class="row">
                        <!-- First name and last name -->
                        <div class="col">
                            <div class="form-group">
                                <div class="text-start"><small class="text-danger">
                                        <?php echo (isset($event)) ? $event->err['fname'] : ' ' ?>
                                    </small></div>
                                <input id="uFirstName" name="uFirstName" placeholder="First Name" type="text" required class="form-control" value="<?php echo $fname; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <div class="text-start"><small class="text-danger">
                                        <?php echo (isset($event)) ? $event->err['lname'] : ' ' ?>
                                    </small></div>
                                <input id="uLastName" name="uLastName" placeholder="Last Name" type="text" min="09:00" max="17:00" required class="form-control" value="<?php echo $lname; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Affiliation -->
                        <div class="col">
                            <div class="form-group">
                                <div class="text-start"><small class="text-danger">
                                        <?php echo (isset($event)) ? $event->err['affiliation'] : ' ' ?>
                                    </small></div>
                                <input id="uAffiliation" name="uAffiliation" placeholder="Department" type="text" required class="form-control" value="<?php echo $affiliation; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <!-- Email Address -->
                            <div class="form-group">
                                <div class="text-start"><small class="text-danger">
                                        <?php echo (isset($event)) ? $event->err['email'] : ' ' ?>
                                    </small></div>
                                <input id="uEmailAddress" name="uEmailAddress" placeholder="Email" type="email" required class="form-control" value="<?php echo $email; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <!-- Date of Appointment -->
                            <div class="form-group">
                                <div class="text-start"><small class="text-danger">
                                        <?php echo (isset($event)) ? $event->err['date'] : ' ' ?>
                                    </small></div>
                                <input id="aDate" name="aDate" placeholder="Date of Appointment" type="date" required class="form-control" min="<?php echo $cDate; ?>" value="<?php echo $aDate; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <!-- Time of Appointment -->
                            <div class="form-group">
                                <div class="text-start"><small class="text-danger">
                                        <?php echo (isset($event)) ? $event->err['time'] : ' ' ?>
                                    </small></div>
                                <input id="aTime" name="aTime" placeholder="Time" type="time" required class="form-control" value="<?php echo $aTime; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <div class="col">
                            <input class="form-check-input" type="checkbox" name="submitCheck" id="submitCheck" type="checkbox" required>
                            <label class="form-check-label" for="submitCheck">
                                I have or will submit a document for review before my time of appointment
                            </label>
                        </div>
                        <div class="col">
                            <input class="form-check-input" type="checkbox" name="uRemember" id="TermsConditions" type="checkbox" required>
                            <label class="form-check-label" for="TermsConditions">
                                By registering, you are agreeinh to our <a href="">Terms & Conditions</a>
                            </label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group btn-group-lg d-grid gap-2">
                    <button name="register" type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            <!--End Register Appointment Form-->
        </div>
    </div>

</div>