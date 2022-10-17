<?php
require "./classes/dbAPI.class.php";
require_once "./classes/components/toast.php";
include_once "./submission.php"; 

$db = new Database();

$event = $db->findConferenceById($_GET["eventid"]); 
$cid = $event[0]->ConferenceId; 
$cTitle = $event[0]->ConferenceTitle; 
$userid = $_SESSION["UID"]; 

$isValid = false; 

if ($event) {

    $err_msgs = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (in_array('.', $err_msgs) == FALSE) {
            if (isset($_FILES['SubmitPaper']['name'])) {

                $size = $_FILES['SubmitPaper']['size'];

                if ($size > 5242880) {
                    echo Toast::errorToast("The size of the file must be less than 5 MB");
                    $isValid = false; 
                }
                else {
                    $isValid = true; 

                    $filename = $cid . "-" . $cTitle . ".pdf";      //filename = ConferenceId + ConferenceTitle

                    uploadFile($userid, $filename, $_FILES['SubmitPaper']['tmp_name']); 
                
                    $submissionid = $cid . "_" . $userid; 
                    $timestamp = date('Y-m-d h:i:s');
                    $status = "Not Reviewed"; 
                    $submission = $db->findSubmissionById($submissionid); 
                    
                    if ($submission) {

                        $db->updateSubmission(
                            $submissionid,          
                            $userid,
                            $submission[0]->ReviewerId,
                            $cid, 
                            $timestamp, 
                            $filename, 
                            $status
                        ); 
                    }
                    else {     
                        
                        $rids = $db->findUserByRole('REVIEWER');
                        $rid = $rids[array_rand($rids)]->UserId;

                        $db->createSubmission(
                            $submissionid,         
                            $userid,
                            $rid,
                            $cid,
                            $timestamp, 
                            $filename, 
                            $status
                        ); 
                    }                       
                    
                } 

                // needs to redirect to successful submission screen
                //header('Location: /dashboard');       
            }
        }
    }

?>

<div id="sub_content" class="container-fluid p-5">

    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center text-center h-100 mb-5">
        <div class="card-body">
            <h1 class="display-4">Submit Your New Finding!</h1>
            <p class="lead">We would love to see what you've come up with! So why not submit your paper here and well review it ASAP!</p>
            <div style="margin: auto; width: <?php echo (!Mobile::isActive()? '36rem' : '100%') ?>;">
                <br>
                <!--Start Event Register Form-->
                <form id="SubmitPaperForm" action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-2 mr-2">
                        <div class="row">
                            <!-- Submit Paper -->
                            <div class="col">
                                <div class="form-group">
                                    <input id="SubmitPaper" name="SubmitPaper" type="file" required class="form-control flex-column" accept="application/pdf">
                                    <label for="SubmitPaper"> Attach a PDF file </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-check">
                            <div class="col">
                                <input class="form-check-input" type="checkbox" name="submitCheck" id="submitCheck" type="checkbox" required>
                                <label class="form-check-label" for="submitCheck">
                                    By submitting, you are agreeing to to our <a href="/privacyPolicy">Privacy Policies</a>
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="checkbox" name="uRemember" id="TermsConditions" type="checkbox" required>
                                <label class="form-check-label" for="TermsConditions">
                                    By submitting, you are agreeing to our <a href="/terms&conditions">Terms & Conditions</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group btn-group-lg d-grid gap-2">
                        <button name="submit" type="submit" class="btn btn-primary" id="submissionButton">Submit</button>
                    </div>
                </form>
                <!--End Register Appointment Form-->
            </div>
        </div>
    </div>
</div>

<?php
    if ($isValid) {
        echo Toast::successSubmission("sub_content"); 
    }    
}
else {
    http_response_code(404);
    require $publicPath . './errors/404.php';
}
?>
    