<?php
    require_once "./classes/dbAPI.class.php";
    require_once "./classes/conference.class.php";
    require_once "./classes/validator.class.php";
    require_once "./classes/idGenerator.class.php";

    $db = new Database();

    $cTitle = $cSDate = $cSTime = $cEDate = $cETime = $cLocation = ""; 

    $valid = false; 

    $errs = [
        "cTitle" => "", 
        "cLocation" => "", 
        "cSDate" => "", 
        "cSTime" => "",
        "cEDate" => "", 
        "cETime" => "", 
        "cSTimestamp" => "",
        "cETimestamp" => ""
    ];

    if (isset($_POST['rConference'])) {
        $cStatus = "1"; 
        $cTitle = Validator::sanitise($_POST["cTitle"]);
        $cSDate = Validator::sanitise($_POST["cSDate"]);
        $cSTime = Validator::sanitise($_POST["cSTime"]);
        $cEDate = Validator::sanitise($_POST["cEDate"]);
        $cETime = Validator::sanitise($_POST["cETime"]);
        $cLocation = Validator::sanitise($_POST["cLocation"]);
        
        $conference = new Conference($cTitle, $cSDate, $cSTime, $cEDate, $cETime, $cLocation, $cStatus, $errs);
        $conference->validateConferenceRegister();

        $errs = $conference->get_err(); 

        if (Validator::validate($errs)) {
            $id = IDGenerator::conference();

            $db->createConference(
                $id,
                $cTitle,
                $cSDate . " " . $cSTime, 
                $cEDate . " " . $cETime, 
                $cLocation, 
                $cStatus
            );    
            $valid = true;         
        }
        else {            
            Validator::displayErrorToasts($errs); 
            $valid = false; 
        }
        
    }
  
?>

<div id="register_conference_content" class="container-fluid p-5">

    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center text-center h-100 mb-5">
        <div class="card-body">
            <h1 class="display-4">Register An Upcoming Conference</h1>            
            <br>
            <!--Start Event Register Form-->
            <form id="registerConferenceForm" action="#" method="post">

                <div class="form-group mb-2 mr-2">
                    <div class="row">                        
                        <div class="col">
                            <div class="form-group">  
                                <div class="text-left">Conference Title:</div>                              
                                <input id="cTitle" name="cTitle" placeholder="Conference Title" type="text" required class="form-control" value="<?php echo $cTitle; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <div class="text-left">Conference Location/Link:</div>
                                <input id="cLocation" name="cLocation" placeholder="Location/Link" type="text" required class="form-control" value="<?php echo $cLocation; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">                        
                        <div class="col">
                            <div class="form-group">
                                <div class="text-left">Start Date:</div>
                                <input id="cSDate" name="cSDate" type="date" required class="form-control" value="<?php echo $cSDate; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <div class="text-left">Start Time:</div>
                                <input id="cSTime" name="cSTime" placeholder="Time" type="time" required class="form-control" value="<?php echo $cSTime; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="text-left">End Date:</div>
                                <input id="cEDate" name="cEDate" type="date" required class="form-control" value="<?php echo $cEDate; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <div class="text-left">End Time:</div>
                                <input id="cETime" name="cETime" placeholder="Time" type="time" required class="form-control" value="<?php echo $cETime; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group btn-group-lg d-grid gap-2">
                    <button name="rConference" type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>

</div>

<?php
    if ($valid) {
        echo Toast::successSubmission("register_conference_content"); 
        echo Toast::successToast("Conference successfully created."); 
    }    
?>
    