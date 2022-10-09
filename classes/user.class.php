<?php

require_once "dbAPI.class.php";
require_once "errorHandler.class.php";

class User
{
    // not too sure if user should store password as well
    public $fname, $lname, $dob, $email, $phoneno, $pwd;

    function __construct($fname, $lname, $dob, $email, $phoneno, $pwd, $cpwd, $err)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = $dob;
        $this->email = $email;
        $this->phoneno = $phoneno;
        $this->pwd = $pwd;
        $this->cpwd = $cpwd;
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

    function generatePassword($id, $pwd)
    {
        $salt = hash('SHA256', microtime(true) . mt_rand(1000, 9000));

        return [
            'salt' => $salt,
            'hash' => hash('SHA512', $salt . $id . $pwd)
        ];
    }

    function validateUserRegister()
    {
        $this->err['fname'] = ErrorHandler::validateFname($this->fname);
        $this->err['lname'] = ErrorHandler::validateLname($this->lname);
        $this->err['dob'] = ErrorHandler::validateDob($this->dob);
        $this->err['email'] = ErrorHandler::validateEmail($this->email);
        $this->err['phoneno'] = ErrorHandler::validatePhoneno($this->phoneno);
        $this->err['pwd'] = ErrorHandler::validatePwd($this->pwd, $this->cpwd);
    }

    function validateUserUpdate()
    {
        $this->err['fname'] = ErrorHandler::validateFname($this->fname);
        $this->err['lname'] = ErrorHandler::validateLname($this->lname);
        $this->err['dob'] = ErrorHandler::validateDob($this->dob);
        $this->err['phoneno'] = ErrorHandler::validatePhoneno($this->phoneno);
        $this->err['pwd'] = ErrorHandler::validatePwd($this->pwd, $this->cpwd);
    }

    function validateAdminCreateUser()
    {
        $this->err['fname'] = ErrorHandler::validateFname($this->fname);
        $this->err['lname'] = ErrorHandler::validateLname($this->lname);
        $this->err['email'] = ErrorHandler::validateEmail($this->email);
    }
}
