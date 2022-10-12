<?php
    include_once("./classes/components/card.php");
    include_once("./classes/components/timeProcessor.php");
    require_once "./classes/dbAPI.class.php";

    $db = new Database();
    $events = $db->getConferences();

    foreach($events as $event) {
        // check if conference has expired and update status
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
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100 mb-5">
        <h1 class="display-4">Upcoming Events</h1>
        <p class="lead">Check all of our upcoming events here! Register to the one you are most interested in!</p>
        <div style="margin: auto; width: <?php echo (!Mobile::isActive()? '36rem' : '100%') ?>;">

            <?php
            if (!$events) {
                echo '
                <div class="d-flex align-items-center justify-content-center vh-100 bg-secondary">
                    <h1 class="display-6 fw-bold text-white">No current events available</h1>
                </div>';
            } else {
                foreach ($events as $event) {
                    $status = "Submit Paper";
                    $submissions = $db->findSubmissionByConferenceId($event->ConferenceId);
                    if (in_array($_SESSION["UID"], array_column($submissions, 'UserId'))) {
                        $status = "Resubmit Paper";
                    }

                    $subData = [
                        $event->ConferenceId,
                        $event->ConferenceTitle,                        
                        $event->ConferenceStartTimestamp, 
                        $event->ConferenceEndTimestamp, 
                        $event->ConferenceLocation,
                        $status
                    ];
                    echo Card::display("displayEventCard", $subData);
                }
            }

            ?>

        </div>
    </div>
</div>
<!--CONTENT END-->