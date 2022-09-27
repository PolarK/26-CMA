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
    foreach($users as $user) {
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
    foreach($users as $user) {
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
