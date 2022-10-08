<?php
require_once "./classes/dbAPI.class.php";
require_once "./classes/user.class.php";
require_once "./classes/validator.class.php";
require_once "./classes/idGenerator.class.php";

$db = new Database();

if (isset($_POST['register'])) {
    $role = Validator::sanitise($_POST['role']);
    $email = Validator::sanitise($_POST["uEmail"]);
    $fname = Validator::sanitise($_POST["uFirstName"]);
    $lname = Validator::sanitise($_POST["uLastName"]);
    $pwd = IDGenerator::password($fname, $lname);

    // Ill leave the prefilled fields unless we want have the admin manually put them in
    $user = new User($fname, $lname, '1970-01-01', $email, '0441234567', $pwd, $pwd, array());
    $user->validateAdminCreateUser();
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
                $role
            );

            $db->createPassword(
                $id,
                $hashedPwd['salt'],
                $hashedPwd['hash']
            );
        }

        // For now the email bit will be commented out to test the toasts by themselves
        /*
        $to = $_POST['email'];
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $subject = 'C-SMS Account';
        $message = '
                    <h5> Hi there! </h5>
                    <p>Your new C-SMS account has been successfully created!</p>
                    <p>Thank you for being a part of our ever growing community.</p>
                    <p>We have attached your credential below. Don\'t forget to change your password as soon as possible!</p>
                    <pre>';
        $message .= '   email   : ' . $email .
            '   password: ' . $password .
            '</pre>';

        $message .= ' <p> - Regards, C-SMS Team.</p>';

        mail($to, $subject, $message, $headers);

        echo $email, $password;
        */

        Validator::displaySuccessfulToast();
    }
    else {
        Validator::displayErrorToasts($errs);
    }
}
?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
        <h1 class="display-4">Create New User</h1>
        <p class="lead">You have the power to create new Admin / Reviwer user account!</p>
        <br>
        <div style="margin: auto; width: <?php echo (!Mobile::isActive() ? '36rem' : '100%') ?>;">
            <!--Start New User Register Form-->
            <form class="form" id="registerNewAccount" action="/createNewUser" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <h6 class="form-group ">Role </h6>
                    <div class="dropdown">
                        <select id="role" name="role" class="form-select form-select-sm" aria-label="Default select">
                            <option value="REVIEWER"><a class="dropdown-item" name="roleReviewer" id="roleReviewer" href="#">REVIEWER</a></option>
                            <option value="ADMIN"><a class="dropdown-item" name="roleAdmin" id="roleAdmin" href="#">ADMIN</a></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <h6 class="form-group">Email </h6>
                    <input id="uEmail" name="uEmail" placeholder="Email" type="email" required class="form-control">
                </div>

                <div class="form-group">
                    <h6 class="form-group">First Name </h6>
                    <input id="uFirstName" name="uFirstName" placeholder="First Name" type="text" required class="form-control">
                </div>

                <div class="form-group">
                    <h6 class="form-group">Last Name </h6>
                    <input id="uLastName" name="uLastName" placeholder="Last Name" type="text" required class="form-control">
                </div>

                <div class="form-group btn-group d-grid gap-2">
                    <button name="register" type="submit" class="btn btn-primary">Register New User</button>
                </div>
            </form>
            <!--End New User Register Form-->
        </div>
    </div>
</div>
<!--CONTENT END-->