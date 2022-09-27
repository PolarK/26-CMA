<?php
class Card
{
    public static function display($type = '', $data = array())
    {
        implode(',', $data);

        switch ($type) {
            case 'submission':
                return self::submissionCard($data[0], $data[1], $data[2], $data[3], $data[4]);

            case 'event':
                return self::eventCard($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);

            case 'upcomingEvent':
                return self::upcomingEventCard($data[0], $data[1], $data[2], $data[3]);

            case 'userProfile':
                return self::userProfile($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);

            case 'displayEvent':
                return self::displayEvent($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);

            case 'userCard':
                return self::userCard($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
        }
    }

    private static function submissionCard($title, $filePath, $status, $date, $time)
    {
        return '
        <div class="card">
            <span class="badge ' . self::defineStatus($status) . ' text-dark">Submission ' . $status . '</span>
            <div class="card-body">
                <h5 class="card-title">' . $title . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">Submitted at: ' . $date . ' ' . $time . '</h6>
                <a href="./viewSubmission?filepath=' . $filePath . '" class="card-link">View My Paper</a> 
            </div>
        </div>
        <br>
        ';
    }

    //! $date & $time should be merge into $timestamp
    private static function eventCard($title, $link, $date, $time, $filePath, $presenter, $status)
    {
        return '
        <div class="card">
            <span class="badge ' . self::defineStatus($status) . ' text-dark">Event ' . $status . '</span>
            <div class="card-body">
                <h5 class="card-title">' . $title . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">Presented by: ' . $presenter . ' </h6>
                <div class="text-left">
                    <p class="card-text"> 
                        <strong> Event Date </strong> : ' . $date . '</a><br>
                        <strong> Event Time </strong> : ' . $time . '</a><br>
                        <strong> Meeting URL </strong> : <a href="' . $link . '">' . $link . '</a><br>
                        <strong> Paper to be presented </strong> : <a href="' . $filePath . '">' . $filePath . '</a>
                    </p>
                    <form>
                        <select class="form-select">
                            <option value="accept">Confirmed Attendance</option>
                            <option value="reschedule">Request Another Time</option>
                            <option value="reject">Cancel Attendance</option>
                        </select>
                        <br>
                        <div class="form-group btn-group-sm d-grid gap-2">
                            <button name="submitAttendance" type="submit" class="btn btn-primary" onclick="showToast()">Submit Attendance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        ';
    }

    private static function upcomingEventCard($title, $timestamp, $eventURL, $status)
    {
        return '
        <div class="card bg-gradient-light">
            <span class="badge ' . self::defineStatus($status) . ' text-dark">' . $status . '</span>
            <div class="card-body">
                <h5 class="card-title">' . $title . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">Event at: ' . $timestamp . ' </h6>
                <a class="stretched-link" href="' . $eventURL . '" class="card-link">View My Event in Details</a> 
            </div>
        </div>
        <br>
        ';
    }

    //? Should be changed to userProfileCard and not userProfile
    private static function userProfile($fName, $lName, $email, $phoneNo, $dob, $password)
    {
        return '
        <div class="card bg-gradient-light">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <strong>Name</strong>
                    </div>
                    <div class="col text-secondary">
                         ' . $fName . ' ' . $lName . ' 
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <strong>Email</strong>
                    </div>
                    <div class="col text-secondary">
                         ' . $email . '
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <strong>Phone No.</strong>
                    </div>
                    <div class="col text-secondary">
                        ' . $phoneNo . '
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <strong>Date of Birth</strong>
                    </div>
                    <div class="col text-secondary">
                        ' . $dob . '
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <strong>Password</strong>
                    </div>
                    <div class="col text-secondary">
                        ' . $password . '
                    </div>
                </div>
            </div>
        </div>
        <br>
        ';
    }

    //? Should be changed to displayEventCard and not displayEvent
    private static function displayEvent($id, $title, $location, $date, $time, $fee, $status)
    {
        return '
        <div class="card">
            <span class="badge ' . ' text-dark">' . $title . '</span>
            <div class="card-body">
                <h5 class="card-title">Title: ' . $title . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">Date: ' . $date . ' </h6>
                <h6 class="card-subtitle mb-2 text-muted">Time: ' . $time . ' </h6>
                <h6 class="card-subtitle mb-2 text-muted">Location: ' . $location . ' </h6>
                <h6 class="card-subtitle mb-2 text-muted">Registration Fee: $' . $fee . ' </h6>
                <a href="./submitPaper?eventid=' . $id . '" class="card-link">' . $status . '</a> 
            </div>
        </div>
        <br>
        ';
    }


    private static function userCard($id, $fname, $lname, $dob, $email, $phoneNo, $role)
    {
        return '
        <!--DISPLAY DATA START-->
        <div class="card bg-light border-dark ml-2 mr-2 mt-1">
            <div class="badge text-dark border-bottom border-dark bg-gradient-secondary">
                <div class="row ml-1 mr-1 ">
                    <div class="col border-end m-1">
                        <p id="uID-' . $id . '" name="uID-' . $id . '">' . $id . '</p>
                    </div>
                    <div id="box-edit-' . $id . '" class="col border-end">
                        <button id="edit-' . $id . '" type="button" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i> EDIT
                        </button>
                    </div>
                    <div id="box-disable-' . $id . '" class="col border-end">
                        <button id="disable-' . $id . '" type="button" class="btn btn-sm btn-danger">
                            <i class="fa fa-minus"></i> DISABLE
                        </button>
                    </div>
                    <div class="col m-1">
                    <p id="uRole-' . $id . '" name="uRole-' . $id . '">' . $role . '</p>

                    </div>
                </div>
            </div>
            <fieldset id="field-edit-' . $id . '" disabled>
                <form class="form-inline">
                    <div class="card-body align-items-left align-text-left p-1">
                        <div class="row ml-1 mr-1">
                            <div class="col border-end border-dark">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <input id="uFName-' . $id . '" name="uFName-' . $id . '" type="text" class="form-control" value="' . $fname . '">
                                    <input id="uLName-' . $id . '" name="uLName-' . $id . '" type="text" class="form-control" value="' . $lname . '">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </div>
                                    <input id="uEmail-' . $id . '" name="uEmail-' . $id . '" type="text" class="form-control" value="' . $email . '">
                                </div>
                            </div>
                        </div>
                        <div class="row ml-1 mr-1">
                            <div class="col border-end border-dark">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                    </div>
                                    <input id="uPhoneNo-' . $id . '" name="uPhoneNo-' . $id . '" type="text" class="form-control" value="' . $phoneNo . '">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input id="uDOB-' . $id . '" name="uDOB-' . $id . '" type="text" class="form-control" value="' . $dob . '">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
        <!--DISPLAY DATA END-->
        ';
    }

    private static function defineStatus($status)
    {
        switch ($status) {
            case 'Accepted':
                return 'bg-success';

            case 'Pending':
                return 'bg-warning';

            case 'Rejected':
                return 'bg-danger';
        }
    }
}
