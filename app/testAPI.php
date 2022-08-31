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
        <input type="text" name="uID" placeholder="ID" value="AJHS<?php echo mt_rand(1111, 9999); ?>">
        <input type="text" name="firstName" placeholder="First Name" value='Jhon'>
        <input type="text" name="lastName" placeholder="Last Name" value='Smith'>
        <input type="date" name="dob" placeholder="Date of Birth" value='1998-12-12'>
        <input type="email" name="email" placeholder="Email" value='jhon@smith.com'>
        <input type="text" name="phoneNo" placeholder="Phone number" value='0412 398 762'>
        <input type="text" name="role" placeholder="Role" value='ADMIN'>

        <input type="submit" name="submitUser" value="Create Submit">

    </form>

    <?php
    require_once "classes/dbAPI.class.php";
    $db = new Database();

    if (isset($_GET['submitUID'])) {
        $id = $_GET['id'];

        if ($id != null) {
            $users = $db->findUserById($id);
            echo 'Finding user with id that contain number ' . $id . '<br>';
        } else {
            $users = $db->getAllUser();
            echo 'Finding all known users <br>';
        }


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

    if (isset($_POST['submitUser'])) {
        $newUser = $db->createNewUser(
            $_POST['uID'],
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['dob'],
            $_POST['email'],
            $_POST['phoneNo'],
            $_POST['role']
        );
    }
    ?>
</body>

</html>