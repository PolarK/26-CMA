<?php
    include_once("./classes/components/card.php");
    require_once "./classes/dbAPI.class.php";

    $db = new Database();
    $events = $db->getConferences();
    
    // might need to make it more pretty
    if (!$events) {
        echo '<div class="d-flex align-items-center justify-content-center vh-100 bg-secondary">
                <h1 class="display-6 fw-bold text-white">No current events available</h1>
              </div>'; 
    }
    else {
        foreach ($events as $event) {
            $status = "Submit Paper"; 
            $submission = $db->findSubmissionByConferenceId($event->ConferenceId);
            if ($submission) {
                $status = "Resubmit Paper"; 
            }
            $timestamp = strtotime($event->ConferenceTimestamp); 
            $date = date('d/m/Y', $timestamp);
            $time = date('H:i', $timestamp);
            $subData = [
                $event->ConferenceId,
                $event->ConferenceTitle,
                $event->ConferenceLocation,
                $date, 
                $time,
                $event->ConferenceRegFee, 
                $status
            ];
            echo Card::display("displayEvent", $subData);
        }
    }
    
?>
    