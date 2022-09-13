<?php
include('./src/template/header.php');


if ($_SESSION['available']) {
    require __DIR__ . './src/template/navbar.php';
    require __DIR__ . '/src/pages/dashboard.php';
    include('./src/template/footer.php');
    exit();
}

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        require __DIR__ . '/src/pages/login.php';
        break;

    case '':
        require __DIR__ . '/src/pages/login.php';
        break;

    case '/register':
        require __DIR__ . '/src/pages/register.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/src/pages/error/404.php';
        break;
}

include('./src/template/footer.php');
