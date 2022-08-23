<?php

// include "../others/template/functions.php";

$fname = $lname = $email = $phoneno = $aDate = $aTime = "";

$err_msgs = [
    'fname_err' => '',
    'lname_err' => '',
    'email_err' => '',
    'phoneno_err' => '',
    'date_err' => '',
    'time_err' => '',
];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = sanitise($_POST["uFirstName"]);
    $lname = sanitise($_POST["uLastName"]);
    $email = sanitise($_POST["uEmailAddress"]);
    $phoneno = sanitise($_POST["uPhoneNo"]);
    $aDate = sanitise($_POST["date"]);
    $aTime = sanitise($_POST["time"]);

    if ($fname == "") {
        $err_msgs['fname_err'] = "Please enter your first name. ";
    }

    if ($lname == "") {
        $err_msgs['fname_err'] = "Please enter your last name. ";
    }

    if ($email == "") {
        $err_msgs['email_err'] = "Please enter your email address. ";
    }

    if ($phoneno == "") {
        $err_msgs['phoneno_err'] = "Please enter your phone number. ";
    }

    if ($aDate == "") {
        $err_msgs['date_err'] = "Please enter a valid date. ";
    }

    if ($aTime == "") {
        $err_msgs['time_err'] = "Please enter a valid time. ";
    }


    if (validate($err_msgs)) {
        // temporary redirect
        header("Location:dashboard.php");
        exit();
    }
}


?>

<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center text-center h-100">
    <div style="margin: auto; width: 18rem;">
        <img src="src\images\CSMS_Logo.png" class="card-img-top" alt="CMS Logo">
    </div>
    <div class="card-body">
        <h1 class="card-title">Conference Submission Management System</h1>
        <h3 class="text-muted">Register for an Appointment</h3>
        <br>
        <!--Start Event Register Form-->
        <form id="UserRegisterForm" action="registerAppointment.php" method="post">

            <div class="form-group mb-2 mr-2">
                <div class="row">
                <!-- First name and last name -->
                    <div class="col">
                        <div class="form-group">
                            <div class="text-start"><small class="text-danger">
                                    <?php echo $err_msgs['fname_err'] ?>
                                </small></div>
                            <input id="uFirstName" name="uFirstName" placeholder="First Name" type="text" required class="form-control" value="<?php echo $fname; ?>">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="text-start"><small class="text-danger">
                                    <?php echo $err_msgs['lname_err'] ?>
                                </small></div>
                            <input id="uLastName" name="uLastName" placeholder="Last Name" type="text" min="09:00" max="17:00" required class="form-control" value="<?php echo $lname; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Phone Number -->
                    <div class="col">
                        <div class="form-group">
                            <div class="text-start"><small class="text-danger">
                                    <?php echo $err_msgs['phoneno_err'] ?>
                                </small></div>
                            <input id="uPhoneNo" name="uPhoneNo" placeholder="Phone Number" type="text" required class="form-control" value="<?php echo $phoneno; ?>">
                        </div>
                    </div>
                    <div class="col">
                        <!-- Email Address -->
                        <div class="form-group">
                            <div class="text-start"><small class="text-danger">
                                    <?php $err_msgs['email_err'] ?>
                                </small></div>
                            <input id="uEmailAddress" name="uEmailAddress" placeholder="Email" type="email" required class="form-control" value="<?php echo $email; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Date of Appointment -->
                    <div class="col">
                        <div class="form-group">
                            <div class="text-start"><small class="text-danger">
                                    <?php echo $err_msgs['date_err'] ?>
                                </small></div>
                            <input id="aDate" name="aDate" placeholder="Date of Appointment" type="date" required class="form-control" value="<?php echo $aDate; ?>">
                        </div>
                    </div>
                    <div class="col">
                        <!-- Time of Appointment -->
                        <div class="form-group">
                            <div class="text-start"><small class="text-danger">
                                    <?php $err_msgs['time_err'] ?>
                                </small></div>
                            <input id="aTime" name="aTime" placeholder="Time" type="time" required class="form-control" value="<?php echo $aTime; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="submitCheck" id="submitCheck" type="checkbox" required>
                    <label class="form-check-label" for="flexCheckDefault">
                        I have or will submit a document for review before my time of appointment
                    </label>
                    <input class="form-check-input" type="checkbox" name="uRemember" id="TermsConditions" type="checkbox" required>
                    <label class="form-check-label" for="flexCheckDefault">
                        By registering, you've agreed to our <a href="">Terms & Conditions</a>
                    </label>
                </div>
            </div>
            <br>
            <div class="form-group btn-group-lg d-grid gap-2">
                <button name="register" type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
        <!--End Login Form-->
    </div>
</div>