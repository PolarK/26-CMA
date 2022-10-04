<?php
include_once("./classes/components/card.php");
include_once("./classes/dbAPI.class.php");

?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
        <h1 class="display-4">My Events</h1>
        <p class="lead">Check your events progress here. We'll send you a notification nearing the event date. Keep a look out!</p>
        <div style="margin: auto; width: <?php echo (!Mobile::isActive()? '36rem' : '100%') ?>;">

            <?php
            // !testing only, will have to get data from the db
            $subData = [
                'Future of IoT by John S.',
                'https://teams.microsoft.com/l/meetup-join/19%3ameeting_ZTA1ZWUzNjktNjA3NS00YjhjLWJiMWMtM2VhYzMyMzcyZTlk%40thread.v2/0?context=%7b%22Tid%22%3a%22df7f7579-3e9c-4a7e-b844-420280f53859%22%2c%22Oid%22%3a%2221771f7c-ddc4-448c-b7d9-4b4e0c5sebe%22%7d',
                '29-10-2022',
                '12:30 PM AEST',
                '/file/' . $_SESSION['UID'] . '/Future-of-IoT.pdf',
                'Jhon S.',
                'Accepted',
            ];

            echo Card::display("event", $subData);

            ?>
            
        </div>
    </div>
</div>
<!--CONTENT END-->