<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test API</title>
</head>

<body>

    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="text" name="id" placeholder="Enter ID">
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    require_once "classes/dbAPI.class.php";

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $db = new Database();
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
    ?>
</body>

</html>