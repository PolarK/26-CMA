<?php

declare(strict_types=1);

require_once './classes/dbAPI.class.php';
require_once './classes/idGenerator.class.php';

use PHPUnit\Framework\TestCase;

final class TestReviewDbApi extends TestCase
{
    // commented to avoid creating review each time; uncomment if needed
    /*public function testCreateReview(): void
    {
        $id = IDGenerator::review();
        $subId = "012345aa_SCS0c6d2"; 
        $timestamp = date('Y-m-d H:i:s');
        $comments = "Test_Review"; 
        $status = "Success"; 
        
        $review = $this->createReviewStdObject($id, $subId, $timestamp, $comments, $status); 

        $this->dbAPI()->createReview($id, $subId, $timestamp, $comments, $status); 

        $this->assertEquals(
            $this->dbAPI()->findReviewById($id)[0], $review
        );
    }*/   

    public function testUpdateReview()
    {
        $review = $this->dbAPI()->findReviewById("14932eae"); 

        $review[0]->ReviewComments = "Not too bad"; 
        $review[0]->ReviewTimestamp = date('Y-m-d H:i:s'); 
    
        $this->dbAPI()->updateReview("14932eae", 
                                    $review[0]->SubmissionId, 
                                    $review[0]->ReviewTimestamp, 
                                    $review[0]->ReviewComments, 
                                    $review[0]->ReviewStatus); 
        $this->assertEquals(
            $this->dbAPI()->findReviewById("14932eae")[0], $review[0]
        );
    }


     /**
     * @dataProvider reviewIdData
     */
    public function testFindReviewById($id, $index) {
        $reviews = $this->reviewData(); 
        $this->assertEquals(
            $this->dbAPI()->findReviewById($id)[0], $reviews[$index]
        );
    }

    // id data used for testing
    public function reviewIdData()
    {
        // 0 and 1 are indexes for review 1 and 2 in review data
        return [
            ["5f8a53e6", 0],
            ["47ce0db2", 1],
        ];
    }


     /**
     * @dataProvider reviewSubIdData
     */
    public function testFindReviewBySubmissionId($subId, $index) {
        $reviews = $this->reviewData(); 
        $this->assertEquals(
            $this->dbAPI()->findReviewBySubmissionId($subId)[0], $reviews[$index]
        );
    }

    // sub id data used for testing
    public function reviewSubIdData()
    {
        // 0 and 1 are indexes for review 1 and 2 in review data
        return [
            ["5ce443b2_SAH356ba", 0],
            ["93aef826_SCS0c6d2", 1],
        ];
    }


    // review data used for testing
    public function reviewData()
    {
        $r1 = $this->createReviewStdObject("5f8a53e6", "5ce443b2_SAH356ba", "2022-10-19 03:50:38", "Test_Review", "Success"); 

        $r2 = $this->createReviewStdObject("47ce0db2", "93aef826_SCS0c6d2", "2022-10-12 07:29:25", "This looks very VERY intresting!", "Fail");         
        
        return [$r1, $r2];
    }

    public function createReviewStdObject($id, $subId, $timestamp, $comments, $status) {
        $review = new stdClass; 
        $review->ReviewId = $id; 
        $review->SubmissionId = $subId;
        $review->ReviewTimestamp = $timestamp;
        $review->ReviewComments = $comments;
        $review->ReviewStatus = $status;
        return $review; 
    }
 
    public function dbAPI(): Database
    {
        return new Database();
    }
}
