<?php 

    // works only on pdf files 
    
    require "./classes/dbAPI.class.php";
    include_once "./submission.php"; 

    $db = new Database(); 
    
    if (isset($_GET["filepath"]) && isset($_GET["subId"])) {

        $filename = $_GET["filepath"]; 

        $folder_path = __DIR__ . "/submissions/" . $_SESSION["UID"];

        if (!file_exists($folder_path)) {          // create user file if it does not exist
            mkdir($folder_path, 0777, true);
        }      
        
        getFile($_SESSION["UID"], $filename, $folder_path); 

        $tempPath = "https://" . $_SERVER['SERVER_NAME'] . "/src/pages/submitter/submissions/" . $_SESSION["UID"] . "/" . rawurlencode($filename); 

        $review = $db->findReviewBySubmissionId($_GET["subId"]); 

        $sub = $db->findSubmissionById($_GET["subId"]); 
        $timestamp = strtotime($sub[0]->SubmissionTimestamp); 
        $subDate = date('d/m/Y', $timestamp);
        $subTime = date('H:i', $timestamp);

        $conference = $db->findConferenceById($sub[0]->ConferenceId); 

        $body = '<h4 class="mt-4 mb-4 ms-2">Submission Details</h4>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Submission For</th>
                            <td>' . $conference[0]->ConferenceTitle . '</td>
                        </tr>
                        <tr>
                            <th scope="row">Submitted On</th>
                            <td>' . $subDate . ' ' . $subTime . '</td>
                        </tr>'; 

        if ($review) {
            $grade_style = ($review[0]->ReviewStatus == "Success")? "text-success" : "text-danger"; 
            $date = date("d/m/Y", strtotime($review[0]->ReviewTimestamp));
            $body .= '<tr>
                        <th scope="row">Graded On</th>
                        <td>' . $date . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Grade</th>
                        <td class="' . $grade_style . '">' . $review[0]->ReviewStatus . '</td>
                    </tr>                    
                    <tr>
                        <th scope="row">Comments</th>
                        <td>' . $review[0]->ReviewComments . '</td>
                    </tr></tbody></table>';   
                    
        }
        else {
            $body .= '<tr>
                        <th scope="row">Review</th>
                        <td>Pending</td>
                    </tr></tbody></table>';  
        }  
   
?>

    <div class="container-fluid" style="width:100% mb-5">
        <div class="row vh-100">
            <div class="col-sm-6 col-md-8 border bg-light embed-responsive embed-responsive-21by9">
                <iframe class="p-3 embed-responsive-item" src= "<?php echo $tempPath; ?>"></iframe>
            </div>
            <div class="col-6 col-md-4 border">                
                <?php echo $body; ?>
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