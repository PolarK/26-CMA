<?php
require_once "./classes/dbAPI.class.php";
require_once "./classes/user.class.php";
require_once "./classes/validator.class.php";
require_once "./classes/idGenerator.class.php";
require_once "./classes/components/toast.php";

$db = new Database();

$fname = $lname = $dob = $email = $phoneno = $pwd = $cpwd = "";

if (isset($_POST['register'])) {
    //! Role will be changed once the basic registration is completed.
    $role = "SUBMITTER";
    $fname = Validator::sanitise($_POST["uFirstName"]);
    $lname = Validator::sanitise($_POST["uLastName"]);
    $dob = Validator::sanitise($_POST["uDob"]);
    $email = Validator::sanitise($_POST["uEmailAddress"]);
    $phoneno = Validator::sanitise($_POST["uPhoneNo"]);
    $pwd = Validator::sanitise($_POST["uPassword"]);
    $cpwd = Validator::sanitise($_POST["uCPassword"]);

    $user = new User($fname, $lname, $dob, $email, $phoneno, $pwd, $cpwd, array());
    $user->validateUserRegister();
    $errs = $user->get_err(); 

    if (Validator::validate($errs)) {
        $id = IDGenerator::user($role, $fname, $lname);

        $hashedPwd = $user->generatePassword($id, $pwd);

        if (isset($hashedPwd['salt']) && isset($hashedPwd['hash'])) {
            $db->createNewUser(
                $id,
                $fname,
                $lname,
                $dob,
                strtolower($email),
                $phoneno,
                $role,
                '1',
            );

            $db->createPassword(
                $id,
                $hashedPwd['salt'],
                $hashedPwd['hash']
            );
        }
        $_SESSION['valid'] = true;
        $_SESSION['UID'] = $id;
        $_SESSION['uRole'] = $role;
        $_SESSION['uFName'] = $fname;
        $_SESSION['uLName'] = $lname;
        $_SESSION['uDob'] = $dob;
        $_SESSION['uEmail'] = $email;
        $_SESSION['uPhone'] = $phoneno;
        $_SESSION['uActive'] = $isActive;


        header('Location: /dashboard');
    }
    else {
        Validator::displayErrorToasts($errs); 
    }
}

?>

<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center text-center h-100 mb-5">
    <div style="margin: auto; width: 18rem;">
        <img src="src\images\CSMS_Logo.png" class="card-img-top" alt="CMS Logo">
    </div>
    <div class="card-body">
        <h1 class="card-title">Conference Submission Management System</h1>
        <h3 class="text-muted">Registration Page</h3>
        <br>

        <!--Start User Register Form-->
        <?php if (!Mobile::isActive()) { ?>
            <form id="UserRegisterForm" action="/register" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-2 mr-2">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input id="uFirstName" name="uFirstName" placeholder="First Name" type="text" required class="form-control" value="<?php echo $fname; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input id="uLastName" name="uLastName" placeholder="Last Name" type="text" required class="form-control" value="<?php echo $lname; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input id="uDob" name="uDob" placeholder="Date of Birth" type="text" required class="form-control" onfocus="(this.type='date')" value="<?php echo $dob; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input id="uEmailAddress" name="uEmailAddress" placeholder="Email" type="email" required class="form-control" value="<?php echo $email; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input id="uPhoneNo" name="uPhoneNo" placeholder="Phone Number" type="text" required class="form-control" value="<?php echo $phoneno; ?>">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input id="uPassword" name="uPassword" placeholder="Password" type="password" required class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input id="uCPassword" name="uCPassword" placeholder="Confirm Password" type="password" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="uAgreedTC" id="TermsConditions" type="checkbox" required>
                        <label class="form-check-label" for="TermsConditions">
                            By signing up, you've agreed to our <a href="/terms&conditions">Terms & Conditions</a>
                        </label>
                    </div>
                </div>
                <br>
                <div class="form-group btn-group-lg d-grid gap-2">
                    <button name="register" type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        <?php } else { ?>
            <form id="UserRegisterForm" action="/register" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-group">
                        <input id="uFirstName" name="uFirstName" placeholder="First Name" type="text" required class="form-control" value="<?php echo $fname; ?>">
                    </div>
                    <div class="form-group">
                        <input id="uLastName" name="uLastName" placeholder="Last Name" type="text" required class="form-control" value="<?php echo $lname; ?>">
                    </div>
                    <div class="form-group">
                        <input id="uDob" name="uDob" placeholder="Date of Birth" type="text" required class="form-control" onfocus="(this.type='date')" value="<?php echo $dob; ?>">
                    </div>
                    <div class="form-group">
                        <input id="uEmailAddress" name="uEmailAddress" placeholder="Email" type="email" required class="form-control" value="<?php echo $email; ?>">
                    </div>

                    <div class="form-group">
                        <input id="uPhoneNo" name="uPhoneNo" placeholder="Phone Number" type="text" required class="form-control" value="<?php echo $phoneno; ?>">
                    </div>
                    <div class="form-group">
                        <input id="uPassword" name="uPassword" placeholder="Password" type="password" required class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="uCPassword" name="uCPassword" placeholder="Confirm Password" type="password" required class="form-control">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="uAgreedTC" id="TermsConditions" required>
                        <label class="form-check-label" for="TermsConditions">
                            By signing up, you've agreed to our <a href="/terms&conditions">Terms & Conditions</a>
                        </label>
                    </div>
                </div>
                <br>
                <div class="form-group btn-group-lg d-grid gap-2">
                    <button name="register" type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        <?php } ?>
        <!--End User Register Form-->
        <p class="text-muted">Already registered? <a id="displayLoginForm" href="/login">Login</a></p>
    </div>
</div>