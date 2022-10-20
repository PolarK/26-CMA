<?php
    include_once("./classes/components/card.php");
    include_once("./classes/components/timeProcessor.php");
    require_once "./classes/dbAPI.class.php";

    $db = new Database();
    $conferences = $db->getConferences();
    $submissions = $db->getAllSubmission();

    foreach($conferences as $conference) {
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
        <h1 class="display-4">My Conferences</h1>
        <p class="lead">Check your conferences progress here. We'll send you a notification nearing the conference date. Keep a look out!</p>
        <div style="margin: auto; width: <?php echo (!Mobile::isActive()? '36rem' : '100%') ?>;">

            <?php
                if (!$conferences) {
                    echo '
                    <div class="d-flex align-items-center justify-content-center vh-50 bg-secondary">
                        <h1 class="display-6 fw-bold text-white">No current conferences available</h1>
                    </div>';
                } else {
                    foreach ($conferences as $conference) {
                        $submissionByID = $db->findSubmissionByConferenceId($conference->ConferenceId);

                        if (in_array($_SESSION["UID"], array_column($submissionByID, 'UserId'))) {
                        
                            // This wil needs fixing
                            // This line checks, if a submission path for the current conference exists, assign it to $file, otherwise display 'file is not available'
                            if (in_array($conference->ConferenceId, array_column($submissions, 'SubmissionPath'))) {
                                $file = in_array($conference->ConferenceId, array_column($submissions, 'SubmissionPath'));
                            } else {
                                $file = 'Not available yet';
                            }
                            
                            $subData = [
                                $conference->ConferenceTitle,
                                $conference->ConferenceLocation,               
                                $conference->ConferenceStartTimestamp,
                                $file,
                                $_SESSION['uFName'] . " " . $_SESSION['uLName'],
                                'status unknown'
                            ];

                            echo Card::display("conference", $subData);
                        }
                    }
                }
            ?>
            
        </div>
    </div>
</div>
<!--CONTENT END-->