<?php

use function PHPUnit\Framework\isReadable;

    include_once("./classes/components/card.php");
    include_once("./classes/dbAPI.class.php");
    require_once "./classes/components/toast.php";
    require_once "./classes/idGenerator.class.php";

    $db = new Database(); 

    $submissions = $db->findSubmissionByUserId($_SESSION["UID"]); 

    $successfulSubs = array(); 

    foreach ($submissions as $sub) {
        if ($review = $db->findReviewBySubmissionId($sub->SubmissionId)) {
            if ($review[0]->ReviewStatus == "Success") {
                array_push($successfulSubs, $sub); 
            }
        }
    }

    if (isset($_POST["submitAttendance"])) {
        $attendance = ""; 
        $isRegistered = false; 

        $args = explode("-", $_POST["attendance_options"]); 

        $sub = $db->findSubmissionById($args[1]); 

        $timestamp = date('Y-m-d h:i:s');

        $attendance = ($args[0] == "accept")? 1 : 0; 

        $registrations = $db->findRegistrationByUserId($sub[0]->UserId); 

        foreach ($registrations as $r) {
            if ($r->ConferenceId == $sub[0]->ConferenceId) {
                $registration = $r; 
                $isRegistered = true;                 
            }
        }

        if ($isRegistered) {
            $db->updateRegistration(
                $registration->RegistrationId,         
                $registration->UserId,
                $registration->ConferenceId,
                $timestamp, 
                $attendance
            );  
        }
        else {
            $id = IDGenerator::registration(); 

            $db->createRegistration(
                $id,         
                $sub[0]->UserId,
                $sub[0]->ConferenceId,
                $timestamp, 
                $attendance
            ); 
        }

        $toast_msg = ($attendance)? "Attendance successfully confirmed" : "Attendance cancelled"; 

        echo Toast::successToast($toast_msg); 
    }
    
?>

<!--CONTENT START-->
<div id="attendance_content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
        <h1 class="display-4">My Events</h1>
        <p class="lead">Check your events progress here. We'll send you a notification nearing the event date. Keep a look out!</p>
        <div style="margin: auto; width: 36rem;">

            <?php

            foreach ($successfulSubs as $sub) {
                $conference = $db->findConferenceById($sub->ConferenceId); 

                $registrations = $db->findRegistrationByUserId($sub->UserId); 

                $isRegistered = false;   

                foreach ($registrations as $r) {
                    if ($r->ConferenceId == $sub->ConferenceId) {
                        $registration = $r;  
                        $isRegistered = true;                 
                    }
                }    
                
                $regStatus = ($isRegistered)? $registration->RegistrationAttendance : "pending"; 

                $timestamp = strtotime($conference[0]->ConferenceEndTimestamp);
                $date = date('d/m/Y', $timestamp);
                $time = date('H:i', $timestamp);

                $subData = [
                    $conference[0]->ConferenceTitle,
                    $date, 
                    $time,
                    $conference[0]->ConferenceLocation, 
                    $sub->SubmissionPath,
                    $regStatus, 
                    $sub->SubmissionId
                ];
                
                echo Card::display("conferenceCard", $subData);
                
            }

            ?>
            
        </div>
    </div>
</div>

<!--CONTENT END-->