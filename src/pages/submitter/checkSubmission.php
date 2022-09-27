<?php
include_once("./classes/components/card.php");
include_once("./classes/dbAPI.class.php");

?>

<!--CONTENT START-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
        <h1 class="display-4">My Submissions</h1>
        <p class="lead">Check your paper progress here. We'll send you a notification as soon as we completed our review!</p>
        <div style="margin: auto; width: 100%;">

            <?php
            // !testing only, will have to get data from the db
            $subData = [
                'Future-of-IoT.pdf',
                'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorem nostrum assumenda provident perspiciatis, vel quaerat aut fugiat perferendis magni explicabo praesentium totam, in commodi quidem, exercitationem ab! Vero, voluptatibus laborum.',
                '/' . $_SESSION['UID'] . '/Future-of-IoT.pdf',
                'Accepted',
                '19-09-2022 7:10PM'
            ];

            echo Card::display("submission", $subData);

            ?>
        </div>
    </div>
</div>
<!--CONTENT END-->