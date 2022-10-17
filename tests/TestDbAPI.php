<?php

declare(strict_types=1);

require_once './classes/dbAPI.class.php';

use PHPUnit\Framework\TestCase;

final class TestDbAPI extends TestCase
{
    public function testCreateNewUser() : void
    {
        $id = "SRJ-TEST";
        $firstName = "Josephine";
        $lastName = "Rodriges";
        $dob = "01-01-1970";
        $email = "josephinerodriges@gmail.com";
        $phone = "0412456789";
        $role = "SUBMITTER";

        $this->assertTrue(
            ($this->dbAPI()->createNewUser($id, $firstName, $lastName, $dob, $email, $phone, $role)) ? true : false
        );
    }

    public function testFindSpecificUserUsingFirstNameAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findUserByFirstName("Josephine"))? true : false
        );
    }

    public function testFindSpecificUserUsingFirstNameUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findUserByFirstName("Jackovich"))? true : false
        );
    }

    public function testRemoveSpecificUser() {
        $id = "SRJ-TEST";
        
        $this->assertTrue(
            ($this->dbAPI()->deleteUser($id)) ? true : false
        );
    }

    public function dbAPI(): Database
    {
        return new Database();
    }
}
