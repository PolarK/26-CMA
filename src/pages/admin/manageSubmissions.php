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

        <?php
        if (!empty($submissions)) {
        ?>
            <div style="margin: auto; width: 75%;">
                <div style="height: 600px; overflow: hidden scroll;">
                    <table id="displaySubmissions" class="table" style=" border: 2px black solid;">
                        <thead class="bg-light" style="position: sticky; top: 0;">
                            <tr>
                                <form class="form-inline">
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="searchSID" id="searchSID" placeholder="Submission ID">
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="searchName" id="searchName" placeholder="Author">
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="searchTimestamp" id="searchTimestamp" placeholder="Timestamp">
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="searchPath" id="searchPath" placeholder="File Path">
                                        </div>
                                    </th>
                                </form>
                            </tr>
                        </thead>
                        <tbody id="searchResult">
                            <?php foreach ($submissions as $submission) { ?>
                                <tr>
                                    <td><?php echo $submission->SubmissionId  ?></td>
                                    <td><?php echo $submission->UserId  ?></td>
                                    <td><?php echo $submission->SubmissionTimestamp ?></td>
                                    <td><?php echo $submission->SubmissionPath ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        <?php } else { ?>
            <div class="card card-body bg-info">
                <p class="text-center">
                    Sadly, there aren't any records to fetch.
                </p>
            </div>
        <?php } ?>
    </div>
</div>
<!--CONTENT END-->