<?php
include_once("./classes/components/card.php");
include_once("./classes/dbAPI.class.php");

$db = new Database();
$submissions = $db->getAllSubmission();

?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
        <h1 class="display-4">User Submissions</h1>

        <?php
        if (!empty($submissions)) {
        ?>
            <div style="margin: auto; width: 75%;">
                <div style="height: 600px; overflow: hidden scroll;">
                    <table id="rViewSubmissions" class="table" style=" border: 2px black solid;">
                        <thead class="bg-light" style="position: sticky; top: 0;">
                            <tr>
                                <form class="form-inline">
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="rSearchCID" id="rSearchCID" placeholder="Conference ID">
                                        </div>                                        
                                    </th>    
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="rSearchUID" id="rSearchUID" placeholder="User ID">
                                        </div>
                                    </th> 
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="rSearchUFName" id="rSearchUFName" placeholder="User First Name">
                                        </div>
                                    </th> 
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="rSearchULName" id="rSearchULName" placeholder="User Last Name">
                                        </div>
                                    </th> 
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="rSearchSubTime" id="rSearchSubTime" placeholder="Submission Time">
                                        </div>
                                    </th> 
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="rSearchSubStatus" id="rSearchSubStatus" placeholder="Submission Status">
                                        </div>
                                    </th> 
                                    <th scope="row"></th> 
                                </form>
                            </tr>
                        </thead>
                        <tbody id="rSearchResult">
                            <?php foreach ($submissions as $submission) { 
                                $user = $db->findUserById($submission->UserId); 
                                $userFName = $user[0]->UserFirstName; 
                                $userLName = $user[0]->UserLastName; 
                            ?>
                            <tr>
                                <td><?php echo $submission->ConferenceId  ?></td>
                                <td><?php echo $submission->UserId  ?></td>
                                <td><?php echo $userFName  ?></td>
                                <td><?php echo $userLName  ?></td>
                                <td><?php echo $submission->SubmissionTimestamp  ?></td>
                                <td><?php echo $submission->SubmissionStatus  ?></td>
                                <td><a href= "<?php echo './reviewSubmission?filepath=' . $submission->SubmissionPath . '&rSubId=' . $submission->SubmissionId ?>">Review</a></td>
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