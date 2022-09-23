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

if (isset($_POST['searchByUID'])) {
    $users = $db->findUserById($_POST['searchByUID']);
    displayUsers($users);
}

if (isset($_POST['searchByFName'])) {
    $users = $db->findUserById($_POST['searchByFName']);
    displayUsers($users);
}

