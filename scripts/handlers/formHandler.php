<?php

use FTP\Connection;

include_once "../../classes/components/card.php";
include_once '../../classes/dbAPI.class.php';
include_once '../../classes/validator.class.php';
include_once '../../classes/user.class.php';
include_once '../../classes/conference.class.php';
include_once "../../classes/components/timeProcessor.php";
include_once "../../classes/components/toast.php";

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

//! UNUSED FEATURE / FOR FUTURE DEVELOPMENT
function displaySubmissions($rawData)
{
    foreach ($rawData as $data) {
        $subData = [
            $data->UserId,
            $data->UserFirstName,
            $data->UserLastName,
            $data->UserDOB,
            $data->UserEmail,
            $data->UserPhoneNo,
            $data->UserRole
        ];

        echo Card::display('manageSubmissionCard', $subData);
    }
}

function displayProfile($rawData)
{
    $subData = [
        $rawData[0]->UserId,
        $rawData[0]->UserFirstName,
        $rawData[0]->UserLastName,
        $rawData[0]->UserEmail,
        $rawData[0]->UserPhoneNo,
        $rawData[0]->UserDOB,
        '**********',
    ];

    echo Card::display('userProfileCard', $subData);
}

function displayConferences($rawData)
{
    foreach ($rawData as $data) {
        $start = strtotime($data->ConferenceStartTimestamp); 
        $end = strtotime($data->ConferenceEndTimestamp); 
       
        $sdatetime = TimeProcessor::getDateTime($start); 
        $edatetime = TimeProcessor::getDateTime($end); 

        $subData = [
            $data->ConferenceId,
            $data->ConferenceTitle,
            $sdatetime["date"], 
            $sdatetime["time"], 
            $edatetime["date"], 
            $edatetime["time"],  
            $data->ConferenceLocation,
            $data->ConferenceStatus
        ];

        echo Card::display('manageConferenceCard', $subData);
    }
}

if (isset($_POST['editByUser'])) {
    $fname = Validator::sanitise($_POST["UserFirstName"]);
    $lname = Validator::sanitise($_POST["UserLastName"]);
    $dob = Validator::sanitise($_POST["UserDOB"]);
    $phoneno = Validator::sanitise($_POST["UserPhoneNo"]);
    $email = Validator::sanitise($_POST["UserEmail"]);

    $user = new User($fname, $lname, $dob, $email, $phoneno, 'Temp@Pass123', 'Temp@Pass123', array());
    $user->validateUserUpdate();

    $errs = $user->get_err(); 

    if (Validator::validate($errs)) {
        $db->updateUser(
            $_POST['UserId'],
            $fname, 
            $lname, 
            $dob, 
            $email, 
            $phoneno,
            $_POST['UserRole'],
            $_POST['UserActive'],
        );
    
        displayUsers($db->getAllUser());
        
    }
    else {

        foreach($errs as $err) {
            if (!empty($err)) {
                echo Toast::errorToast($err); 
            }            
        }     
        echo "<p id='err_user'>Error<p>"; 
    }

   
}

if (isset($_POST['disableByUser'])) {
    if ($_POST['UserActive'] == 1) {
        $_POST['UserActive'] = 0;
    } else {
        $_POST['UserActive'] = 1;
    }

    $db->updateUser(
        $_POST['UserId'],
        $_POST['UserFirstName'],
        $_POST['UserLastName'],
        $_POST['UserDOB'],
        $_POST['UserEmail'],
        $_POST['UserPhoneNo'],
        $_POST['UserRole'],
        $_POST['UserActive'],
    );

    displayUsers($db->getAllUser());
}

if (isset($_POST['editBySubmission'])) {
    $db->updateSubmission(
        $_POST['SubmissionId'],
    );

    displaySubmissions($db->getAllSubmission());
}

