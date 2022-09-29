<?php
include_once("./classes/components/card.php");
require_once "./classes/dbAPI.class.php";

$db = new Database();
// This will eventually need to be changed to use the logged in user details
$users = $db->findUserById($_SESSION['UID']);

foreach ($users as $user) {
?>
    <!--CONTENT START-->
    <div id="content" class="container-fluid p-5">
        <div class="d-flex flex-column justify-content-center align-items-center text-left h-100">

            <h1 class="display-4">Hello, <?php echo $user->UserFirstName . " " . $user->UserLastName  ?></h1>
            <p class="lead">You can edit your profile here and our handyman will get right on updating it!</p>
            <div id="searchResult" style="margin: auto; width: 100%;">
                <?php
                echo Card::display(
                    "userProfileCard", 
                    [
                        $user->UserFirstName,
                        $user->UserLastName,
                        $user->UserEmail,
                        $user->UserPhoneNo,
                        $user->UserDOB,
                        '**********',
                    ]
                );
                ?>
            </div>
        </div>
    </div>
    <!--CONTENT END-->

<?php } ?>