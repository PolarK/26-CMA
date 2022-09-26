<?php
include_once "../../classes/components/card.php";
include_once "../../classes/dbAPI.class.php";

$db = new Database();

function displayUsers($rawData)
{
    echo "";
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

        echo Card::display('userCard', $userData);
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

if (isset($_POST['searchByParam'])) {
    $searchByOption = 'findUserBy'.$_POST['searchByOption'];
    displayUsers($db->$searchByOption($_POST['searchByParam']));
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
