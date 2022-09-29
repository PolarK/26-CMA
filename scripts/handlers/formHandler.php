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
            $data->UserRole
        ];

        echo Card::display('manageUserCard', $userData);
    }
}

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
    );

    displayUsers($db->getAllUser());
}

if (isset($_POST['editBySubmission'])) {
    $db->updateSubmission(
        $_POST['SubmissionId'],
        $_POST['SubmissionFirstName'],
        $_POST['SubmissionLastName'],
        $_POST['SubmissionStatus'],
        $_POST['SubmissionTimestamp'],
        $_POST['SubmissionConferenceLocation'],
        $_POST['SubmissionReviewBy'],
        $_POST['SubmissionPath'],
    );

    displaySubmissions($db->getAllSubmission());
}

if (isset($_POST['editByProfile'])) {
    $db->updateUser(
        $_POST['UserId'],
        $_POST['UserFirstName'],
        $_POST['UserLastName'],
        $_POST['UserDOB'],
        $_POST['UserEmail'],
        $_POST['UserPhoneNo'],
    );

    displayProfile($db->FindUserByID($_POST['UserId']));
}