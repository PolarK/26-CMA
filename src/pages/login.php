<?php
require_once "./classes/dbAPI.class.php";
require_once "./classes/user.class.php";
require_once "./classes/validator.class.php";

$email = '';
$db = new Database();

if (isset($_POST['login'])) {
    $email = Validator::sanitise($_POST['uEmailAddress']);
    $pwd = Validator::sanitise($_POST["uPassword"]);

    $user = new User('','','',$email,'', $pwd, $pwd, array());
    $user->validateUserLogin();

    if (Validator::validate($user->get_err())) {
        $uRawData = $db->findUserByEmail($email);
        
        foreach ($uRawData as $uData) {
            $uid = $uData->UserId;
        }

        if (Validator::validateAccount($db, $uid, $pwd)) {
            $_SESSION['valid'] = true;
            $_SESSION['UID'] = $id;
            $_SESSION['uRole'] = $role;
            $_SESSION['uFName'] = $fname;
            $_SESSION['uLName'] = $lname;
            $_SESSION['uDob'] = $dob;
            $_SESSION['uEmail'] = $email;
            $_SESSION['uPhone'] = $phoneno;
            echo $_SESSION['valid'];
            echo '<script>alert("Success!");</script>';
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
                <div class="text-start"><small class="text-danger"><?php echo (isset($user)) ? $user->err['email'] : ' ' ?></small></div>
                <input id="uEmailAddress" name="uEmailAddress" placeholder="Email" type="text" required class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <div class="text-start"><small class="text-danger"><?php echo (isset($user)) ? $user->err['pwd'] : ' ' ?></small></div>
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
                <button name="login" type="submit" class="btn btn-primary" onclick="showToast()">Login</button>
            </div>
        </form>
        <!--End Login Form-->
        <p class="text-muted">Don't have an account? <a id="displayRegisterForm" href="/register">Register</a></p>
    </div>

</div>