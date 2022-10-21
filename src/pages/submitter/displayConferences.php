<?php
    include_once("./classes/components/card.php");
    include_once("./classes/components/timeProcessor.php");
    require_once "./classes/dbAPI.class.php";

    $db = new Database();
    $conferences = $db->getConferences();

    foreach($conferences as $conference) {
        // check if conference has expired and update status
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

    $conferences = $db->findConferenceByStatus("1");
?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100 mb-5">
        <h1 class="display-4">Upcoming Conferences</h1>
        <p class="lead">Check all of our upcoming conferences here! Register to the one you are most interested in!</p>
        <div style="margin: auto; width: <?php echo (!Mobile::isActive()? '36rem' : '100%') ?>;">

            <?php
            if (!$conferences) {
                echo '
                <div class="d-flex align-items-center justify-content-center vh-100 bg-secondary">
                    <h1 class="display-6 fw-bold text-white">No current conferences available</h1>
                </div>';
            } else {
                foreach ($conferences as $conference) {
                    $status = "Submit Paper";
                    $submissions = $db->findSubmissionByConferenceId($conference->ConferenceId);
                    if (in_array($_SESSION["UID"], array_column($submissions, 'UserId'))) {
                        $status = "Resubmit Paper";
                    }

                    $subData = [
                        $conference->ConferenceId,
                        $conference->ConferenceTitle,                        
                        $conference->ConferenceStartTimestamp, 
                        $conference->ConferenceEndTimestamp, 
                        $conference->ConferenceLocation,
                        $status
                    ];
                    echo Card::display("displayConferenceCard", $subData);
                }
            }

            ?>

        </div>
    </div>
</div>
<!--CONTENT END-->