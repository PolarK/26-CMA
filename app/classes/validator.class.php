<?php
    class Validator {

        /* constant global variable that can only be used within the class. */
        protected const REGEX_NAME = "[0-9a-zA-Z\s]{3,45}";
        protected const REGEX_EMAIL = "[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
        protected const REGEX_PHONE = "[0-9]{10}";
        protected const REGEX_ADDRESS = "[0-9a-zA-Z\s]{3,45}";
        protected const REGEX_PASSWORD = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$";

        /* method to check whether the value is valid or not. */
        static function isValid($regex, $var){
            if($var == "" || !preg_match("/^$regex$/", $var)){
                return false;
            }
            return true;
        }

        // clean input data
        static function sanitise($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // check if there are any error messages
        static function validate($err) {
            foreach ($err as $msg) {
                if (!empty($msg)) return false; 
            }
            return true; 
        }

        static function validateFname($fname) {
            if (empty($fname)) {
                return "Please enter your first name"; 
            }
            else if (!self::isValid(self::REGEX_NAME, $fname)) {
                return "Please enter a valid first name"; 
            }
        }

        static function validateLname($lname) {
            if (empty($lname)) {
                return "Please enter your last name"; 
            }
            else if (!self::isValid(self::REGEX_NAME, $lname)) {
                return "Please enter a valid last name"; 
            }
        }

        static function validateDob($dob) {
            if (empty($dob)) {
                return "Please enter your date of birth"; 
            }
        }

        static function validateEmail($email) {
            if (empty($email)) {
                return "Please enter your email address"; 
            }
            else if (!self::isValid(self::REGEX_EMAIL, $email)) {
                return "Please enter a valid email address"; 
            }
        }

        static function validatePhoneno($phoneno) {
            if (empty($phoneno)) {
                return "Please enter your phone number"; 
            }
            else if (!self::isValid(self::REGEX_PHONE, $phoneno)) {
                return "Please enter a valid phone number"; 
            }
        }

        static function validateAddress($address) {
            if (empty($address)) {
                return "Please enter your address"; 
            }
            else if (!self::isValid(self::REGEX_ADDRESS, $address)) {
                return "Please enter a valid address"; 
            }
        }

        static function validatePwd($pwd) {
            if (empty($pwd)) {
                return "Please enter a password"; 
            }
            else if (!self::isValid(self::REGEX_PASSWORD, $pwd)) {
                return "Please enter a valid password"; 
            }
        }
    
    }
?>