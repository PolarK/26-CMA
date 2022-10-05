<?php
include_once "../../classes/components/card.php";
include_once '../../classes/dbAPI.class.php';
include_once '../../classes/validator.class.php';
include_once '../../classes/user.class.php';
$db = new Database();

function displayUsers($rawData)
{
    foreach ($rawData as $data) {
        $userData = [
            $data->UserId,
            $data->UserFirstName,
            $data->UserLastName,
            $data->UserDOB,
            $data->UserEmail,
            $data->UserPhoneNo,
            $data->UserRole,
            $data->UserActive,
        ];

        echo Card::display('manageUserCard', $userData);
    }
}

//! UNUSED FEATURE / FOR FUTURE DEVELOPMENT
function displaySubmissions($rawData)
{
    foreach ($rawData as $data) {
        $subData = [
            $data->UserId,
            $data->UserFirstName,
            $data->UserLastName,
            $data->UserDOB,
            $data->UserEmail,
            $data->UserPhoneNo,
            $data->UserRole
        ];

        echo Card::display('manageSubmissionCard', $subData);
    }
}

function displayProfile($rawData)
{
    $subData = [
        $rawData[0]->UserId,
        $rawData[0]->UserFirstName,
        $rawData[0]->UserLastName,
        $rawData[0]->UserEmail,
        $rawData[0]->UserPhoneNo,
        $rawData[0]->UserDOB,
        '**********',
    ];

    echo Card::display('userProfileCard', $subData);
}

if (isset($_POST['editByUser'])) {
    $fname = Validator::sanitise($_POST["UserFirstName"]);
    $lname = Validator::sanitise($_POST["UserLastName"]);
    $dob = Validator::sanitise($_POST["UserDOB"]);
    $phoneno = Validator::sanitise($_POST["UserPhoneNo"]);
    $email = Validator::sanitise($_POST["UserEmail"]);

    $user = new User($fname, $lname, $dob, $email, $phoneno, 'Temp@Pass123', 'Temp@Pass123', array());
    $user->validateUserUpdate();

    if (!Validator::validate($user->get_err())) {
        echo '
        <script>
        $.toast({
            heading: \'Action Failed!\',
            text: \'One or more action resulted in this error. Please correct them.\'. 
            icon:  \'info\',
            position: {
                left: 10,
                top: 110
            },
            hideAfter: 6000,
        });
        </script>';

        displayUsers($db->getAllUser());
        exit;
    }

    echo '
        <script>
        $.toast({
            heading: \'Action Success!\',
            text: \'User with the ID of ' . str_replace('accept-edit-', '', $_POST['editByUser']) . ' was successfully changed.\',
            icon:  \'success\',
            position: {
                left: 10,
                top: 110
            },
            hideAfter: 6000,
        });
        </script>';

    $db->updateUser(
        $_POST['UserId'],
        $_POST['UserFirstName'],
        $_POST['UserLastName'],
        $_POST['UserDOB'],
        $_POST['UserEmail'],
        $_POST['UserPhoneNo'],
        $_POST['UserRole'],
        $_POST['UserActive'],
    );

    displayUsers($db->getAllUser());
}

if (isset($_POST['disableByUser'])) {
    if ($_POST['UserActive'] == 1) {
        $_POST['UserActive'] = 0;
    } else {
        $_POST['UserActive'] = 1;
    }

    $db->updateUser(
        $_POST['UserId'],
        $_POST['UserFirstName'],
        $_POST['UserLastName'],
        $_POST['UserDOB'],
        $_POST['UserEmail'],
        $_POST['UserPhoneNo'],
        $_POST['UserRole'],
        $_POST['UserActive'],
    );

    displayUsers($db->getAllUser());
}

if (isset($_POST['editBySubmission'])) {
    $db->updateSubmission(
        $_POST['SubmissionId'],
    );

    displaySubmissions($db->getAllSubmission());
}

if (isset($_POST['editByProfile'])) {
    $fname = Validator::sanitise($_POST["UserFirstName"]);
    $lname = Validator::sanitise($_POST["UserLastName"]);
    $dob = Validator::sanitise($_POST["UserDOB"]);
    $email = Validator::sanitise($_POST["UserEmail"]);
    $phoneno = Validator::sanitise($_POST["UserPhoneNo"]);
    $pwd = Validator::sanitise($_POST["UserPassword"]);

    $user = new User($fname, $lname, $dob, $email, $phoneno, $pwd, $pwd, array());
    $user->validateUserUpdate();

    if (!Validator::validate($user->get_err())) {
        //! need to have more dynamic approach and only show errors. 
        $errFname = $user->get_err()['fname'];
        $errLname = $user->get_err()['lname'];
        $errEmail = $user->get_err()['email'];
        $errDOB = $user->get_err()['dob'];
        $errPhoneno = $user->get_err()['phoneno'];
        $errPwd = $user->get_err()['pwd'];

        echo '
        <script>
        $.toast({
            heading: \'Action Failed!\',
            text: \'Your profile was not changed. Check the following error and make sure that: \t' .
            $errEmail . ' \',
            icon:  \'info\',
            position: {
                left: 10,
                top: 110
            },
            hideAfter: 6000,
        });
        </script>';

        displayProfile($db->findUserById($_SESSION['UID']));
        exit;
    }

    $id = $_SESSION['UID'];
    $role = $_SESSION['uRole'];
    $isActive = $_SESSION['uActive'];
    $hashedPwd = $user->generatePassword($id, $pwd);

    if (isset($hashedPwd['salt']) && isset($hashedPwd['hash'])) {
        $db->updateUser(
            $id,
            $fname,
            $lname,
            $dob,
            strtolower($email),
            $phoneno,
            $role,
            $isActive,
        );

        $db->updatePassword(
            $id,
            $hashedPwd['salt'],
            $hashedPwd['hash'],
        );

        $_SESSION['uFName'] = $fname;
        $_SESSION['uLName'] = $lname;
        $_SESSION['uDob'] = $dob;
        $_SESSION['uEmail'] = $email;
        $_SESSION['uPhone'] = $phoneno;
    }

    displayProfile($db->findUserById($_SESSION['UID']));

    echo '
        <script>
        $.toast({
            heading: \'Action Successful!\',
            text: \'Your profile was updated!\',
            icon:  \'success\',
            position: {
                left: 10,
                top: 110
            },
            hideAfter: 6000,
        });
        </script>';
}
