<!doctype html>
<html lang="en">

<head>
    <?php
         include_once "../others/template/head.inc";
    ?>
    <title>CMA</title>
</head>

<body>
    <?php
        
        include "../others/template/functions.php"; 

        $fname = $lname = $dob = $email = $phoneno = $address = $pwd = $cpwd = "";

        $err_msgs = [
            'fname_err' => '',
            'lname_err' => '',
            'dob_err' => '',
            'email_err' => '',
            'phoneno_err' => '', 
            'address_err'=> '', 
            'pwd_err' => '', 
            'cpwd_err' => ''
          ];


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = sanitise($_POST["uFirstName"]);
            $lname = sanitise($_POST["uLastName"]);
            $dob = sanitise($_POST["uDob"]);
            $email = sanitise($_POST["uEmailAddress"]);
            $phoneno = sanitise($_POST["uPhoneNo"]);
            $address = sanitise($_POST["uAddress"]);
            $pwd = sanitise($_POST["uPassword"]);
            $cpwd = sanitise($_POST["uCPassword"]);

            if ($fname == "") {
                $err_msgs['fname_err'] = "Please enter your first name. "; 
            }
            
            if ($lname == "") {
                $err_msgs['fname_err'] = "Please enter your last name. "; 
            }

            if ($dob == "") {
                $err_msgs['dob_err'] = "Please enter your date of birth. "; 
            } 
            
            if ($email == "") {
                $err_msgs['email_err'] = "Please enter your email address. "; 
            }
            
            if ($phoneno == "") {
                $err_msgs['phoneno_err'] = "Please enter your phone number. "; 
            }

            if ($address == "") {
                $err_msgs['address_err'] = "Please enter your address. "; 
            }

            if ($pwd == "") {
                $err_msgs['pwd_err'] = "Please enter your password. "; 
            } 

            if ($cpwd == "") {
                $err_msgs['cpwd_err'] = "Please confirm you password. "; 
            }
            else if ($pwd != $cpwd) {
                $err_msgs['cpwd_err'] = "* Passwords do not match"; 
            }

            if (validate($err_msgs)) {
                // temporary redirect
                header("Location:dashboard.php");
                exit(); 
            }
        }

        
    ?>
    
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center text-center h-100">
        <div class="card bg-gradient-light" style="width: 35%;">
            <div style="margin: auto; width: 18rem;">
                <img src="../images/CSMS_Logo.png" class="card-img-top" alt="CMS Logo">
            </div>
            <div class="card-body">
                <h1 class="card-title">Conference Submission Management System</h1>
                <h3 class="text-muted">Registration Page</h3>
                <br>
                <!--Start User Register Form-->
                <form id="UserRegisterForm" action="register.php" method="post">
                    <div class="form-group">
                        <div class="text-start"><small class="text-danger"><?php echo $err_msgs['fname_err'] ?></small></div>
                        <input id="uFirstName" name="uFirstName" placeholder="First Name" type="text" required
                            class="form-control" value="<?php echo $fname; ?>">                        
                    </div>
                    <div class="form-group">
                        <div class="text-start"><small class="text-danger"><?php echo $err_msgs['lname_err'] ?></small></div>
                        <input id="uLastName" name="uLastName" placeholder="Last Name" type="text" required
                            class="form-control" value="<?php echo $lname; ?>">
                    </div>
                    <div class="form-group">
                        <div class="text-start"><small class="text-danger"><?php echo $err_msgs['dob_err'] ?></small></div>
                        <input id="uDob" name="uDob" placeholder="Date of Birth" type="date" required
                            class="form-control" value="<?php echo $dob; ?>">
                    </div>
                    <div class="form-group">
                        <div class="text-start"><small class="text-danger"><?php $err_msgs['email_err'] ?></small></div>
                        <input id="uEmailAddress" name="uEmailAddress" placeholder="Email" type="email" required
                            class="form-control" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <div class="text-start"><small class="text-danger"><?php echo $err_msgs['phoneno_err'] ?></small></div>
                        <input id="uPhoneNo" name="uPhoneNo" placeholder="Phone Number" type="text" required
                            class="form-control" value="<?php echo $phoneno; ?>">
                    </div>
                    <div class="form-group">
                        <div class="text-start"><small class="text-danger"><?php echo $err_msgs['address_err'] ?></small></div>
                        <input id="uAddress" name="uAddress" placeholder="Address" type="text" required
                            class="form-control" value="<?php echo $address; ?>">
                    </div>
                    <div class="form-group">
                        <div class="text-start"><small class="text-danger"><?php $err_msgs['pwd_err'] ?></small></div>
                        <input id="uPassword" name="uPassword" placeholder="Password" type="password" required
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="text-start"><small class="text-danger"><?php echo $err_msgs['cpwd_err'] ?></small></div>
                        <input id="uCPassword" name="uCPassword" placeholder="Confirm Password" type="password" required
                            class="form-control">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="uRemember" id="TermsConditions"
                            type="checkbox" required>
                        <label class="form-check-label" for="flexCheckDefault">
                            By signing up, you're agreed to our <a href="">Terms & Conditions</a>
                        </label>
                    </div>
                    <br>
                    <div class="form-group btn-group-lg d-grid gap-2">
                        <button name="register" type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
                <!--End Login Form-->
                <p class="text-muted">Already registered? <a href="../index.php">Login</a></p>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</body>

</html>