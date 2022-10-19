<?php

declare(strict_types=1);

require_once "./classes/errorHandler.class.php";

use PHPUnit\Framework\TestCase;

final class TestErrorHandler extends TestCase
{
    // NOTE: any function with "testValid" will always return null from error handler and not a true/false
    public function testIncorrectFName() : void
    {
        // Empty First Name
        $err1 = "Please enter your first name";
        $actual1 = ErrorHandler::validateFname("");
        $this->assertStringMatchesFormat($err1, $actual1);

        // Invalid First Name
        $err2 = "Please enter a valid first name";
        $actual2 = ErrorHandler::validateFname("<script>alert(1)</script>");
        $this->assertStringMatchesFormat($err2, $actual2);        
    }
    
    public function testValidFName() : void
    {
        $this->assertNull(ErrorHandler::validateFname("joe"));
    }

    public function testIncorrectLName() : void
    {
        // Empty Last Name
        $err1 = "Please enter your last name";
        $actual1 = ErrorHandler::validateLname("");
        $this->assertStringMatchesFormat($err1, $actual1);

        // Invalid Last Name
        $err2 = "Please enter a valid last name";
        $actual2 = ErrorHandler::validateLname("956783!@@!#");
        $this->assertStringMatchesFormat($err2, $actual2);
    }
    
    public function testValidLName() : void
    {
        $this->assertNull(ErrorHandler::validateLname("anderson"));
    }
    
    public function testIncorrectDOB() : void
    {
        $err = "Please enter your date of birth";
        $actual = ErrorHandler::validateDob("");
        $this->assertStringMatchesFormat($err, $actual);
    }
    
    public function testValidDOB() : void
    {
        // Error handler doesnt actually check isValid on dob
        $this->assertNull(ErrorHandler::validateDob("12/12/1212"));
    }

    public function testEmailEmpty() : void
    {
        $expected = "Please enter your email address";
        $actual = ErrorHandler::validateEmail("");

        $this->assertStringMatchesFormat($expected, $actual);
    }

    public function testEmailInvalid() : void
    {
        $expected = "Please enter a valid email address";
        $actual = ErrorHandler::validateEmail("thiswilltotallywork");

        $this->assertStringMatchesFormat($expected, $actual);
    }
    
    public function testIncorrectPhone() : void
    {
        // Empty Phone No
        $err1 = "Please enter your phone number";
        $actual1 = ErrorHandler::validatePhoneno("");
        $this->assertStringMatchesFormat($err1, $actual1);

        // Invalid Phone No
        $err2 = "Please enter a valid phone number";
        $actual2 = ErrorHandler::validatePhoneno("totallyvalidnumber");
        $this->assertStringMatchesFormat($err2, $actual2);

    }
    
    public function testValidPhone() : void
    {
        $this->assertNull(ErrorHandler::validatePhoneno("0412345678"));
    }

    public function testIncorrectPass() : void
    {
        // Empty Password
        $err1 = "Please enter a password";
        $actual1 = ErrorHandler::validatePwd("", "doesntmatter");
        $this->assertStringMatchesFormat($err1, $actual1);

        // Invalid Password
        $err2 = "Please enter a valid password";
        $actual2 = ErrorHandler::validatePwd("p,.()", "p,.()");
        $this->assertStringMatchesFormat($err2, $actual2);

        // Unmatched Password
        $err3 = "Both password need to match";
        $actual3 = ErrorHandler::validatePwd("pa55w0rd!","password!");
        $this->assertStringMatchesFormat($err3, $actual3);
    }

    public function testValidPass() : void
    {
        $this->assertNull(ErrorHandler::validatePwd("Qw3rty@123","Qw3rty@123"));
    }

    public function testIncorrectConferenceTitle() : void
    {
        // Empty Conference Title
        $err1 = "Please enter a conference title";
        $actual1 = ErrorHandler::validatecTitle("");
        $this->assertStringMatchesFormat($err1, $actual1);

        // Exisiting Conference Title
        $err2 = "This conference title has already been used. Please enter a different title. ";
        $actual1 = ErrorHandler::validatecTitle("Testing Conference #1");
    }

    public function testValidConferenceTitle() : void
    {
        $this->assertNull(ErrorHandler::validatecTitle("Title That Isnt Used"));
    }

    public function testUpdateConferenceTitle() : void
    {
        // Empty Conference Title
        $err = "Please enter a conference title";
        $actual = ErrorHandler::validatecTitleUpdate("");
        $this->assertStringMatchesFormat($err, $actual);

        // Valid Conference Title
        $this->assertNull(ErrorHandler::validatecTitleUpdate("New ConferenceTitle"));
    }

    public function testConferenceLocation() : void
    {
        // Empty Location
        // There isnt much validation for whats there
        $err = "Please enter a conference location/link";
        $actual = ErrorHandler::validatecLocation("");
        $this->assertStringMatchesFormat($err, $actual);

        // Valid location
        $this->assertNull(ErrorHandler::validatecLocation("https://www.youtube.com/watch?v=dQw4w9WgXcQ"));
    }
}

?>