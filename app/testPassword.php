<?php if (session_status() == PHP_SESSION_NONE) session_start(); include_once ("./classes/idGenerator.class.php")?>

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
    <p> Username: <input type="text" name="username" value="<?php echo IDGenerator::user("ADMIN", "Justin", "SAN") ?>"> </p>
    <p> Password: <input type="text" name="password" value="T3stP@$$"> </p>
    <p> Re-Enter Password: <input type="text" name="passwordRepeat" value="T3stP@$$"> </p>
    <input type="submit" name="createAccount" value="Register" />
</form>

<?php

if (isset($_POST['createAccount'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];

    if (($password === $passwordRepeat) && (isset($_POST['username']))) {
        $salt = hash('SHA512', microtime(true).mt_rand(1000,9000));
        $hashPass = hash('SHA512', $salt.$username.$password);

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['salt'] = $salt;
        $_SESSION['hashPass'] = $hashPass;
    } else {
        echo "Password does not match.";
    }
}

if (isset($_SESSION['password'])) {
    echo "username: <pre>" . $_SESSION['username'] . "</pre>";
    echo "password: <pre>" . $_SESSION['password'] . "</pre>";
    echo "salt: <pre>" . $_SESSION['salt'] . "</pre>";
    echo "hashed password: <pre>" . $_SESSION['hashPass'] . "</pre>";
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

function verifyAccount($uname, $upass){
    //* Have to grab Salt & Hash from DB. This is just an example...
    $salt = $_SESSION['salt'];
    $hash = $_SESSION['hashPass'];

    echo hash('SHA512', $salt.$uname.$upass);

    return hash('SHA512', $salt.$uname.$upass) == $hash;
}

if (isset($_POST['verifyAccount'])) {


    if ($_POST['vUsername'] == $_SESSION['username'] && verifyAccount($_POST['vUsername'], $_POST['vPassword'])) {
        echo "<p style='color:green'> Password is correct.</p>";
    } else {
        echo "<p style='color:red'> Password is incorrect.</p>";
    }
} else {
    echo "<p style='color:red'> Cannot verify account.</p>";
}

?>