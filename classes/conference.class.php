<?php

require_once "dbAPI.class.php";
require_once "errorHandler.class.php";

class Conference
{
    public $title, $sDate, $sTime, $eDate, $eTime, $location, $status; 

    function __construct($title, $sDate, $sTime, $eDate, $eTime, $location, $status, $err)
    {
        $this->title = $title;
        $this->sDate = $sDate;
        $this->sTime = $sTime;
        $this->eDate = $eDate;
        $this->eTime = $eTime;
        $this->location = $location;
        $this->status = $status;
        $this->err = $err;
    }

    function get_err()
    {
        return $this->err;
    }

    function validateTimestamps() {
        // only check logic of start and end dates when conference is active
        if ($this->status == "1") {
            if (empty($this->err["cSDate"]) && empty($this->err["cSTime"])) {
                $this->err["cSTimestamp"] = ErrorHandler::validateCStartTime($this->sDate . " " . $this->sTime); 
            }
    
            if (empty($this->err["cEDate"]) && empty($this->err["cETime"])) {
                $this->err["cETimestamp"] = ErrorHandler::validateCEndTime($this->sDate . " " . $this->sTime, $this->eDate . " " . $this->eTime); 
            }
        }   

    }

    function validateConferenceRegister()
    {
        $this->err["cTitle"] = ErrorHandler::validatecTitle($this->title);
        $this->err["cSDate"] = ErrorHandler::validateDate($this->sDate);
        $this->err["cSTime"] = ErrorHandler::validateTime($this->sTime);
        $this->err["cEDate"] = ErrorHandler::validateDate($this->eDate);
        $this->err["cETime"] = ErrorHandler::validateTime($this->eTime);
        $this->err["cLocation"] = ErrorHandler::validatecLocation($this->location);

        $this->validateTimestamps();         

    }

    function validateConferenceUpdate($titleChange)
    {
        $this->err["cTitle"] = ($titleChange)? ErrorHandler::validatecTitle($this->title) : ErrorHandler::validatecTitleUpdate($this->title); 
        $this->err["cSDate"] = ErrorHandler::validateDate($this->sDate);
        $this->err["cSTime"] = ErrorHandler::validateTime($this->sTime);
        $this->err["cEDate"] = ErrorHandler::validateDate($this->eDate);
        $this->err["cETime"] = ErrorHandler::validateTime($this->eTime);
        $this->err["cLocation"] = ErrorHandler::validatecLocation($this->location);

        $this->validateTimestamps();     
    }

}
