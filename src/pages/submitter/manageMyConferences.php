<?php
include_once("./classes/components/card.php");
include_once("./classes/components/timeProcessor.php");
require_once "./classes/dbAPI.class.php";

$db = new Database();
$conferences = $db->getConferences();

foreach ($conferences as $conference) {
    if (TimeProcessor::cmpETimeandCTime($conference->ConferenceEndTimestamp)) {
        $db->updateConference(
            $conference->ConferenceId,
            $conference->ConferenceTitle,
            $conference->ConferenceStartTimestamp,
            $conference->ConferenceEndTimestamp,
            $conference->ConferenceLocation,
            "0"
        );
    }
}

if (isset($_POST['manageMyConferences'])) {
    $attendanceOption = $_POST["attendanceOption"];

    $db->createRegistration(
        $regId,
        $_SESSION["UID"],
        $conference->ConferenceId,
        '',
        $_POST["attendanceOption"]
    );

    header('Location: /dashboard');
}

$submissions = $db->findSubmissionByUserId($_SESSION['UID']);
$users = $db->findUserById($_SESSION['UID']);

?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100 mb-5">
        <h1 class="display-4">My Conferences</h1>
        <p class="lead">Check your conferences progress here. We'll send you a notification nearing the conference date. Keep a look out!</p>
        <div style="margin: auto; width: <?php echo (!Mobile::isActive() ? '36rem' : '100%') ?>;">

            <?php
            if(isset($_POST["attendanceOption"])){
                $confirmedAttendance = $_POST["attendanceOption"];
            } else {
                $confirmedAttendance = "";
            }

            if (!$conferences) {
                echo '
                    <div class="d-flex align-items-center justify-content-center vh-50 bg-secondary">
                        <h1 class="display-6 fw-bold text-white">No current conferences available</h1>
                    </div>';
            } else {
                foreach ($conferences as $conference) {
                    echo Card::display(
                        'conferenceCard',
                        [
                            $conference->ConferenceTitle,
                            $conference->ConferenceLocation,
                            $conference->ConferenceStartTimestamp,
                            $submissions[0]->SubmissionPath,
                            $users[0]->UserFirstName . ' ' . $users[0]->UserLastName,
                            $submissions[0]->SubmissionStatus
                        ]
                    );

                    if ($db->findRegistrationByAttendance($confirmedAttendance)) {
                        echo '<p>attending status will show here</p>';
                    } else {
                        //No regID found, choose confirmation status, then a record will be created with your regId (same as submissionID) and your attending status + other info
                        echo '<form action="/manageMyConferences" method="POST">
                        <select class="form-select" name="attendanceOption">
                            <option value="accept">Confirmed Attendance</option>
                            <option value="reject">Cancel Attendance</option>
                        </select>
                        <br>
                        <div class="form-group btn-group-sm d-grid gap-2">
                            <button name="manageMyConferences" type="submit" class="btn btn-primary" onclick="showToast()">Submit Attendance</button>
                        </div>
                    </form>';
                    }


                    /*
                        echo '<div class="card">';
                        $submissionByID = $db->findSubmissionByConferenceId($conference->ConferenceId);
                        $regId = $conference->ConferenceId . '_' . $_SESSION["UID"];
                        $attendanceByID = $db->findAttendanceById($regId);

                        if (in_array($_SESSION["UID"], array_column($submissionByID, 'UserId'))) {
        
                            // This wil needs fixing
                            // This line checks, if a submission path for the current conference exists, assign it to $file, otherwise display 'file is not available'
                            if (in_array($conference->ConferenceId, array_column($submissions, 'SubmissionPath'))) {
                                $file = in_array($conference->ConferenceId, array_column($submissions, 'SubmissionPath'));
                            } else {
                                $file = 'Not available yet';
                            }

                            //This needs to get the submission status from submissions
                            $status = "unkown";
                            
                            $subData = [
                                $conference->ConferenceTitle,
                                $conference->ConferenceLocation,               
                                $conference->ConferenceStartTimestamp,
                                $file,
                                $_SESSION['uFName'] . " " . $_SESSION['uLName'],
                                $status
                            ];

                            echo Card::display("conference", $subData);

                            // Search for the regID, if found, display attending status, else display confirmation form
                            if (in_array($regId, array_column($allAttendance, 'RegId'))) {
                                echo '<p>attending status will show here</p>';
                            } else {
                                //No regID found, choose confirmation status, then a record will be created with your regId (same as submissionID) and your attending status + other info
                                echo '<form action="/manageMyConferences" method="POST">
                                <select class="form-select" name="attendanceOption">
                                    <option value="accept">Confirmed Attendance</option>
                                    <option value="reject">Cancel Attendance</option>
                                </select>
                                <br>
                                <div class="form-group btn-group-sm d-grid gap-2">
                                    <button name="manageMyConferences" type="submit" class="btn btn-primary" onclick="showToast()">Submit Attendance</button>
                                </div>
                            </form>';
                            }

                            echo '</div>';
                        } else {
                            echo 'This User has no conferences';
                        }
                            */
                }
            }
            ?>

        </div>
    </div>
</div>
<!--CONTENT END-->