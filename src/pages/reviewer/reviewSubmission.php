<?php 

    // works only on pdf files 
    
    require "./classes/dbAPI.class.php";
    require_once "./classes/validator.class.php";
    require_once "./classes/idGenerator.class.php";
    include_once "./submission.php"; 

    function getFilePath($uId) {

        $filename = $_GET["filepath"]; 

        $folder_path = dirname(__DIR__, 1) . "/submitter/submissions/" . $uId;

        if (!file_exists($folder_path)) {          // create user file if it does not exist
            mkdir($folder_path, 0777, true);
        }      
        
        getFile($uId, $filename, $folder_path);        

        $tempPath = "https://" . $_SERVER['SERVER_NAME'] . "/src/pages/submitter/submissions/" . $uId . "/" . rawurlencode($filename); 

        return $tempPath;; 
    }


    $db = new Database(); 
    $err = ["comment" => "", "status" => ""];   
    $prefillValues = ["comment" => "", "status" => ""]; 
    $buttonState = "Submit"; 

    $submission = $db->findSubmissionById($_GET["rSubId"]); 
    
    if (count($submission) == 1) {

        $subId = $submission[0]->SubmissionId; 
        $uId = $submission[0]->UserId; 

        $tempPath = getFilePath($uId); 

        $review = $db->findReviewBySubmissionId($subId); 

        if ($review) {
            $prefillValues["comment"] = $review[0]->ReviewComments; 
            $prefillValues["status"] = $review[0]->ReviewStatus; 
            $buttonState = "Update Review"; 
        }

        
        if (isset($_POST['submitReview'])) {    
    
            if (empty($_POST['rComment'])) {
                $err["comment"] = "*Please provide some feedback";
            }
            if (empty($_POST["rStatus"])) {
                $err["status"] = "*Please select an option";
            }
            
            if (Validator::validate($err)) {
                $comment = Validator::sanitise($_POST['rComment']);
                $status = Validator::sanitise($_POST["rStatus"]);
                
                $timestamp = date('Y-m-d h:i:s'); 
                
                if ($review) {                    
                    $db->updateReview(
                        $review[0]->ReviewId, 
                        $subId, 
                        $timestamp, 
                        $comment, 
                        $status
                    ); 
                }
                else {
                    $id = IDGenerator::review(); 
                    $db->createReview(
                        $id, 
                        $subId, 
                        $timestamp, 
                        $comment, 
                        $status
                    );
                    
                    $db->updateSubmission(
                        $subId,         
                        $submission[0]->UserId,
                        $submission[0]->ReviewerId, 
                        $submission[0]->ConferenceId, 
                        $submission[0]->SubmissionTimestamp, 
                        $submission[0]->SubmissionPath, 
                        "Reviewed"
                    ); 
                } 
                // redirect to successful review screen
                header('Location: /dashboard');
            }
        }
        
?>

<div class="container-fluid" style="width:100%">
  <div class="row vh-100 mb-5">
    <div class="col-sm-6 col-md-8 border bg-light embed-responsive embed-responsive-21by9">
        <iframe class="p-3 embed-responsive-item" src= "<?php echo $tempPath; ?>"></iframe>
    </div>
    <div class="col-6 col-md-4 border">
        <form id="reviewForm" action="#" method="post">
            <div class="form-group p-3 d-grid gap-2">
                <label for="rComment">Comments <small class="text-danger ps-3"><?php echo $err["comment"] ?></small></label>  
                                      
                <textarea id="rComment" name="rComment" placeholder="Comments" rows="6"  class="form-control"><?php echo $prefillValues["comment"] ?></textarea>
            </div>     
            <div class="form-group p-3">
                <label for="rStatus" class="pe-3">Evaluation</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rStatus" id="rAccept" value="Success" <?php echo ($prefillValues["status"] == "Success")? "checked = 'checked'" : ""; ?>>
                    <label class="form-check-label" for="rAccept">
                        Accept
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rStatus" id="rReject" value="Fail" <?php echo ($prefillValues["status"] == "Fail")? "checked = 'checked'" : ""; ?>>
                    <label class="form-check-label" for="rReject">
                        Reject
                    </label>
                </div>
                <small class="text-danger ps-3"><?php echo $err["status"] ?></small>
            </div>       
            <div class="form-group p-3 btn-group-md d-grid gap-2">
                <button name="submitReview" type="submit" class="btn btn-primary"><?php echo $buttonState; ?></button>
            </div>
        </form>
    </div>
  </div>
</div>

<?php

    }
    else {
        http_response_code(404);
        require $publicPath . './errors/404.php';
    } 

?>