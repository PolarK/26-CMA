<?php
include_once "../../classes/components/card.php";
include_once '../../classes/dbAPI.class.php';
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
        $rawData->UserFirstName,
        $rawData->UserLastName,
        $rawData->UserDOB,
        $rawData->UserEmail,
        $rawData->UserPhoneNo,
        '********'
    ];

    echo Card::display('userProfileCard', $subData);
}

if (isset($_POST['editByUser'])) {
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
    if($_POST['UserActive'] == 1){
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

//! UPDATE THE PROFILE POR FAVOR! 
if (isset($_POST['editByProfile'])) {
    $user = new User('');

    $newPass = $user->generatePassword($_POST['UserId'], $_POST['pwd']);

    $db->updateUser(
        $_POST['UserId'],
        $_POST['UserFirstName'],
        $_POST['UserLastName'],
        $_POST['UserDOB'],
        $_POST['UserEmail'],
        $_POST['UserPhoneNo'],
    );

    $db->updatePassword(
        $_POST['UserId'],
        $newPass['salt'],
        $newPass['hash']
    );


    displayProfile($db->FindUserByID($_POST['UserId']));
}
