<?php
require_once "./classes/dbAPI.class.php";
require_once "./classes/user.class.php";
require_once "./classes/validator.class.php";

$email = '';
$db = new Database();

if (isset($_POST['login'])) {
    $email = Validator::sanitise($_POST['uEmailAddress']);
    $pwd = Validator::sanitise($_POST["uPassword"]);

    $uRawData = $db->findUserByEmail($email);

    if (empty($uRawData)) {
        echo '
        <script>
        $.toast({
            heading: \'Failed to Login!\',
            text: \'It may be that you do not have an account with us. If so, <a href="/register">Register your account here! </a>\',
            icon:  \'info\',
            position: {
                left: 10,
                top: 10
            },
            hideAfter: 6000,
        });
        </script>';
    } else {
        foreach ($uRawData as $uData) {
            $uid = $uData->UserId;
            $fname = $uData->UserFirstName;
            $lname = $uData->UserLastName;
            $dob = $uData->UserDOB;
            $email = $uData->UserEmail;
            $phoneno = $uData->UserPhoneNo;
            $role = $uData->UserRole;
            $isActive = $uData->UserActive;
        }
        if (!Validator::validateAccount($db, $uid, $pwd) ||  !$isActive) {
            echo '
            <script>
            $.toast({
                heading: \'Failed to Login!\',
                text: \'Either email / password is invalid or your account may be disabled. If you belive this was a mistake, please contact us.\',
                icon:  \'info\',
                position: {
                    left: 10,
                    top: 10
                },
                hideAfter: 6000,
            });
            </script>';
        } else {
            $_SESSION['valid'] = true;
            $_SESSION['UID'] = $uid;
            $_SESSION['uRole'] = $role;
            $_SESSION['uFName'] = $fname;
            $_SESSION['uLName'] = $lname;
            $_SESSION['uDob'] = $dob;
            $_SESSION['uEmail'] = $email;
            $_SESSION['uPhone'] = $phoneno;

            header('Location: /dashboard');
        }
    }
}

?>

<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center text-center h-100">
    <div style="margin: auto; width: 18rem;">
        <img src="src\images\CSMS_Logo.png" class="card-img-top" alt="CMS Logo">
    </div>
    <div class="card-body">
        <h1 class="card-title">Conference Submission Management System</h1>
        <h3 class="text-muted">User Login Page</h3>
        <br>
        <!--Start Login Form-->
        <form id="UserLoginForm" action="#" method="post">
            <div class="form-group">
                <!-- \/ WILL NEED TO USE TOAST FOR INVALID LOGIN! \/ -->
                <div class="text-start"><small class="text-danger"><?php echo (isset($user)) ? $user->err['login'] : ' ' ?></small></div>
                <!-- /\ WILL NEED TO USE TOAST FOR INVALID LOGIN! /\-->
                <input id="uEmailAddress" name="uEmailAddress" placeholder="Email" type="text" required class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <input id="uPassword" name="uPassword" placeholder="Password" type="password" required class="form-control">
            </div>
            <div class="form-check">
                <div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input name="checkbox" id="uRemember" type="checkbox" class="custom-control-input" value="IsRemembered">
                        <label for="uRemember" class="custom-control-label">Remember me?</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group btn-group-lg d-grid gap-2">
                <button name="login" type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <!--End Login Form-->
        <p class="text-muted">Don't have an account? <a id="displayRegisterForm" href="/register">Register</a></p>
    </div>

</div>