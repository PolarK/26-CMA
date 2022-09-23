<?php
include_once("./classes/components/card.php");
include_once("./classes/dbAPI.class.php");

$db = new Database();
$users = $db->getAllUser();
?>

<!--CONTENT START-->
<div id="content" class="container-fluid p-5">
    <div class="d-flex flex-column justify-content-center align-items-center text-left h-100">
        <h1 class="display-4">Manage Users</h1>
        <p class="lead">You have the power to manage all of the registered users!</p>

        <?php
        if (!empty($users)) {
        ?>
            <div style="margin: auto; width: 75%;">
                <div style="height: 600px; overflow: hidden scroll;">
                    <table id="displayUsers" class="table" style=" border: 2px black solid;">
                        <thead class="bg-light" style="position: sticky; top: 0;">
                            <tr>
                                <form class="form-inline">
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="searchUID" id="searchUID" placeholder="User ID">
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="searchFName" id="searchFName" placeholder="User First Name">
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="searchLName" id="searchLName" placeholder="User Last Name">
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="searchDOB" id="searchDOB" placeholder="User DOB">
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="searchEmail" id="searchEmail" placeholder="User Email Address">
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="form-group mb-2 mr-2">
                                            <input type="search" class="form-control form-control-sm" name="searchPhoneNo" id="searchPhoneNo" placeholder="User PhoneNo">
                                        </div>
                                    </th>
                                </form>
                            </tr>
                        </thead>
                        <tbody id="searchResult">
                            <?php foreach ($users as $user) { ?>
                                <tr>
                                    <td><?php echo $user->UserId ?></td>
                                    <td><?php echo $user->UserFirstName ?></td>
                                    <td><?php echo $user->UserLastName ?></td>
                                    <td><?php echo $user->UserDOB ?></td>
                                    <td><?php echo $user->UserEmail ?></td>
                                    <td><?php echo $user->UserPhoneNo ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        <?php } else { ?>
            <div class="card card-body bg-info">
                <p class="text-center">
                    Sadly, there aren't any records to fetch.
                </p>
            </div>
        <?php } ?>
    </div>
</div>
<!--CONTENT END-->