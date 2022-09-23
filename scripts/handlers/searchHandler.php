<?php
include_once "../../classes/dbAPI.class.php";

$db = new Database();

function displayUsers($rawData)
{
    foreach ($rawData as $data) {
        echo '
        <tr>
            <td>' . $data->UserId . '</td>
            <td>' . $data->UserFirstName . '</td>
            <td>' . $data->UserLastName . '</td>
            <td>' . $data->UserDOB . '</td>
            <td>' . $data->UserEmail . '</td>
            <td>' . $data->UserPhoneNo . '</td>
        </tr>';
    }
}

function displaySubmissions($rawData)
{
    foreach ($rawData as $data) {
        echo '
        <tr>
            <td>' . $data->SubmissionId . '</td>
            <td>' . $data->UserId . '</td>
            <td>' . $data->SubmissionTimestamp . '</td>
            <td>' . $data->SubmissionPath . '</td>
        </tr>';
    }
}

/* START USER SEARCH */

if (isset($_POST['searchByUID'])) {
    $users = $db->findUserById($_POST['searchByUID']);
    displayUsers($users);
}

if (isset($_POST['searchByFName'])) {
    $users = $db->findUserByFirstName($_POST['searchByFName']);
    displayUsers($users);
}

if (isset($_POST['searchByLName'])) {
    $users = $db->findUserByLastName($_POST['searchByLName']);
    displayUsers($users);
}

if (isset($_POST['searchByDOB'])) {
    $users = $db->findUserByDOB($_POST['searchByDOB']);
    displayUsers($users);
}

if (isset($_POST['searchByEmail'])) {
    $users = $db->findUserByEmail($_POST['searchByEmail']);
    displayUsers($users);
}

if (isset($_POST['searchByPhoneNo'])) {
    $users = $db->findUserByPhoneNo($_POST['searchByPhoneNo']);
    displayUsers($users);
}

if (isset($_POST['searchByRole'])) {
    $users = $db->findUserByRole($_POST['searchByRole']);
    displayUsers($users);
}

/* END USER SEARCH */


/* START SUBMISSION SEARCH */
if (isset($_POST['searchBySID'])) {
    $submissions = $db->findSubmissionById($_POST['searchBySID']);
    displaySubmissions($submissions);
}

//! Will eventually changed to include the user's name instead of their id
if (isset($_POST['searchByName'])) {
    $submissions = $db->findSubmissionById($_POST['searchByName']);
    displaySubmissions($submissions);
}

if (isset($_POST['searchByTimestamp'])) {
    $submissions = $db->findSubmissionByTimestamp($_POST['searchByTimestamp']);
    displaySubmissions($submissions);
}

if (isset($_POST['searchByPath'])) {
    $submissions = $db->findSubmissionByPath($_POST['searchByPath']);
    displaySubmissions($submissions);
}

/* END SUBMISSION SEARCH */
