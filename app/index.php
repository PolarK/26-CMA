<?php
include('./src/template/header.php');


$request = $_SERVER['REQUEST_URI'];


//! Where most of pages will be on
if ($_SESSION['available']) {
    include('./src/template/navbar.php');

    switch ($request) {
        case '/':
            require __DIR__ . '/src/pages/dashboard.php';
            break;

        case '':
            require __DIR__ . '/src/pages/dashboard.php';
            break;

        case '/dashboard':
            require __DIR__ . '/src/pages/dashboard.php';
            break;

        default:
            http_response_code(404);
            require __DIR__ . '/src/pages/error/404.php';
            break;
    }
} else {

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
}


include('./src/template/footer.php');
