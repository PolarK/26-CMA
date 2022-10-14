<?php
include_once("./classes/components/card.php");
include_once("./classes/dbAPI.class.php");

$db = new Database();
$users = $db->getAllUser();
?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-center h-100 mb-5">
        <h1 class="display-4">Manage Existing Users</h1>
        <p class="lead">You have the power to manage all of the registered users!</p>

        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <!--SEARCH START-->
                <h6 class="form-group mr-2">Search by: </h6>
                <div class="dropdown">
                    <select id="searchOption" class="form-select form-select-sm" aria-label="Default select">
                        <option value="FirstName"><a class="dropdown-item" name="searchFName" id="searchFName" href="#">First Name</a></option>
                        <option value="LastName"><a class="dropdown-item" name="searchLName" id="searchLName" href="#">Last Name</a></option>
                        <option value="DOB"><a class="dropdown-item" name="searchDOB" id="searchDOB" href="#">Date of Birth</a></option>
                        <option value="Email"><a class="dropdown-item" name="searchEmail" id="searchEmail" href="#">Email</a></option>
                        <option value="PhoneNo"><a class="dropdown-item" name="searchPhoneNo" id="searchPhoneNo" href="#">Phone No.</a></option>
                    </select>
                </div>
                <input type="input" class="form-control form-control-sm" name="searchUserParam" id="searchUserParam" placeholder="Search" onkeydown="return (event.keyCode!=13);">
            </div>
        </form>
        <hr>
        <!--SEARCH END-->
        <?php if (!Mobile::isActive()) {
            echo '<div class="overflow-auto vw-75 vh-25 border rounded-3 border-secondary p-4" style="height: 32rem; width: 64rem;">';
        } ?>

        <div id="searchResult">
                <?php
                foreach ($users as $user) {
                    echo Card::display(
                        'manageUserCard',
                        [
                            $user->UserId,
                            $user->UserFirstName,
                            $user->UserLastName,
                            $user->UserDOB,
                            $user->UserEmail,
                            $user->UserPhoneNo,
                            $user->UserRole,
                            $user->UserActive,
                        ]
                    );
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!--CONTENT END-->