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

        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <!--SEARCH START-->
                <p class="form-group mr-2">Search by: </p>
                <div class="dropdown">
                    <select class="form-select form-select-sm" aria-label="Default select">
                        <option><a class="dropdown-item" name="searchFName" id="searchFName" href="#">First Name</a></option>
                        <option><a class="dropdown-item" name="searchLName" id="searchLName" href="#">Last Name</a></option>
                        <option><a class="dropdown-item" name="searchDOB" id="searchDOB" href="#">Date of Birth</a></option>
                        <option><a class="dropdown-item" name="searchEmail" id="searchEmail" href="#">Email</a></option>
                        <option><a class="dropdown-item" name="searchPhoneNo" id="searchPhoneNo" href="#">Phone No.</a></option>
                    </select>
                </div>
                <input type="search" class="form-control form-control-sm" name="searchParam" id="searchParam" placeholder="Search">
            </div>
        </form>
        <hr>
        <!--SEARCH END-->

        <!--DISPLAY DATA START-->
        <div class="card" style="margin: auto; width: 32rem;">
            <div class="badge text-dark" style="border-bottom: 1px solid black">
                <div class="row ml-1 mr-1">
                    <div class="col border-end m-1">RJS4e0f</div>
                    <div class="col border-end">
                        <button type="button" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i> EDIT
                        </button>
                    </div>
                    <div class="col border-end">
                        <button type="button" class="btn btn-sm btn-danger">
                            <i class="fa fa-minus"></i> DISABLE
                        </button>
                    </div>
                    <div class="col m-1">Reviewer</div>
                </div>
            </div>
            <div class="card-body align-items-left align-text-left">
                <div class="row ml-1 mr-1">
                    <div class="col border-end">
                        <i class="fa fa-user"></i> John Smith
                    </div>
                    <div class="col">
                        <i class="fa fa-envelope"></i> john@smith.com
                    </div>
                </div>
                <div class="row ml-1 mr-1">
                    <div class="col border-end">
                        <i class="fa fa-mobile"></i> 0442 559 773
                    </div>
                    <div class="col">
                        <i class="fa fa-calendar"></i> 2000-12-12
                    </div>

                </div>
            </div>
        </div>
        <br>
        <!--DISPLAY DATA END-->


    </div>
</div>
<!--CONTENT END-->