<?php
include_once "../../classes/components/card.php";
include_once "../../classes/dbAPI.class.php";

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
        $userData = [
            $data->SubmissionId,
            $data->UserFirstName,
            $data->UserLastName,
            $data->SubmissionStatus,
            $data->SubmissionTimestamp,
            $data->ConferenceLocation,
            "Anee Janee", // need to linked 'reviewer's ID'
            $data->SubmissionPath,
        ];

        echo Card::display('manageSubmissionCard', $userData);
    }
}

function rDisplaySubmissions($rawData)
{
    global $db;
    foreach ($rawData as $data) {
        $user = $db->findUserById($data->UserId);
        echo '
        <tr>
            <td>' . $data->ConferenceId . '</td>
            <td>' . $data->UserId . '</td>
            <td>' . $user[0]->UserFirstName . '</td>
            <td>' . $user[0]->UserLastName . '</td>
            <td>' . $data->SubmissionTimestamp . '</td>
            <td>' . $data->SubmissionStatus . '</td>
            <td><a href="./reviewSubmission?filepath=' . $data->SubmissionPath . '">Review</a></td>
        </tr>';
    }
}

/* START USER SEARCH */
if (isset($_POST['searchByUserParam'])) {
    $searchByOption = 'findUserBy' . $_POST['searchByOption'];
    displayUsers($db->$searchByOption($_POST['searchByUserParam']));
}
/* END USER SEARCH */


/* START SUBMISSION SEARCH */
if (isset($_POST['searchBySubmissionParam'])) {
    $searchByOption = (strpos($_POST['searchByOption'], 'Name') != false ? 'findUserBy' : 'findSubmissionBy') . $_POST['searchByOption'];
    displaySubmissions($db->$searchByOption($_POST['searchBySubmissionParam']));
}
/* END SUBMISSION SEARCH */


/* START OF VIEW SUBMISSION SEARCH */

if (isset($_POST['rSearchByCID'])) {
    $submissions = $db->findSubmissionByConferenceId($_POST['rSearchByCID']);
    rDisplaySubmissions($submissions);
}

if (isset($_POST['rSearchByUID'])) {
    $submissions = $db->findSubmissionByUserId($_POST['rSearchByUID']);
    rDisplaySubmissions($submissions);
}

if (isset($_POST['rSearchByUFName'])) {
    $users = $db->findUserByFirstName($_POST['rSearchByUFName']);
    $submissions = array();
    foreach ($users as $user) {
        if (str_contains(strtolower($user->UserFirstName), strtolower($_POST['rSearchByFUName']))) {
            $userSubs = $db->findSubmissionByUserId($user->UserId);
            foreach ($userSubs as $sub) {
                array_push($submissions, $sub);
            }
        }
    }
    rDisplaySubmissions($submissions);
}

if (isset($_POST['rSearchByULName'])) {
    $users = $db->findUserByLastName($_POST['rSearchByULName']);
    $submissions = array();
    foreach ($users as $user) {
        if (str_contains(strtolower($user->UserLastName), strtolower($_POST['rSearchByULName']))) {
            $userSubs = $db->findSubmissionByUserId($user->UserId);
            foreach ($userSubs as $sub) {
                array_push($submissions, $sub);
            }
        }
    }
    rDisplaySubmissions($submissions);
}

if (isset($_POST['rSearchBySubTime'])) {
    $submissions = $db->findSubmissionByTimestamp($_POST['rSearchBySubTime']);
    rDisplaySubmissions($submissions);
}

if (isset($_POST['rSearchBySubStatus'])) {
    $submissions = $db->findSubmissionByStatus($_POST['rSearchBySubStatus']);
    rDisplaySubmissions($submissions);
}

/* END OF VIEW SUBMISSION SEARCH */