if (isset($_POST['editByProfile'])) {
    $fname = Validator::sanitise($_POST["UserFirstName"]);
    $lname = Validator::sanitise($_POST["UserLastName"]);
    $dob = Validator::sanitise($_POST["UserDOB"]);
    $email = Validator::sanitise($_POST["UserEmail"]);
    $phoneno = Validator::sanitise($_POST["UserPhoneNo"]);
    $pwd = Validator::sanitise($_POST["UserPassword"]);

    $user = new User($fname, $lname, $dob, $email, $phoneno, $pwd, $pwd, array());
    $user->validateUserUpdate();

    if (!Validator::validate($user->get_err())) {
        //! need to have more dynamic approach and only show errors. 
        $errFname = $user->get_err()['fname'];
        $errLname = $user->get_err()['lname'];
        $errEmail = $user->get_err()['email'];
        $errDOB = $user->get_err()['dob'];
        $errPhoneno = $user->get_err()['phoneno'];
        $errPwd = $user->get_err()['pwd'];

        Validator::displayErrorToasts($user->get_err()); 
        echo "<p id='err'>Error<p>";  
        
    }
    else {
        $id = $_SESSION['UID'];
        $role = $_SESSION['uRole'];
        $isActive = $_SESSION['uActive'];
        $hashedPwd = $user->generatePassword($id, $pwd);
    
        if (isset($hashedPwd['salt']) && isset($hashedPwd['hash'])) {
            $db->updateUser(
                $id,
                $fname,
                $lname,
                $dob,
                strtolower($email),
                $phoneno,
                $role,
                $isActive,
            );
    
            $db->updatePassword(
                $id,
                $hashedPwd['salt'],
                $hashedPwd['hash'],
            );
    
            $_SESSION['uFName'] = $fname;
            $_SESSION['uLName'] = $lname;
            $_SESSION['uDob'] = $dob;
            $_SESSION['uEmail'] = $email;
            $_SESSION['uPhone'] = $phoneno;

            displayProfile($db->findUserById($_SESSION['UID']));

        }   
    }
}

if (isset($_POST['editByConference'])) {

    $errs = [
        "cTitle" => "", 
        "cLocation" => "", 
        "cSDate" => "", 
        "cSTime" => "",
        "cEDate" => "", 
        "cETime" => "", 
        "cSTimestamp" => "",
        "cETimestamp" => ""
    ];

    $title = Validator::sanitise($_POST["ConferenceTitle"]);
    $sDate = Validator::sanitise($_POST["ConferenceSDate"]);
    $sTime = Validator::sanitise($_POST["ConferenceSTime"]);
    $eDate = Validator::sanitise($_POST["ConferenceEDate"]);
    $eTime = Validator::sanitise($_POST["ConferenceETime"]);
    $location = Validator::sanitise($_POST["ConferenceLocation"]);
    $status = Validator::sanitise($_POST["ConferenceStatus"]);

    $conference = $db->findConferenceById($_POST['ConferenceId']); 
    $titleChange = false; 

    if (strtolower($conference[0]->ConferenceTitle) != strtolower($title)) {             // check if title has been changed
        $titleChange = true; 
    }

    $conference = new Conference($title, $sDate, $sTime, $eDate, $eTime, $location, $status, $errs);
    $conference->validateConferenceUpdate($titleChange);
    $errs = $conference->get_err(); 

    if (Validator::validate($errs)) {
        $db->updateConference(
            $_POST['ConferenceId'],
            $title,
            $sDate . " " . $sTime, 
            $eDate . " " . $eTime, 
            $location, 
            $status
        );

        displayConferences($db->getConferences());
    
    } 
    else {
        foreach($errs as $err) {
            if (!empty($err)) {
                echo Toast::errorToast($err); 
            }            
        }     
        echo "<p id='err'>Error<p>";    
    }
}

if (isset($_POST['editConferenceStatus'])) {

    $errs = [
        "cTitle" => "", 
        "cLocation" => "", 
        "cSDate" => "", 
        "cSTime" => "",
        "cEDate" => "", 
        "cETime" => "", 
        "cSTimestamp" => "",
        "cETimestamp" => ""
    ];

    $conference = $db->findConferenceById($_POST['ConferenceId']); 
    $title = $conference[0]->ConferenceTitle;
    $location = $conference[0]->ConferenceLocation;
    $status = $_POST['ConferenceStatus'];

    $sDate = Validator::sanitise($_POST["ConferenceSDate"]);
    $sTime = Validator::sanitise($_POST["ConferenceSTime"]);
    $eDate = Validator::sanitise($_POST["ConferenceEDate"]);
    $eTime = Validator::sanitise($_POST["ConferenceETime"]);
    
    if ($_POST['ConferenceStatus'] == "1") {
        $tempConference = new Conference($title, $sDate, $sTime, $eDate, $eTime, $location, $status, $errs);
        $tempConference->validateTimestamps();
        $errs = $tempConference->get_err();  
    }

    if (Validator::validate($errs)) {
        $db->updateConference(
            $conference[0]->ConferenceId,
            $conference[0]->ConferenceTitle,
            $sDate . " " . $sTime, 
            $eDate . " " . $eTime, 
            $conference[0]->ConferenceLocation, 
            $status
        );
        
        displayConferences($db->getConferences());
    }
    else {
        echo Toast::infoToast("The conference needs to be updated before being enabled. "); 
        foreach($errs as $err) {
            if (!empty($err)) {
                echo Toast::errorToast($err); 
            }            
        }     
        echo "<p id='err'>Error<p>";   
    }
    
}
