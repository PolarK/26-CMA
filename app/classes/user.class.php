<?php

    require_once "validator.class.php";
    
    class User {

        // not too sure if user should store password as well
        private $fname, $lname, $dob, $email, $phoneno, $address, $pwd;         
    
        function __construct($fname, $lname, $dob, $email, $phoneno, $address, $pwd, $err) {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->dob = $dob;
            $this->email = $email;
            $this->phoneno = $phoneno;
            $this->address = $address;
            $this->pwd = $pwd;
            $this->err = $err;
        }

        // get and set methods
        function get_fname() { return $this->fname; }
        function set_fname($fname) { $this->fname = $fname; }

        function get_lname() { return $this->lname; }
        function set_lname($lname) { $this->lname = $lname; }

        function get_dob() { return $this->dob; }
        function set_dob($dob) { $this->dob = $dob; }

        function get_email() { return $this->email; }
        function set_email($email) { $this->email = $email; }

        function get_phoneno() { return $this->phoneno; }
        function set_phoneno($phoneno) { $this->phoneno = $phoneno; }

        function get_address() { return $this->address; }
        function set_address($address) { $this->address = $address; }

        function get_pwd() { return $this->pwd; }
        function set_pwd($pwd) { $this->pwd = $pwd; }

        function get_err() { return $this->err; }
        
        function validateUser() {
            $this->err['fname'] = Validator::validateFname($this->fname); 
            $this->err['lname'] = Validator::validateLname($this->lname); 
            $this->err['dob'] = Validator::validateDob($this->dob); 
            $this->err['email'] = Validator::validateEmail($this->email); 
            $this->err['phoneno'] = Validator::validatePhoneno($this->phoneno); 
            $this->err['address'] = Validator::validateAddress($this->address); 
            $this->err['pwd'] = Validator::validatePwd($this->pwd); 
        }

    }
?>