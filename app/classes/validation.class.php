<?php
class Validate{
    /* constant global variable that can only be used within the class. */
    protected const NAME = "[0-9a-zA-Z\s]{3,45}";
    protected const EMAIL = "[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
    protected const PHONE = "[0-9]{10}";
    protected const ADDRESS = "[0-9a-zA-Z\s]{3,45}";
    protected const PASSWORD = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$";


    /* method to check whether the value is valid or not. */
    static function isValid($regex, $var){
        if($var == "" || !preg_match("/^$regex$/", $var)){
            return false;
        }
        return true;
    }
}
?>