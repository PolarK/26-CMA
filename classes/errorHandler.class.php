<?php
include_once __DIR__ . "/../classes/validator.class.php";
include_once __DIR__ . "/../classes/dbAPI.class.php";

class ErrorHandler extends Validator
{
    static function validateFname($fname)
    {
        if (empty($fname)) {
            return "Please enter your first name";
        } else if (!self::isValid(self::REGEX_NAME, $fname)) {
            return "Please enter a valid first name";
        }
    }

    static function validateLname($lname)
    {
        if (empty($lname)) {
            return "Please enter your last name";
        } else if (!self::isValid(self::REGEX_NAME, $lname)) {
            return "Please enter a valid last name";
        }
    }

    static function validateDob($dob)
    {
        if (empty($dob)) {
            return "Please enter your date of birth";
        }
    }

    static function validateEmail($email)
    {
        $db = new  Database();
        $uRawData = $db->findUserByEmail($email);

        if (empty($email)) {
            return "Please enter your email address";
        } else if (!self::isValid(self::REGEX_EMAIL, $email)) {
            return "Please enter a valid email address";
        } else if (!empty($uRawData)) {
            return "Email address already exist. Try <a href='/login'>logging in </a> instead";
        }
    }

    static function validatePhoneno($phoneno)
    {
        if (empty($phoneno)) {
            return "Please enter your phone number";
        } else if (!self::isValid(self::REGEX_PHONE, $phoneno)) {
            return "Please enter a valid phone number";
        }
    }

    static function validatePwd($pwd, $cpwd)
    {
        if (empty($pwd)) {
            return "Please enter a password";
        } else if (!self::isValid(self::REGEX_PASSWORD, $pwd)) {
            return "Your password must be at least 8 characters long, contain at least one letter, one number, and one special character. ";
        } else if ($pwd != $cpwd) {
            return "Both password need to match";
        }
    }

    
    static function validatecTitle($cTitle)
    {
        if (empty($cTitle)) {
            return "Please enter a conference title";
        } else {
            $db = new Database; 
            $conferences = $db->findConferenceByTitle($cTitle);

            if (count($conferences) > 0) {
                foreach($conferences as $conference)
                {
                    if(strtolower($conference->ConferenceTitle) == strtolower($cTitle)) {
                        return "This conference title has already been used. Please enter a different title. "; 
                    }
                }
            }
        }
    }

    static function validatecTitleUpdate($cTitle)
    {
        if (empty($cTitle)) {
            return "Please enter a conference title";
        } 
    }

    static function validatecLocation($cLocation)
    {
        if (empty($cLocation)) {
            return "Please enter a conference location/link";
        } 
    }

    static function validateDate($date)
    {
        if (empty($date)) {
            return "Please enter a date";
        } else if (!self::isValid(self::REGEX_DATE, $date)) {
            return "Please enter a valid date";
        }
    }

    static function validateTime($time)
    {
        if (empty($time)) {
            return "Please enter a time";
        } 
    }

    static function validateCStartTime($timestamp)
    {
        $start = strtotime($timestamp);
        
        if (self::invalidCTime($start)) {
            return "Please enter a valid start date and time"; 
        }
    }

    static function validateCEndTime($sTimestamp, $eTimestamp)
    {
        $start = strtotime($sTimestamp);
        $end = strtotime($eTimestamp);

        if (self::invalidCTime($end) || self::invalidCSETime($start, $end)) {
            return "Please enter a valid end date and time"; 
        }
    }

    static function invalidCTime($timestamp)
    {
        return $timestamp < strtotime(date('Y-m-d H:i:s')); 
    }

    static function invalidCSETime($start, $end)
    {
        return $start > $end;        
    }
}
