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
                <input type="input" class="form-control form-control-sm" name="searchSubmissionParam" id="searchSubmissionParam" placeholder="Search" onkeydown="return (event.keyCode!=13);">>
            </div>
        </form>
        <hr>
        <!--SEARCH END-->

        <div class="overflow-auto vw-75 vh-25 border rounded-3 border-secondary p-4" style="height: 32rem; width: 64rem">
            <div id="searchResult">





            <!--DISPLAY DATA START-->
        <div class="card bg-light border-dark ml-2 mr-2 mt-1">
            <div class="badge text-dark border-bottom border-dark ' .  self::defineStatus($status) . '">
                <div class="row ml-1 mr-1 ">
                    <div class="col border-end m-1">
                        <p id="sID-' . $id . '" name="sID-' . $id . '">' . $id . '</p>
                    </div>
                    <div id="box-edit-' . $id . '" class="col border-end">
                        <button id="edit-' . $id . '" type="button" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i> EDIT
                        </button>
                    </div>
                    <div id="box-disable-' . $id . '" class="col border-end">
                        <button id="disable-' . $id . '" type="button" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i> DELETE
                        </button>
                    </div>
                    <div class="col m-1">
                        <p id="sStatus-' . $id . '" name="sStatus-' . $id . '">' . $status . '</p>

                    </div>
                </div>
            </div>
            <fieldset id="field-edit-' . $id . '" disabled>
                <form class="form-inline">
                    <div class="card-body align-items-left align-text-left p-1">
                        <div class="row ml-1 mr-1">
                            <div class="col border-end border-dark">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <select class="form-select form-select-sm" id="authors-' . $id . '" aria-label="Default select">
                                    '; 
                                    //foreach($user in $users){
                                    //    $card += '<option value="' . $user->UserFirstName . ' ' . $user->UserLastName . '">' . $user->UserFirstName . ' ' . $user->UserLastName . '</option>';
                                    //}
                                    $card += '
                                        </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input id="sTimestamp-' . $id . '" name="sTimestamp-' . $id . '" type="text" class="form-control" value="' . $timestamp . '">
                                </div>
                            </div>
                        </div>
                        <div class="row ml-1 mr-1">
                            <div class="col border-end border-dark">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                    </div>
                                    <input id="sConLocation-' . $id . '" name="sConLocation-' . $id . '" type="text" class="form-control" value="' . $location . '">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-id-badge"></i>
                                        </div>
                                    </div>
                                    <select class="form-select form-select-sm" id="reviewers-' . $id . '" aria-label="Default select">
                                        <option value="' . $user->UserFirstName . ' ' . $user->UserLastName . '">' . $user->UserFirstName . ' ' . $user->UserLastName . '</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row ml-1 mr-1">
                            <div class="col">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-file"></i>
                                        </div>
                                    </div>
                                    <input id="sPath-' . $id . '" name="sPath-' . $id . '" type="text" class="form-control" value="' . $filePath . '">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
        <!--DISPLAY DATA END-->';



                <?php
                if (true) {

                    foreach ($submissions as $submission) {
                        $users = $db->findUserById($submission->UserId);
                        $reviewers = $db->findUserByRole('REVIEWER');
                        $conference = $db->findConferenceById($submission->ConferenceId);

                        echo Card::display(
                            'manageSubmissionCard',
                            [
                                $submission->SubmissionId,
                                $users,
                                $submission->SubmissionStatus,
                                $submission->SubmissionTimestamp,
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