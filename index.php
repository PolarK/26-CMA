<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('./src/template/header.php');


$request = $_SERVER['REQUEST_URI'];
$publicPath = __DIR__ . '/src/pages';

//! FOR DEVELOPMENT ONLY, DELETE WHEN FINISH
//! CHANGE THIS TO EITHER 'ADMIN' | 'REVIEWER' | 'SUBMITTER'
$_SESSION['valid'] = true;
$_SESSION['UID'] = 'SSJ0d3e2';
$_SESSION['uRole'] = 'SUBMITTER';
$_SESSION['uFName'] = 'John';
$_SESSION['uLName'] = 'Smith';
$_SESSION['uDob'] = '1989-12-21';
$_SESSION['uEmail'] = 'john@smith.com';
$_SESSION['uPhone'] = '0432887119';

//! FOR DEVELOPMENT ONLY, DELETE WHEN FINISH


//! Where most of pages will be on
if (isset($_SESSION['valid']) && $_SESSION['valid']) {
    include('./src/template/navbar.php');

    //* Navbar actions
    if ($_SESSION['uRole'] == 'SUBMITTER') {
        switch ($request) {
            case '/':
                require $publicPath . '/dashboard.php';
                break;

            case '':
                require $publicPath . '/dashboard.php';
                break;

            case '/dashboard':
                require $publicPath . '/dashboard.php';
                break;

                //* Dropdown actions
            case '/profile':
                require $publicPath . '/userProfile.php';
                break;

            case '/logout':
                require $publicPath . '/logout.php';
                break;
            case '/checkSubmission':
                require $publicPath . '/submitter/checkSubmission.php';
                break;

            case '/submitPaper':
                require $publicPath . '/submitter/submitPaper.php';
                break;

            case '/manageMyEvents':
                require $publicPath . '/submitter/manageMyEvents.php';
                break;

            case '/myUpcomingEvents':
                require $publicPath . '/submitter/myUpcomingEvents.php';
                break;

            case '/registerNewEvent':
                require $publicPath . '/submitter/registerNewEvent.php';
                break;

            default:
                http_response_code(404);
                require $publicPath . '/errors/404.php';
                break;
        }
    } else if ($_SESSION['uRole'] == 'REVIEWER') {
        switch ($request) {
            case '/':
                require $publicPath . '/dashboard.php';
                break;

            case '':
                require $publicPath . '/dashboard.php';
                break;

            case '/dashboard':
                require $publicPath . '/dashboard.php';
                break;

                //* Dropdown actions
            case '/profile':
                require $publicPath . '/userProfile.php';
                break;

            case '/logout':
                require $publicPath . '/logout.php';
                break;

            case '/reviewSubmission':
                require $publicPath . '/reviewer/reviewSubmission.php';
                break;

            case '/createNewEvent':
                require $publicPath . '/reviewer/createNewEvent.php';
                break;

            case '/manageUpcomingEvents':
                require $publicPath . '/reviewer/manageUpcomingEvents.php';
                break;

            case '/checkUpcomingEvents':
                require $publicPath . '/reviewer/checkUpcomingEvents.php';
                break;

            default:
                http_response_code(404);
                require $publicPath . '/errors/404.php';
                break;
        }
    } else if ($_SESSION['uRole'] == 'ADMIN') {
        switch ($request) {
            case '/':
                require $publicPath . '/dashboard.php';
                break;

            case '':
                require $publicPath . '/dashboard.php';
                break;

            case '/dashboard':
                require $publicPath . '/dashboard.php';
                break;

                //* Dropdown actions
            case '/profile':
                require $publicPath . '/userProfile.php';
                break;

            case '/logout':
                require $publicPath . '/logout.php';
                break;

            case '/manageUsers':
                require $publicPath . '/admin/manageUsers.php';
                break;

            case '/manageSubmissions':
                require $publicPath . '/admin/manageSubmissions.php';
                break;

            case '/manageEvents':
                require $publicPath . '/admin/manageEvents.php';
                break;

            default:
                http_response_code(404);
                require $publicPath . '/errors/404.php';
                break;
        }
    }
} else {
    switch ($request) {
        case '/':
            require $publicPath . '/login.php';
            break;

        case '':
            require $publicPath . '/login.php';
            break;

        case '/login':
            require $publicPath . '/login.php';
            break;

        case '/register':
            require $publicPath . '/register.php';
            break;

        default:
            http_response_code(404);
            require $publicPath . '/errors/404.php';
            break;
    }
}
include('./src/template/footer.php');
