<?php
require_once "classes/dbAPI.class.php";

$db = new Database();
// This will eventually need to be changed to use the logged in user details
$users = $db->findUserById($_SESSION['UID']);
?>

<div>
    <!-- the background is purely for seeing the size of the container/cards, can be removed later -->
    <?php
    foreach($users as $user) {
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <div class="row h-100">
                        <div class="card bg-gradient-light">
                            <div id="card-body">
                                <div class="position-absolute top-50 start-50 translate-middle text-center">
                                    <h1> Hello </h1>
                                    <h1><?php echo $user->UserFirstName?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-8">
                    <div class="card bg-gradient-light">
                        <div class="card-body">
                        <hr>
                        <div class="row">
                            <div class="col">
                                <b>First Name</b>
                            </div>
                            <div class="col text-secondary">
                                <?php echo $user->UserFirstName ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <b>Last Name</b>
                            </div>
                            <div class="col text-secondary">
                                <?php echo $user->UserLastName ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <b>Email</b>
                            </div>
                            <div class="col text-secondary">
                                <?php echo $user->UserEmail ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <b>Phone No.</b>
                            </div>
                            <div class="col text-secondary">
                                <?php echo $user->UserPhoneNo ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <b>Date of Birth</b>
                            </div>
                            <div class="col text-secondary">
                                <?php echo $user->UserDOB ?>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>