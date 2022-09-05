<?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <input type="submit" name="resetSession" value="Reset Current Session" />
</form>
<?php
if (isset($_POST['resetSession'])) {
    session_destroy();
}
?>

<strong>Create Simple Account</strong>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <p> Username: <input type="text" name="username"> </p>
    <p> Password: <input type="text" name="password"> </p>
    <p> Re-Enter Password: <input type="text" name="passwordRepeat"> </p>
    <input type="submit" name="createAccount" value="Register" />
</form>

<?php

if (isset($_POST['createAccount'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];

    if (($password === $passwordRepeat) && (isset($_POST['username']))) {
        $hashPass = hash('sha512', $password);
        $saltHash = password_hash($hashPass, PASSWORD_DEFAULT);

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['hashPass'] = $hashPass;
        $_SESSION['saltHash'] = $saltHash;
    } else {
        echo "Password does not match.";
    }
}

if (isset($_SESSION['password'])) {
    echo "username: <pre>" . $_SESSION['username'] . "</pre>";
    echo "password: <pre>" . $_SESSION['password'] . "</pre>";
    echo "hashed password: <pre>" . $_SESSION['hashPass'] . "</pre>";
    echo "salted & hashed password: <pre>" . $_SESSION['saltHash'] . "</pre>";
}
?>
<hr>

<strong>Verify Account</strong>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <p> Username: <input type="text" name="vUsername"> </p>
    <p> Password: <input type="text" name="vPassword"> </p>
    <input type="submit" name="verifyAccount" value="Register" />
</form>

<?php

if (isset($_POST['verifyAccount'])) {
    if ($_POST['vUsername'] == $_SESSION['username'] && $_POST['vPassword'] == password_verify($_SESSION['hashPass'], $_SESSION['saltHash'])) {
        echo "<p style='color:green'> Password is correct.</p>";
    } else {
        echo "<p style='color:red'> Password is incorrect.</p>";
    }
} else {
    echo "<p style='color:red'> Cannot verify account.</p>";
}

?>