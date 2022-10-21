<?php
date_default_timezone_set('Australia/Melbourne');

include('./src/template/header.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$request = $_SERVER['REQUEST_URI'];
$publicPath = __DIR__ . '/src/pages';

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

            case (preg_match('/submitPaper\?conferenceid=.*/', $request) ? true : false):
                require $publicPath . '/submitter/submitPaper.php';
                break;

            case (preg_match('/viewSubmission\?filepath=.*&subId=.*/', $request) ? true : false):
                require $publicPath . '/submitter/viewSubmission.php';
                break;

            case '/registerConference':
                require $publicPath . '/submitter/registerConference.php';
                break;

            case '/myUpcomingConferences':
                require $publicPath . '/submitter/myUpcomingConferences.php';
                break;

            case '/registerNewConference':
                require $publicPath . '/submitter/registerNewConference.php';
                break;

            case '/conferences':
                require $publicPath . '/submitter/displayConferences.php';
                break;

            case '/privacyPolicy':
                require $publicPath . '/../template/privacyPolicy.html';
                break;

            case '/terms&conditions':
                require $publicPath . '/../template/termConditions.html';
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

            case '/viewSubmissions':
                require $publicPath . '/reviewer/viewSubmissions.php';
                break;

            case (preg_match('/reviewSubmission\?filepath=.*&rSubId=.*/', $request) ? true : false):
                require $publicPath . '/reviewer/reviewSubmission.php';
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

            case '/createNewUser':
                require $publicPath . '/admin/createNewUser.php';
                break;

            case '/manageUsers':
                require $publicPath . '/admin/manageUsers.php';
                break;
                /* //! UNUSED FEATURE / FOR FUTURE DEVELOPMENT
            case '/manageSubmissions':
                require $publicPath . '/admin/manageSubmissions.php';
                break;
            */

            case '/manageConferences':
                require $publicPath . '/admin/manageConferences.php';
                break; 

            case '/createNewConference':
                require $publicPath . '/admin/createNewConference.php';
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
            require $publicPath . '/landingPage.php';
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

        case '/terms&conditions':
            require $publicPath . '/../template/termConditions.html';
            break;

        default:
            http_response_code(404);
            require $publicPath . '/errors/404.php';
            break;
    }
}
include('./src/template/footer.php');
