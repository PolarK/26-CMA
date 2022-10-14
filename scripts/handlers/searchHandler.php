<?php
include_once "../../classes/components/card.php";
include_once "../../classes/dbAPI.class.php";
include_once "../../classes/components/timeProcessor.php";

$db = new Database();

function displayUsers($rawData)
{
    
    foreach ($rawData as $data) {
        $userData = [
            $data->UserId,
            $data->UserFirstName,
            $data->UserLastName,
            $data->UserDOB,
            $data->UserEmail,
            $data->UserPhoneNo,
            $data->UserRole,
            $data->UserActive,
        ];

        echo Card::display('manageUserCard', $userData);
    }
}

function displaySubFromSubs($submissions)
{
    global $db;

    echo Card::display('viewSubTableHeadCard'); 

    if ($submissions) {
  
        foreach ($submissions as $submission) {

            $user = $db->findUserById($submission->UserId); 
            $userFName = $user[0]->UserFirstName; 
            $userLName = $user[0]->UserLastName; 
    
            $reviewer = $db->findReviewById($submission->ReviewerId); 

            $conference = $db->findConferenceById($submission->ConferenceId); 
    
            $comments = "N/A"; 
    
            if ($reviewer) {
                $comments = $reviewer->ReviewComments; 
            }
    
            $data = 
            [
                $submission->SubmissionId, 
                $userFName, 
                $userLName,
                $conference[0]->ConferenceTitle, 
                $submission->SubmissionTimestamp,
                $submission->SubmissionStatus, 
                $comments, 
                $submission->SubmissionPath
            ]; 
            
            echo Card::display('viewSubmissionCard', $data);
        }
    }
    else {
        echo '<tbody id="rSearchResult"><tr><td colspan="6" style="text-align:center">No results<td></tr></tbody>';  
    }

}

function displaySubFromUsers($users)
{
    global $db;

    $submissions = array(); 

    foreach ($users as $user) {
        $subs = $db->findSubmissionByUserId($user->UserId); 

        if ($subs) {
            foreach($subs as $sub) {
                array_push($submissions, $sub); 
            }            
        }
    } 
    
    displaySubFromSubs($submissions); 
}

function displaySubFromConferences($conferences)
{
    global $db;

    $submissions = array(); 
    
    foreach ($conferences as $conference) {

        $subs = $db->findSubmissionByConferenceId($conference->ConferenceId); 

        if ($subs) {
            foreach($subs as $sub) {
                array_push($submissions, $sub); 
            }            
        }
    } 

    displaySubFromSubs($submissions); 
}


function displayConferences($rawData)
{     
    foreach ($rawData as $data) {
        $start = strtotime($data->ConferenceStartTimestamp); 
        $end = strtotime($data->ConferenceEndTimestamp); 

        $sdatetime = TimeProcessor::getDateTime($start); 
        $edatetime = TimeProcessor::getDateTime($end); 

        $cData = [
            $data->ConferenceId,
            $data->ConferenceTitle,
            $sdatetime["date"], 
            $sdatetime["time"], 
            $edatetime["date"], 
            $edatetime["time"], 
            $data->ConferenceLocation, 
            $data->ConferenceStatus
        ];

        echo Card::display('manageConferenceCard', $cData);
    }
}

/* START USER SEARCH */
if (isset($_POST['searchByUserParam'])) {
    $searchByOption = 'findUserBy' . $_POST['searchByOption'];
    displayUsers($db->$searchByOption($_POST['searchByUserParam']));
}
/* END USER SEARCH */


/* START SUBMISSION SEARCH */
if (isset($_POST['searchBySParam'])) {
    $option_array = explode("-", $_POST['searchBySOption']); 

    switch ($option_array[0]) {
        case "sub": 
            $searchByOption = 'findSubmissionBy' . $option_array[1];
            displaySubFromSubs($db->$searchByOption($_POST['searchBySParam'])); 
            break; 

        case "user": 
            $searchByOption = 'findUserBy' . $option_array[1];
            displaySubFromUsers($db->$searchByOption($_POST['searchBySParam']));
            break; 

        case "con": 
            $searchByOption = 'findConferenceBy' . $option_array[1];
            displaySubFromConferences($db->$searchByOption($_POST['searchBySParam']));
            break; 
    }


}

/* END SUBMISSION SEARCH */


/* START CONFERENCE SEARCH */
if (isset($_POST['searchByCParam'])) {
    $searchByOption = 'findConferenceBy' . $_POST['searchByCOption'];
    displayConferences($db->$searchByOption($_POST['searchByCParam']));
}
/* END CONFERENCE SEARCH */