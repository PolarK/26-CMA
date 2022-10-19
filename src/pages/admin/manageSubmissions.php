<?php
//! UNUSED FEATURE / FOR FUTURE DEVELOPMENT

include_once("./classes/components/card.php");
include_once("./classes/dbAPI.class.php");

$db = new Database();
$submissions = $db->getAllSubmission();
?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100 mb-5">
        <h1 class="display-4">Manage User Submissions</h1>
        <p class="lead">You have the power to manage user's submissions!</p>

        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <!--SEARCH START-->
                <p class="form-group mr-2">Search by: </p>
                <div class="dropdown">
                    <select id="searchOption" class="form-select form-select-sm" aria-label="Default select">
                        <option value="FirstName"><a class="dropdown-item" name="searchAuthFName" id="searchAuthFName" href="#">Author's First Name</a></option>
                        <option value="LastName"><a class="dropdown-item" name="searchAuthLName" id="searchAuthLName" href="#">Author's Last Name</a></option>
                        <option value="Timestamp"><a class="dropdown-item" name="searchDate" id="searchDate" href="#">Date</a></option>
                        <option value="Path"><a class="dropdown-item" name="searchFile" id="searchFile" href="#">File Name</a></option>
                    </select>
                </div>
                <input type="input" class="form-control form-control-sm" name="searchSubmissionParam" id="searchSubmissionParam" placeholder="Search" onkeydown="return (event.keyCode!=13);">
            </div>
        </form>
        <hr>
        <!--SEARCH END-->

        <div class="overflow-auto vw-75 vh-25 border rounded-3 border-secondary p-4" style="height: 32rem; width: 64rem">
            <div id="searchResult">
                <?php
                if (true) {
                
                    foreach ($submissions as $submission) {
                        $users = $db->findUserById($submission->UserId);
                        //$reviewers = $db->findUserByRole('REVIEWER');
                        $reviewers = $db->findUserById($submission->ReviewerId);
                        $conference = $db->findConferenceById($submission->ConferenceId);
                
                        echo Card::display(
                            'manageSubmissionCard',
                            [
                                $submission->SubmissionId,
                                $users[0]->UserFirstName,
                                $users[0]->UserLastName,
                                $submission->SubmissionStatus,
                                $submission->SubmissionTimestamp,
                                $conference[0]->ConferenceLocation,
                                $reviewers,
                                $submission->SubmissionPath,
                            ]
                        );
                    }
                } else {
                    echo '
                    <div class="card">
                        <p class="text-center text-info"> We are currently working on getting this features up and running.</p>
                    </div>';
                }

                ?>
            </div>
        </div>
    </div>


</div>
<!--CONTENT END-->