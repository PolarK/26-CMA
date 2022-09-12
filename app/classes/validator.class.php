<?php
    class Validator {

        /* constant global variable that can only be used within the class. */
        protected const REGEX_NAME = "[0-9a-zA-Z\s]{3,45}";
        protected const REGEX_EMAIL = "[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
        protected const REGEX_PHONE = "[0-9]{10}";
        protected const REGEX_ADDRESS = "[0-9a-zA-Z\s]{3,45}";
        // Min 8 chars, at least 1 letter, 1 number, 1 special char
        protected const REGEX_PASSWORD = "^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$";

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
    }
?>