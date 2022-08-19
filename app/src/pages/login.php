<?php

//include "../others/template/functions.php";

$email = $pwd = "";

$err_msgs = [
    'email_err' => '',
    'pwd_err' => ''
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitise($_POST["uEmailAddress"]);
    $pwd = sanitise($_POST["uPassword"]);

    if ($email == "") {
        $err_msgs['email_err'] = "Please enter your email address. ";
    }

    if ($pwd == "") {
        $err_msgs['pwd_err'] = "Please enter your password. ";
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
        <h3 class="text-muted">User Login Page</h3>
        <br>
        <!--Start Login Form-->
        <form id="UserLoginForm" action="userlogin.php" method="post">
            <div class="form-group">
                <div class="text-start"><small class="text-danger"><?php echo $err_msgs['email_err'] ?></small></div>
                <input id="uEmailAddress" name="uEmailAddress" placeholder="Email" type="email" required class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <div class="text-start"><small class="text-danger"><?php echo $err_msgs['pwd_err'] ?></small></div>
                <input id="uPassword" name="uPassword" placeholder="Password" type="password" required class="form-control" value="<?php echo $pwd; ?>">
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
        <p class="text-muted">Don't have an account? <a id="registerForm" href="#">Register</a></p>
    </div>

</div>