<?php
include('./src/template/header.php');

echo "REQ_URI: " . $_SERVER['REQUEST_URI'];


$request = $_SERVER['REQUEST_URI'];
$publicPath = '/src/pages';

//! Where most of pages will be on
if (isset($_SESSION['valid']) && $_SESSION['valid']) {
    include('./src/template/navbar.php');

    switch ($request) {
        case '/':
            require __DIR__ . $publicPath . '/dashboard.php';
            break;

        case '':
            require __DIR__ . $publicPath . '/dashboard.php';
            break;

        case '/app':
            require __DIR__ . $publicPath . '/dashboard.php';
            break;

        case '/dashboard':
            require __DIR__ . $publicPath . '/dashboard.php';
            break;

        default:
            http_response_code(404);
            require __DIR__ . $publicPath . '/errors/404.php';
            break;
    }
} else {

    switch ($request) {
        case '/':
            require __DIR__ . $publicPath . '/login.php';
            break;

        case '':
            require __DIR__ . $publicPath . '/login.php';
            break;

        case '/app':
            require __DIR__ . $publicPath . '/login.php';
            break;

        case '/register':
            require __DIR__ . $publicPath . '/register.php';
            break;

        default:
            http_response_code(404);
            require __DIR__ . $publicPath . '/errors/404.php';
            break;
    }
}


include('./src/template/footer.php');
