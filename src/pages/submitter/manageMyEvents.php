<?php
    include_once("./classes/components/card.php");
    include_once("./classes/components/timeProcessor.php");
    require_once "./classes/dbAPI.class.php";

    $db = new Database();
    $events = $db->getConferences();
    $submissions = $db->getAllSubmission();

    foreach($events as $event) {
        if (TimeProcessor::cmpETimeandCTime($event->ConferenceEndTimestamp)) {
            $db->updateConference(
                $event->ConferenceId, 
                $event->ConferenceTitle, 
                $event->ConferenceStartTimestamp, 
                $event->ConferenceEndTimestamp, 
                $event->ConferenceLocation, 
                "0"
            ); 
        }
    }

    $events = $db->findConferenceByStatus("1");
?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
        <h1 class="display-4">My Events</h1>
        <p class="lead">Check your events progress here. We'll send you a notification nearing the event date. Keep a look out!</p>
        <div style="margin: auto; width: <?php echo (!Mobile::isActive()? '36rem' : '100%') ?>;">

            <?php
                if (!$events) {
                    echo '
                    <div class="d-flex align-items-center justify-content-center vh-50 bg-secondary">
                        <h1 class="display-6 fw-bold text-white">No current events available</h1>
                    </div>';
                } else {
                    foreach ($events as $event) {
                        $submissionByID = $db->findSubmissionByConferenceId($event->ConferenceId);

                        if (in_array($_SESSION["UID"], array_column($submissionByID, 'UserId'))) {
                        
                            // This wil needs fixing
                            // This line checks, if a submission path for the current conference exists, assign it to $file, otherwise display 'file is not available'
                            if (in_array($event->ConferenceId, array_column($submissions, 'SubmissionPath'))) {
                                $file = in_array($event->ConferenceId, array_column($submissions, 'SubmissionPath'));
                            } else {
                                $file = 'Not available yet';
                            }
                            
                            $subData = [
                                $event->ConferenceTitle,
                                $event->ConferenceLocation,               
                                $event->ConferenceStartTimestamp,
                                $file,
                                $_SESSION['uFName'] . " " . $_SESSION['uLName'],
                                'status unknown'
                            ];

                            echo Card::display("event", $subData);
                        }
                    }
                }
            ?>
            
        </div>
    </div>
</div>
<!--CONTENT END-->