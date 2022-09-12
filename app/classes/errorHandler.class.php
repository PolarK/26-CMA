<?php
include_once "./classes/validator.class.php";

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
        if (empty($email)) {
            return "Please enter your email address";
        } else if (!self::isValid(self::REGEX_EMAIL, $email)) {
            return "Please enter a valid email address";
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

    static function validateAddress($address)
    {
        if (empty($address)) {
            return "Please enter your address";
        } else if (!self::isValid(self::REGEX_ADDRESS, $address)) {
            return "Please enter a valid address";
        }
    }

    static function validatePwd($pwd, $cpwd)
    {
        if (empty($pwd)) {
            return "Please enter a password";
        }

        if (!self::isValid(self::REGEX_PASSWORD, $pwd)) {
            return "Please enter a valid password";
        }

        if ($pwd != $cpwd) {
            return "Both password need to match";
        }
    }
}
