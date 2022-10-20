<?php

declare(strict_types=1);

require_once './classes/dbAPI.class.php';
require_once "./classes/user.class.php";

use PHPUnit\Framework\TestCase;

final class TestUserClass extends TestCase
{
    // public function createUserStdObject($id, $firstName, $lastName, $dob, $email, $phone, $role, $active)
    // {
    //     $user = new stdClass();

    //     $user->$id = $id;
    //     $user->$firstName = $firstName;
    //     $user->$lastName = $lastName;
    //     $user->$dob = $dob;
    //     $user->$email = $email;
    //     $user->$phone = $phone;
    //     $user->$role = $role;
    //     $user->$active = $active;

    //     return $user;
    // }

    // public function userData()
    // {
    //     return $this->createUserStdObject(
    //         "LALA-TEST",
    //         "Lala",
    //         "Popo",
    //         "01/01/1970",
    //         "lalapopo@gmail.com",
    //         "0412456789",
    //         "REVIEWER",
    //         1);
    // }


    // Tests for perfect inputs
    public function testUserRegisterIsValid() : void
    {

        $id = "LALA-TEST";
        $firstName = "Lala";
        $lastName = "Popo";
        $dob = "01/01/1970";
        $email = "lalapopo@gmail.com";
        $phone = "0412456789";
        $role = "REVIEWER";
        $active = 1;
        $pwd = "Qw3rty@123";

        $this->dbAPI()->createNewUser($id, $firstName, $lastName, $dob, $email, $phone, $role, $active);
        $this->validateUserRegister();
        assertNull($this->$err);
    }
    
    public function testUserUpdateIsValid() : void
    {
        $this->dbAPI()->updateUser($id, $firstName, "Pipi", $dob, "lalapipi@gmail.com", $phone, $role, $active);
        $this->validateUserUpdate();
        assertNull($this->$err);
    }
    
    public function testAdminCreateUserIsValid() : void
    {
        $this->dbAPI()->createNewUser("bob20", "Bob", "Popo", "1974-03-18", "bob@po.com", "0401020202", "REVIEWER", 1);
        $this->validateAdminCreateUser();
        assertNull($this->$err);
    }

    // Test if Generate password works correctly (Pretty sure it's wrong the salt will be diff how do i access the same salt??)
    public function testGeneratePasswordIsValid() : void
    {
        $salt = hash('SHA256', microtime(true) . mt_rand(1000, 9000));

        $testpwd = [
            'salt' => $salt,
            'hash' => hash('SHA512', $salt . $id . $pwd)
        ];
        
        $actualpwd = $this->dbAPI()->generatePassword($id, $pwd);

        AssertEqual($testpwd, $actualpwd);
    }
    
    
    // Test with 1 wrong input to make sure class functions work
    public function testUserRegisterIsInvalid() : void
    {
        $this->dbAPI()->createNewUser("LALI-TEST", "La92041+", $lastName, $dob, "lalipopo@gmail.com", "0401010101", $role, $active);
        $this->validateUserRegister();
        $this->assertStringMatchesFormat($err1, $this->$err);
    }

    public function testUserUpdateIsInvalid() : void
    {
        $this->dbAPI()->createNewUser($id, "La92041+", $lastName, $dob, $email, $phone, $role, $active);
        $this->validateUserUpdate();
        $err1 = "Please enter a valid first name";
        $this->assertStringMatchesFormat($err1, $this->$err);
    }

    public function testAdminCreateUserIsInvalid() : void
    {
        $this->dbAPI()->createNewUser("bob20", "Bd21490ob", "Popo", "1974-03-18", "bob@po.com", "0401020202", "REVIEWER", 1);
        $this->validateAdminCreateUser();
        $err1 = "Please enter a valid first name";
        $this->assertStringMatchesFormat($err1, $this->$err);    
    }

    // Test if Generate password works correctly (Pretty sure it's wrong the salt will be diff how do i access the same salt??)
    public function testGeneratePasswordIsInvalid() : void
    {
        $salt = hash('SHA256', microtime(true) . mt_rand(1000, 9000));
        $pwd = "diff@Pass123";
        $testpwd = [
            'salt' => $salt,
            'hash' => hash('SHA512', $salt . $id . $pwd)
        ];
        
        $actualpwd = $this->dbAPI()->generatePassword($id, $pwd);

        AssertEqual($testpwd, $actualpwd);
    }
}

?>