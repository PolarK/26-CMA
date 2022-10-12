<?php
    include_once("./classes/components/card.php");
    include_once("./classes/components/timeProcessor.php");
    require_once "./classes/dbAPI.class.php";


    //
    //
    //
    //
    // We can possibly delete this page as it can be implemented within the manageMyEvents.php page
    // We can also use it to show un-accepted registered comnferences, and use manageMyEvents to only show accepted conferences
    //
    //  
    //
    //



?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
        <h1 class="display-4">My Upcoming Events</h1>
        <p class="lead">Check all of your upcoming events here. Click the card to view it in details!</p>
        <div style="margin: auto; width: <?php echo (!Mobile::isActive()? '36rem' : '100%') ?>;">

            <?php
            // !testing only, will have to get data from the db
            $subData = [
                'Future of IoT by John S.',
                '29-10-2022 12:30 PM AEST',
                'url/to/a/specific/event',
                'Accepted',
            ];

            echo Card::display("upcomingEvent", $subData);

            ?>

        </div>
    </div>
</div>
<!--CONTENT END-->