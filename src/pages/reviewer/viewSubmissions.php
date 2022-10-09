<?php
    include_once("./classes/components/card.php");
    include_once("./classes/dbAPI.class.php");

    $db = new Database();
    $submissions = $db->getAllSubmission();

?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-left h-100">
        <h1 class="display-4">Submissions</h1>
        <p class="lead">You have the power to manage all of the submissions!</p>

        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <!--SEARCH START-->
                <p class="form-group mr-2">Search by: </p>
                <div class="dropdown">
                    <select id="searchSOption" class="form-select form-select-sm" aria-label="Default select">                    
                        <option value="user-FirstName"><a class="dropdown-item" name="searchSFN" id="searchSFN" href="#">First Name</a></option>
                        <option value="user-LastName"><a class="dropdown-item" name="searchSLN" id="searchSLN" href="#">Last Name</a></option>
                        <option value="con-Title"><a class="dropdown-item" name="searchSCtitle" id="searchSCtitle" href="#">Conference Title</a></option>
                        <option value="sub-Timestamp"><a class="dropdown-item" name="searchSubDate" id="searchSubDate" href="#">Submission Date</a></option>
                        <option value="sub-Status"><a class="dropdown-item" name="searchSubStatus" id="searchSubStatus" href="#">Submission Status</a></option>
                    </select>
                </div>
                <input type="search" class="form-control form-control-sm" name="searchSParam" id="searchSParam" placeholder="Search">
            </div>
        </form>
        <hr>
        <!--SEARCH END-->

        <div class="overflow-auto vw-75 vh-25 border rounded-3 border-secondary p-4" style="height: 32rem; width: 100%">            
            
        <div id="searchSResult">          
                
                <?php

                echo Card::display('viewSubTableHeadCard'); 
                
                foreach ($submissions as $submission) {

                    $user = $db->findUserById($submission->UserId); 
                    $userFName = $user[0]->UserFirstName; 
                    $userLName = $user[0]->UserLastName; 

                    $reviewer = $db->findReviewById($submission->ReviewerId); 

                    $conference = $db->findConferenceById($submission->ConferenceId); 

                    $comments = "N/A"; 

                    if ($reviewer) {
                        $comments = $reviewer->ReviewComments; 
                    }

                    echo Card::display(
                        'viewSubmissionCard',
                        [
                            $submission->SubmissionId, 
                            $userFName, 
                            $userLName,
                            $conference[0]->ConferenceTitle, 
                            $submission->SubmissionTimestamp,
                            $submission->SubmissionStatus, 
                            $comments, 
                            $submission->SubmissionPath                            
                        ]
                    );
                }
                ?>
                </table>
            </div>
        </div>
    </div>


</div>
<!--CONTENT END-->