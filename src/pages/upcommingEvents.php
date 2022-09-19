<?php
require_once "classes/dbAPI.class.php";

$db = new Database();
// Eventually, this will instead be getting a list of registered events for a user
$users = $db->getAllUser();
?>

<div>    
    <div class="card-deck">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            foreach($users as $user) {
            ?>
                <div class="col">
                    <div class="card bg-gradient-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col w-50">
                                    <b>First Name</b>
                                </div>
                                <div class="col w-50 text-secondary">
                                    <?php echo $user->UserFirstName ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col w-50">
                                    <b>Last Name</b>
                                </div>
                                <div class="col w-50 text-secondary">
                                    <?php echo $user->UserLastName ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col w-50">
                                    <b>Email</b>
                                </div>
                                <div class="col w-50 text-secondary">
                                    <?php echo $user->UserEmail ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>  
        </div>
    </div>
</div>




