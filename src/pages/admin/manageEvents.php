<?php
    include_once("./classes/components/card.php");
    include_once("./classes/dbAPI.class.php");
    include_once("./classes/components/timeProcessor.php");

    $db = new Database();
    $conferences = $db->getConferences();

    foreach($conferences as $conference) {
        // check if conference has expired and update status
        if (TimeProcessor::cmpETimeandCTime($conference->ConferenceEndTimestamp)) {
            $db->updateConference(
                $conference->ConferenceId, 
                $conference->ConferenceTitle, 
                $conference->ConferenceStartTimestamp, 
                $conference->ConferenceEndTimestamp, 
                $conference->ConferenceLocation, 
                "0"
            ); 
        }
    }

    $conferences = $db->getConferences();
?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-left h-100">
        <h1 class="display-4">Manage Conferences</h1>
        <p class="lead">You have the power to manage all of the registered conferences!</p>

        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <!--SEARCH START-->
                <p class="form-group mr-2">Search by: </p>
                <div class="dropdown">
                    <select id="searchCOption" class="form-select form-select-sm" aria-label="Default select">
                        <option value="Title"><a class="dropdown-item" name="searchCTitle" id="searchCTitle" href="#">Conference Title</a></option>
                        <option value="StartDate"><a class="dropdown-item" name="searchCSDate" id="searchCSDate" href="#">Start Date</a></option>
                        <option value="StartTime"><a class="dropdown-item" name="searchCSTime" id="searchCSTime" href="#">Start Time</a></option>
                        <option value="EndDate"><a class="dropdown-item" name="searchCEDate" id="searchCEDate" href="#">End Date</a></option>
                        <option value="EndTime"><a class="dropdown-item" name="searchCETime" id="searchCETime" href="#">End Time</a></option>
                        <option value="Location"><a class="dropdown-item" name="searchCLocation" id="searchCLocation" href="#">Conference Location</a></option>
                    </select>
                </div>
                <input type="search" class="form-control form-control-sm" name="searchCParam" id="searchCParam" placeholder="Search">
            </div>
        </form>
        <hr>
        <!--SEARCH END-->

        <div id="error_container" class="d-none"></div>
        <div class="overflow-auto vw-75 vh-25 border rounded-3 border-secondary p-4" style="height: 32rem; width: 100%">            
            <div id="searchCResult">
                <?php
                foreach ($conferences as $conference) {
                    
                    $start = strtotime($conference->ConferenceStartTimestamp); 
                    $end = strtotime($conference->ConferenceEndTimestamp); 
                   
                    $sdatetime = TimeProcessor::getDateTime($start); 
                    $edatetime = TimeProcessor::getDateTime($end); 
                    
                    echo Card::display(
                        'manageConferenceCard',
                        [
                            $conference->ConferenceId,
                            $conference->ConferenceTitle,
                            $sdatetime["date"], 
                            $sdatetime["time"], 
                            $edatetime["date"], 
                            $edatetime["time"], 
                            $conference->ConferenceLocation, 
                            $conference->ConferenceStatus
                        ]
                    );
                }
                ?>
            </div>
        </div>
    </div>


</div>
<!--CONTENT END-->