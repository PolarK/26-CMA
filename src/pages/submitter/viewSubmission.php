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

        $url_filename = str_replace(" ", "%20", $filename); 

        $tempPath = "https://" . $_SERVER['SERVER_NAME'] . "/src/pages/submitter/submissions/" . $_SESSION["UID"] . "/" . $url_filename; 

        $review = $db->findReviewBySubmissionId($_GET["subId"]); 

        if ($review) {
            $date = date("d/m/Y", strtotime($review[0]->ReviewTimestamp));
            $body = '<div class="form-group p-3 d-grid gap-2">
                        <label for="rComment">Comments</label>                                        
                        <textarea readonly id="rComment" name="rComment" placeholder="Comments" rows="6"  class="form-control">' . $review[0]->ReviewComments . '</textarea>
                    </div>    
                    <div class="p-3 d-grid gap-2">
                        <p>Reviewed on: ' . $date . '</p>
                        <p>Result: ' . $review[0]->ReviewStatus . '</p>
                    </div>'; 
        }
        else {
            $body = "<p>Pending Review</p>"; 
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