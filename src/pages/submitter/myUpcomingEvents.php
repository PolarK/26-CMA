<?php
include_once("./classes/components/card.php");
include_once("./classes/dbAPI.class.php");
?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
        <h1 class="display-4">My Upcomming Events</h1>
        <p class="lead">Check all of your upcomming events here. Click the card to view it in details!</p>
        <div style="margin: auto; width: 36rem;">

            <?php
            // !testing only, will have to get data from the db
            $subData = [
                'Future of IoT by John S.',
                '29-10-2022 12:30 PM AEST',
                'url/to/a/specific/event',
                'Accepted',
            ];

            echo Card::display("upcommingEvent", $subData);

            ?>

        </div>
    </div>
</div>
<!--CONTENT END-->