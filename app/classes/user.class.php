<?php

require_once "dbAPI.class.php";
require_once "ErrorHandler.class.php";
require_once "idGenerator.class.php";

class User
{

    // not too sure if user should store password as well
    private $fname, $lname, $dob, $email, $phoneno, $pwd;

    function __construct($fname, $lname, $dob, $email, $phoneno, $pwd, $err)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = $dob;
        $this->email = $email;
        $this->phoneno = $phoneno;
        $this->pwd = $pwd;
        $this->err = $err;
    }

    //? Not sure if gets & sets will be necessery for this ones
    // get and set methods
    function get_fname()
    {
        return $this->fname;
    }
    function set_fname($fname)
    {
        $this->fname = $fname;
    }

    function get_lname()
    {
        return $this->lname;
    }
    function set_lname($lname)
    {
        $this->lname = $lname;
    }

    function get_dob()
    {
        return $this->dob;
    }
    function set_dob($dob)
    {
        $this->dob = $dob;
    }

    function get_email()
    {
        return $this->email;
    }
    function set_email($email)
    {
        $this->email = $email;
    }

    function get_phoneno()
    {
        return $this->phoneno;
    }
    function set_phoneno($phoneno)
    {
        $this->phoneno = $phoneno;
    }

    function get_pwd()
    {
        return $this->pwd;
    }
    function set_pwd($pwd)
    {
        $this->pwd = $pwd;
    }

    function get_err()
    {
        return $this->err;
    }

    function validateAccount($db, $uid, $pwd)
    {
        $uPwdData = $db->findPassword($uid);

        foreach ($uPwdData as $uPwd) {
            $salt = $uPwd->PassSalt;
            $hash = $uPwd->passHash;
        }
        
        return hash('SHA512', $salt . $uid . $pwd) == $hash;
    }

    function validateUser()
    {
        $this->err['fname'] = ErrorHandler::validateFname($this->fname);
        $this->err['lname'] = ErrorHandler::validateLname($this->lname);
        $this->err['dob'] = ErrorHandler::validateDob($this->dob);
        $this->err['email'] = ErrorHandler::validateEmail($this->email);
        $this->err['phoneno'] = ErrorHandler::validatePhoneno($this->phoneno);
        $this->err['pwd'] = ErrorHandler::validatePwd($this->pwd, $this->cpwd);
    }
}
