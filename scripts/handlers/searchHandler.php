<?php
include_once "../../classes/dbAPI.class.php";

$db = new Database();

if (isset($_POST['searchUID'])) {
    $db->findUserById('%' . $_POST['searchUID'] . '%');
}

if (isset($_POST['searchFName'])) {
    $db->findUserById('%' . $_POST['searchFName'] . '%');
}

