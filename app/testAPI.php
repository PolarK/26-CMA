<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test API</title>
</head>

<body>
    <p>FIND USER:</p>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="GET">
        <input type="text" name="id" placeholder="Enter ID">
        <input type="submit" name="submitUID" value="Find User">
    </form>
    <hr>
    <p>CREATE USER:</p>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="text" name="firstName" placeholder="First Name">
        <input type="text" name="lastName" placeholder="Last Name">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="phoneNo" placeholder="Phone number">
        <input type="text" name="role" placeholder="Role">
        
        <input type="submit" name="submitUser" value="Create Submit">

    </form>

    <?php
    require_once "classes/dbAPI.class.php";
    $db = new Database();

    if (isset($_GET['submitUID'])) {
        $id = $_GET['id'];
        $users = $db->findUserById($id);
        echo 'Finding user with id that contain number ' . $id . '<br>';

        foreach ($users as $user) {
            echo
            '<pre>' .
                '   ID: ' . $user->UserId . '<br>' .
                '   Name: ' . $user->UserFirstName . ' ' . $user->UserLastName . '<br>' .
                '   DOB: ' . $user->UserDOB . '<br>' .
                '   EMAIL: ' . $user->UserEmail . '<br>' .
                '   PHONE: ' . $user->UserPhoneNo . '<br>' .
                '   ROLE: ' . $user->UserRole . '<br>' .
                '</pre><br><hr>';
        }
    }

    if (isset($_POST['submitUser'])){
        $newUser = $db->createNewUser(
            $_POST['ID'],
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['email'],
            $_POST['phoneNo'],
            $_POST['role']
        );



    }
    ?>
</body>

</html>