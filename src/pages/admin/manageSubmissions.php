<?php
include_once("./classes/components/card.php");
include_once("./classes/dbAPI.class.php");

$db = new Database();
$submissions = $db->getAllSubmission();
?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-left h-100">
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
                        <option value="File"><a class="dropdown-item" name="searchFile" id="searchFile" href="#">File Name</a></option>
                    </select>
                </div>
                <input type="search" class="form-control form-control-sm" name="searchParam" id="searchParam" placeholder="Search">
            </div>
        </form>
        <hr>
        <!--SEARCH END-->

        <div class="overflow-auto vw-75 vh-25 border rounded-3 border-secondary p-4" style="height: 32rem; width: 64rem">
            <div id="searchResult">

                <?php
                foreach ($submissions as $submission) {
                    $user = $db->findUserById($submission->UserId);
                    $conference = $db->findConferenceById($submission->ConferenceId);

                    echo Card::display(
                        'manageSubmissionCard',
                        [
                            $submission->SubmissionId,
                            $user[0]->UserFirstName,
                            $user[0]->UserLastName,
                            $submission->SubmissionStatus,
                            $submission->SubmissionTimestamp,
                            $conference[0]->ConferenceLocation,
                            "Anee Janee", // need to linked 'reviewer's ID'
                            $submission->SubmissionPath,
                        ]
                    );
                }
                ?>
            </div>
        </div>
    </div>


</div>
<!--CONTENT END-->