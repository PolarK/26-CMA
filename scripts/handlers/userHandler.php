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

        echo Card::display('userCard', $userData);
    }
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
