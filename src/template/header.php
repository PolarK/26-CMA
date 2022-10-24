<?php
if (session_status() == PHP_SESSION_NONE) session_start();
include "./classes/mobile.class.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="src\styles\bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="scripts\libraries\jquery-toast-plugin\dist\jquery.toast.min.css">
    <link rel="icon" type="image/x-icon" href="src\images\CSMS_Logo.png">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="scripts\libraries\jquery-toast-plugin\dist\jquery.toast.min.js"></script>
    <script src="scripts\main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/party-js@latest/bundle/party.min.js"></script>
</head>

<body>