<?php
include_once __DIR__ . "/../classes/components/toast.php";

class Validator
{
    /* constant global variable that can only be used within the class. */
    protected const REGEX_NAME = "[a-zA-Z\s]{2,45}";
    protected const REGEX_EMAIL = "[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
    protected const REGEX_PHONE = "[0-9]{10}";
    // Min 8 chars, at least 1 letter, 1 number, 1 special char [Qw3rty@123]
    protected const REGEX_PASSWORD = "^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$";
    protected const REGEX_DATE = "\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])"; 

    /* method to check whether the value is valid or not. */
    static function isValid($regex, $var): bool
    {
        if ($var == "" || !preg_match("/^$regex$/", $var)) {
            return false;
        }
        return true;
    }

    // clean input data
    static function sanitise($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // check if there are any error messages
    static function validate($err): bool
    {
        foreach ($err as $msg) {
            if (!empty($msg)) return false;
        }
        return true;
    }

    static function validateAccount($db, $uid, $pwd): bool
    {
        $uPwdData = $db->findPasswordById($uid);

        foreach ($uPwdData as $uPwd) {
            $salt = $uPwd->PassSalt;
            $hash = $uPwd->passHash;
        }

        return hash('SHA512', $salt . $uid . $pwd) == $hash;
    }

    static function displayErrorToasts($errs)
    {
        echo Toast::infoToast("Errors found in data entered"); 
        foreach($errs as $err) {
            if (!empty($err)) {
                echo Toast::errorToast($err); 
            }            
        }   
    }

    static function displaySuccessfulToast()
    {
        echo Toast::successToast("Successfully created new account");
    }


}
