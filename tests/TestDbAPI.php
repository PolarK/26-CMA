<?php

declare(strict_types=1);

require_once './classes/dbAPI.class.php';

use PHPUnit\Framework\TestCase;

final class TestDbAPI extends TestCase
{
    /**
     * @dataProvider userData
     */
    public function testCreateNewUser(): void
    {
        $user = $this->userData();

        $id = $user[0](0);
        $firstName = $user[0](0);
        $lastName = $user[0](0);
        $dob = $user[0](0);
        $email = $user[0](0);
        $phone = $user[0](0);
        $role = $user[0](0);
        $active = $user[0](0);

        $this->assertTrue(
            ($this->dbAPI()->createNewUser($id, $firstName, $lastName, $dob, $email, $phone, $role, $active)) ? true : false
        );
    }
    //user id: return True
    public function testFindSpecificUserUsingUserIDAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findUserById("SRJ-TEST")) ? true : false
        );
    }

    //user id: return False
    public function testFindSpecificUserUsingUserIDUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findUserById("000-TEST")) ? true : false
        );
    }

    //first name: return True
    public function testFindSpecificUserUsingFirstNameAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findUserByFirstName("Joseph")) ? true : false
        );
    }
    //first name: return False
    public function testFindSpecificUserUsingFirstNameUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findUserByFirstName("Jackovich")) ? true : false
        );
    }

    //last name: should return True
    public function testFindSpecificUserUsingLastNameAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findUserByLastName("Rodriges")) ? true : false
        );
    }

    //last name: should return True
    public function testFindSpecificUserUsingLastNameUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findUserByLastName("Slavinavoich")) ? true : false
        );
    }

    //DOB: return True
    public function testFindSpecificUserUsingDOBAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findUserByDOB("1990-12-12")) ? true : false
        );
    }

    //DOB: return False
    public function testFindSpecificUserUsingDOBUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findUserByDOB("3090-13-32")) ? true : false
        );
    }

    //Email: return True
    public function testFindSpecificUserUsingEmailAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findUserByEmail("josephinerodriges@gmail.com")) ? true : false
        );
    }

    //Email: return False
    public function testFindSpecificUserUsingEmailUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findUserByEmail("this@email.doesnotexist")) ? true : false
        );
    }

    //PhoneNo: return True
    public function testFindSpecificUserUsingPhoneNoAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findUserByPhoneNo("0412456789")) ? true : false
        );
    }

    //PhoneNo: return False
    public function testFindSpecificUserUsingPhoneNoUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findUserByPhoneNo("0000000000")) ? true : false
        );
    }

    //Role: return True
    public function testFindSpecificUserUsingRoleAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findUserByRole("SUBMITTER")) ? true : false
        );
    }

    //Role: return False
    public function testFindSpecificUserUsingRoleUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findUserByRole("GHOST")) ? true : false
        );
    }

    /**
     * @dataProvider userData
     */
    //update user: return True
    public function testUpdateSpecificUser(): void
    {
        $id = "SRJ-TEST";
        $firstName = "Josephinia";
        $lastName = "Rodrigesia";
        $Email = "1990-12-12";
        $email = "josephiniarodrigesia@gmail.com";
        $phone = "0419987675";
        $role = "ADMIN";
        $active = 1;

        $this->assertTrue(
            ($this->dbAPI()->updateUser($id, $firstName, $lastName, $Email, $email, $phone, $role, $active)) ? true : false
        );
    }

    //updated first name: return True
    public function testFindSpecificUpdatedUserUsingUpdatedFirstName(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findUserByFirstName("Josephine")) ? true : false
        );
    }

    //old first name: return False
    public function testFindSpecificUpdatedUserUsingOldFirstName(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findUserByFirstName("Josephinia")) ? true : false
        );
    }

    /**
     * @dataProvider passwordData
     */
    //create password: return True
    public function testCreatePasswordForSpecificUser(): void
    {
        $password = $this->passwordData();

        $id = $password[0](0);
        $salt = $password[0](1);
        $pass = $password[0](2);
        $hash = hash('SHA512', $salt . $id . $pass);

        $this->assertTrue(
            ($this->dbAPI()->createPassword($id, $salt, $hash)) ? true : false
        );
    }

    //find password: return True
    public function testFindSpecificUserPassword(): void
    {
        $id = "SRJ-TEST";

        $this->assertTrue(
            ($this->dbAPI()->findPasswordById($id)) ? true : false
        );
    }

    /**
     * @dataProvider passwordData
     */
    //update password: return True
    public function testUpdateSpecificUserPassword(): void
    {
        $id = "SRJ-TEST";
        $salt = "TEST-SALT";
        $pass = "TEST-PASS-UPDATED";
        $hash = hash('SHA512', $salt . $id . $pass);

        $this->assertTrue(
            ($this->dbAPI()->updatePassword($id, $salt, $hash)) ? true : false
        );
    }

    //delete password: return True
    public function testDeleteSpecificUserPassword(): void
    {
        $id = "SRJ-TEST";
        $this->assertTrue(
            ($this->dbAPI()->deletePassword($id)) ? true : false
        );
    }

    /**
     * @dataProvider submissionData
     */
    //create Submission: return True
    public function testCreatSubmissionForSpecificUser(): void
    {
        $submission = $this->submissionData();

        $sid = $submission[0](0);
        $uid = $submission[0](1);
        $rid = $submission[0](2);
        $cid = $submission[0](3);
        $timestamp = $submission[0](4);
        $path = $submission[0](5);
        $status = $submission[0](6);

        $this->assertTrue(
            ($this->dbAPI()->createSubmission($sid, $uid, $rid, $cid, $timestamp, $path, $status)) ? true : false
        );
    }

    //submission id: return True
    public function testFindSpecificSubmissionByIdAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findSubmissionById("SUBM-TEST")) ? true : false
        );
    }

    //submission id: return False
    public function testFindSpecificSubmissionByIdUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findSubmissionById("000-TEST")) ? true : false
        );
    }

    //submission user id: return True
    public function testFindSpecificSubmissionByUserIdAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findSubmissionByUserId("SRJ-TEST")) ? true : false
        );
    }

    //submission user id: return False
    public function testFindSpecificSubmissionByUserIdUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findSubmissionByUserId("000-TEST")) ? true : false
        );
    }

    //submission conference id: return True
    public function testFindSpecificSubmissionByConferenceIdAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findSubmissionByConferenceId("SRJ-TEST")) ? true : false
        );
    }

    //submission conference id: return False
    public function testFindSpecificSubmissionByConferenceIdUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findSubmissionByConferenceId("000-TEST")) ? true : false
        );
    }

    //submission timestamp: return True
    public function testFindSpecificSubmissionByTimestampAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findSubmissionByTimestamp("01/01/1970 - 01:00:00")) ? true : false
        );
    }

    //submission timestamp: return False
    public function testFindSpecificSubmissionByTimestampUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findSubmissionByTimestamp("32/13/3090 - 25:25:61")) ? true : false
        );
    }

    //submission Status: return True
    public function testFindSpecificSubmissionByStatusAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findSubmissionByStatus("pending")) ? true : false
        );
    }

    //submission Status: return False
    public function testFindSpecificSubmissionByStatusUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findSubmissionByStatus("does not exist")) ? true : false
        );
    }

    //submission Path: return True
    public function testFindSpecificSubmissionByPathAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findSubmissionByPath("/test/pathing/to/non/existent/file")) ? true : false
        );
    }

    //submission Path: return False
    public function testFindSpecificSubmissionByPathUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findSubmissionByPath("de/nada/file")) ? true : false
        );
    }

    //submission ReviewerId: return True
    public function testFindSpecificSubmissionByReviewerIdAvailable(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->findSubmissionByReviewerId("RRJ-TEST")) ? true : false
        );
    }

    //submission ReviewerId: return False
    public function testFindSpecificSubmissionByReviewerIdUnavailable(): void
    {
        $this->assertFalse(
            ($this->dbAPI()->findSubmissionByReviewerId("000-TEST")) ? true : false
        );
    }
    //! * * * * * * * * * * * * * * * * * * * * *
    //update user: return True
    public function testUpdateSpecificSubmission(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->updateSubmission("SRJ-TEST")) ? true : false
        );
    }

    //remove user: return True
    public function testRemoveSpecificUserSubmissionById(): void
    {
        $this->assertTrue(
            ($this->dbAPI()->updateUser("SUBM-TEST")) ? true : false
        );
    }

    //should be the last item to test as we still need the user for other test cases.    
    //remove user: return True
    public function testRemoveSpecificUser(): void
    {
        $id = "SRJ-TEST";

        $this->assertTrue(
            ($this->dbAPI()->deleteUser($id)) ? true : false
        );
    }

    public function userData()
    {
        return $this->createUserStdObject(
            "SRJ-TEST",
            "Joseph",
            "Rodriges",
            "01/01/1970",
            "josephinerodriges@gmail.com",
            "0412456789",
            "SUBMITTER",
            1
        );
    }

    public function passwordData()
    {
        return $this->createPasswordStdObject(
            "SRJ-TEST",
            "TEST-SALT",
            "TEST-PASS"
        );
    }

    public function submissionData()
    {
        return $this->createSubmissionStdObject(
            "SUBM-TEST",
            "SRJ-TEST",
            "RRJ-TEST",
            "CONF-PASS",
            "01/01/1970 - 01:00:00",
            "/test/pathing/to/non/existent/file",
            "pending",
        );
    }

    public function createUserStdObject($id, $firstName, $lastName, $dob, $email, $phone, $role, $active)
    {
        $user = new stdClass();

        $user->$id = $id;
        $user->$firstName = $firstName;
        $user->$lastName = $lastName;
        $user->$dob = $dob;
        $user->$email = $email;
        $user->$phone = $phone;
        $user->$role = $role;
        $user->$active = $active;

        return $user;
    }

    public function createPasswordStdObject($id, $salt, $pass)
    {
        $password = new stdClass();

        $password->$id = $id;
        $password->$salt = $salt;
        $password->$pass = $pass;

        return $password;
    }

    public function createSubmissionStdObject($sid, $uid, $rid, $cid, $timestamp, $path, $status)
    {
        $submission = new stdClass();

        $submission->$sid;
        $submission->$uid;
        $submission->$rid;
        $submission->$cid;
        $submission->$timestamp;
        $submission->$path;
        $submission->$status;

        return $submission;
    }

    public function dbAPI(): Database
    {
        return new Database();
    }
}
