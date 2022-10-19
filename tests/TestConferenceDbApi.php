<?php

declare(strict_types=1);

require_once './classes/dbAPI.class.php';
require_once './classes/idGenerator.class.php';

use PHPUnit\Framework\TestCase;

final class TestConferenceDbApi extends TestCase
{
    // commented to avoid creating conference each time; uncomment if needed
    /*public function testCreateConference(): void
    {
        $id = IDGenerator::conference();
        $title = "Test_title"; 
        $sTStmp = date('Y-m-d H:i:s'); 
        $eTStmp = date('Y-m-d H:i:s');
        $location = "Test_location"; 
        $status = "1"; 

        $conference = $this->createConferenceStdObject($id, $title, $sTStmp, $eTStmp, $location, $status); 
        
        $this->dbAPI()->createConference($id, $title, $sTStmp, $eTStmp, $location, $status); 

        $this->assertEquals(
            $this->dbAPI()->findConferenceById($id)[0], $conference
        );
    }*/

    public function testUpdateConference()
    {
        $conference = $this->dbAPI()->findConferenceById("012345aa"); 

        $conference[0]->ConferenceTitle = "Test Conference #7"; 
        $conference[0]->ConferenceStartTimestamp = date('Y-m-d H:i:s'); 
        $conference[0]->ConferenceEndTimestamp = date('Y-m-d H:i:s'); 

        $this->dbAPI()->updateConference("012345aa", 
                                         $conference[0]->ConferenceTitle, 
                                         $conference[0]->ConferenceStartTimestamp, 
                                         $conference[0]->ConferenceEndTimestamp, 
                                         $conference[0]->ConferenceLocation, 
                                         $conference[0]->ConferenceStatus); 
        $this->assertEquals(
            $this->dbAPI()->findConferenceById("012345aa")[0], $conference[0]
        );
    }


    /**
     * @dataProvider conferenceIdData
     */
    public function testFindConferenceById($id, $index) {
        $conferences = $this->conferenceData(); 
        $this->assertEquals(
            $this->dbAPI()->findConferenceById($id)[0], $conferences[$index]
        );
    }

    // id data used for testing
    public function conferenceIdData()
    {
        // 0 and 1 are indexes for conference 1 and 2 in conference data
        return [
            ["5ce443b2", 0],
            ["93aef826", 1],
        ];
    }



    /**
     * @dataProvider conferenceTitleData
     */
    public function testFindConferenceByTitle($title, $index) {
        $conferences = $this->conferenceData(); 
        $this->assertEquals(
            $this->dbAPI()->findConferenceByTitle($title)[0], $conferences[$index]
        );
    }

    // title data used for testing
    public function conferenceTitleData()
    {
        // 0 and 1 are indexes for conference 1 and 2 in conference data
        return [
            ["Test Conference #3", 0],
            ["IT Conference", 1],
        ];
    }


     /**
     * @dataProvider conferenceSTStmpData
     */
    public function testFindConferenceBySTStmp($tStmp, $index) {
        $conferences = $this->conferenceData(); 
        $this->assertEquals(
            $this->dbAPI()->findConferenceByStartTimestamp($tStmp)[0], $conferences[$index]
        );
    }

    // Start Timestamp data used for testing
    public function conferenceSTStmpData()
    {
        // 0 and 1 are indexes for conference 1 and 2 in conference data
        return [
            ["2022-10-28 17:10:00", 0],
            ["2022-10-13 15:09:00", 1],
        ];
    }



     /**
     * @dataProvider conferenceETStmpData
     */
    public function testFindConferenceByETStmp($tStmp, $index) {
        $conferences = $this->conferenceData(); 
        $this->assertEquals(
            $this->dbAPI()->findConferenceByEndTimestamp($tStmp)[0], $conferences[$index]
        );
    }

    // End Timestamp data used for testing
    public function conferenceETStmpData()
    {
        // 0 and 1 are indexes for conference 1 and 2 in conference data
        return [
            ["2022-10-28 17:11:00", 0],
            ["2022-10-16 15:57:00", 1],
        ];
    }



     /**
     * @dataProvider conferenceLocationData
     */
    public function testFindConferenceByLocation($location, $index) {
        $conferences = $this->conferenceData(); 
        $this->assertEquals(
            $this->dbAPI()->findConferenceByLocation($location)[0], $conferences[$index]
        );
    }

    // location data used for testing
    public function conferenceLocationData()
    {
        // 0 and 1 are indexes for conference 1 and 2 in conference data
        return [
            ["https://phppot.com/php/how-to-upload-files-to-google-drive-with-api-using-php/", 0],
            ["Melbourne", 1],
        ];
    }


     /**
     * @dataProvider conferenceStatusData
     */
    public function testFindConferenceByStatus($status, $index) {
        $testConferenceData = $this->conferenceData(); 
        $conferences = $this->dbAPI()->findConferenceByStatus($status);

        $this->assertTrue(
            $this->findConferenceInArray($conferences, $testConferenceData[$index])
        );
    }

    public function findConferenceInArray($conferences, $testConference) {
        foreach ($conferences as $c) {
            if ($c == $testConference) {
              return TRUE;
            }
        }
        return FALSE;
    }

    // status data used for testing
    public function conferenceStatusData()
    {
        // 0 and 1 are indexes for conference 1 and 2 in conference data
        return [
            [1, 0],
            [0, 1],
        ];
    }


    // conference data used for testing
    public function conferenceData()
    {
        $c1 = $this->createConferenceStdObject("5ce443b2", "Test Conference #3", "2022-10-28 17:10:00", "2022-10-28 17:11:00", "https://phppot.com/php/how-to-upload-files-to-google-drive-with-api-using-php/", 1); 

        $c2 = $this->createConferenceStdObject("93aef826", "IT Conference", "2022-10-13 15:09:00", "2022-10-16 15:57:00", "Melbourne", 0);         
        
        return [$c1, $c2];
    }

    public function createConferenceStdObject($id, $title, $sTStmp, $eTStmp, $location, $status) {
        $conference = new stdClass; 
        $conference->ConferenceId = $id; 
        $conference->ConferenceTitle = $title;
        $conference->ConferenceStartTimestamp = $sTStmp;
        $conference->ConferenceEndTimestamp = $eTStmp;
        $conference->ConferenceLocation = $location;
        $conference->ConferenceStatus = $status;   

        return $conference; 
    }
 
    public function dbAPI(): Database
    {
        return new Database();
    }
}
