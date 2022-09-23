<?php
include_once "../../classes/dbAPI.class.php";



$db = new Database();

function displayUsers($rawData)
{
    foreach ($rawData as $user) {
        echo '
        <tr>
            <td>' . $user->UserId . '</td>
            <td>' . $user->UserFirstName . '</td>
            <td>' . $user->UserLastName . '</td>
            <td>' . $user->UserDOB . '</td>
            <td>' . $user->UserEmail . '</td>
            <td>' . $user->UserPhoneNo . '</td>
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

