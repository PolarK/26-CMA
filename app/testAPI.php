<?php
require_once "classes/dbAPI.class.php";
$db = new Database();
?>

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

    <?php
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
            '</pre><br>';
        }
    }
    ?>

    <hr>
    <p>CREATE USER:</p>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        User ID <input type="text" name="uID" placeholder="ID" value="AJHS<?php echo mt_rand(1111, 9999); ?>"> <br>
        First Name <input type="text" name="firstName" placeholder="First Name" value='Jhon'> <br>
        Last Name <input type="text" name="lastName" placeholder="Last Name" value='Smith'> <br>
        D-O-B <input type="date" name="dob" placeholder="Date of Birth" value='1998-12-12'> <br>
        Email <input type="email" name="email" placeholder="Email" value='jhon@smit.com'> <br>
        Phone No <input type="text" name="phoneNo" placeholder="Phone number" value='0412 398 762'> <br>
        Role <input type="text" name="role" placeholder="Role" value='ADMIN'> <br>
        <input type="submit" name="submitUser" value="Create Submit">
    </form>

    <?php
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
        echo "<p>User with ID: " . $_POST['uID'] . " has been created.</p>";
    }
    ?>

    <hr>
    <p>UPDATE USER:</p>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php
        if (isset($_POST['updateID'])) {
            $id = $_POST['updateID'];
            $users = $db->findUserById($id);

            foreach ($users as $user) {
                echo '
                User ID <input type="text" name="updateID" placeholder="ID" value="' . $user->UserId . '"> <br>
                First Name <input type="text" name="updateFirstName" placeholder="First Name" value=' . $user->UserFirstName . '><br>
                Last Name <input type="text" name="updateLastName" placeholder="Last Name" value=' . $user->UserLastName . '><br>
                D-O-B <input type="date" name="updateDob" placeholder="Date of Birth" value=' . $user->UserDOB . '><br>
                Email <input type="email" name="updateEmail" placeholder="Email" value=' . $user->UserEmail . '><br>
                Phone No <input type="text" name="updatePhoneNo" placeholder="Phone number" value=' . $user->UserPhoneNo . '><br>
                Role <input type="text" name="updateRole" placeholder="Role" value=' . $user->UserRole . ' ><br>
                <input type="submit" name="updateUser" value="Update User">
                ';
            }
        } else {
            echo '<input type="text" name="id" placeholder="Enter ID">
            <input type="submit" name="updateUser" value="Find User">';
        }
        ?>
    </form>

    <?php
    if (isset($_POST['updateUser'])) {
        $updateUser = $db->updateUser(
            $_POST['updateID'],
            $_POST['updateFirstName'],
            $_POST['updateLastName'],
            $_POST['updateDob'],
            $_POST['updateEmail'],
            $_POST['updatePhoneNo'],
            $_POST['updateRole']
        );
    }
    ?>

</body>

</html>