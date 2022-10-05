<?php if (session_status() == PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../mobile.class.php';
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

            case 'userProfileCard':
                return self::userProfileCard($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);

            case 'displayEventCard':
                return self::displayEventCard($data[0], $data[1], $data[2], $data[3], $data[4]);

            case 'manageUserCard':
                return self::manageUserCard($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]);

            case 'manageSubmissionCard':
                return self::manageSubmissionCard($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]);
        }
    }

    private static function submissionCard($title, $filePath, $status, $date, $time)
    {
        return '
        <div class="card">
            <span class="badge ' . self::defineConfirmationStatus($status) . ' text-dark">Submission ' . $status . '</span>
            <div class="card-body">
                <p class="card-title">' . $title . '</p>
                <p class="card-subtitle mb-2 text-muted">Submitted at: ' . $date . ' ' . $time . '</p>
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
            <span class="badge ' . self::defineConfirmationStatus($status) . ' text-dark">Event ' . $status . '</span>
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
            <span class="badge ' . self::defineConfirmationStatus($status) . ' text-dark">' . $status . '</span>
            <div class="card-body">
                <h5 class="card-title">' . $title . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">Event at: ' . $timestamp . ' </h6>
                <a class="stretched-link" href="' . $eventURL . '" class="card-link">View My Event in Details</a> 
            </div>
        </div>
        <br>
        ';
    }

    private static function userProfileCard($id, $fName, $lName, $email, $phoneNo, $dob, $password)
    {
        if (!Mobile::isActive()) {
            return '
        <div class="card bg-gradient-light">
        <fieldset id="field-edit-' . $id . '" disabled>
            <form class="form-inline">
                <div class="card-body">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <strong>First Name</strong>
                        </div>
                        <div class="col text-secondary">
                            <input id="uFName-' . $id . '" name="uFName-' . $id . '" type="text" class="form-control" value="' . $fName . '">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <strong>Last Name</strong>
                        </div>
                        <div class="col text-secondary">
                            <input id="uLName-' . $id . '" name="uLName-' . $id . '" type="text" class="form-control" value="' . $lName . '">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <strong>Email</strong>
                        </div>
                        <div class="col text-secondary">
                            <input id="uEmail-' . $id . '" name="uEmail-' . $id . '" type="text" class="form-control" value="' . $email . '">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <strong>Phone No.</strong>
                        </div>
                        <div class="col text-secondary">
                            <input id="uPhoneNo-' . $id . '" name="uPhoneNo-' . $id . '" type="text" class="form-control" value="' . $phoneNo . '">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <strong>Date of Birth</strong>
                        </div>
                        <div class="col text-secondary">
                            <input id="uDOB-' . $id . '" name="uDOB-' . $id . '" type="text" class="form-control" value="' . $dob . '" onfocus="(this.type=\'date\')">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <strong>New Password</strong>
                        </div>
                        <div class="col text-secondary">
                            <input id="uPass-' . $id . '" name="uPass-' . $id . '" type="password" class="form-control" value="' . $password . '" onclick="this.value =\'\'">
                        </div>
                    </div>
                </div>
            </form>
        </fieldset>
        <div id="box-edit-' . $id . '" class="form-group btn-group-sm d-grid gap-2">
            <button id="edit-' . $id . '" type="button" class="btn btn-sm btn-success ml-3 mr-3">
                <i class="fas fa-edit"></i> EDIT
            </button>
            </div>
        </div>
        <br>
        ';
        } else {
            return '
        <fieldset id="field-edit-' . $id . '" disabled>
            <form class="form-inline">
                <div class="card-body">
                    <div class="col d-flex align-items-center">
                        <strong>First Name</strong>
                    </div>
                    <div class="col text-secondary">
                        <input id="uFName-' . $id . '" name="uFName-' . $id . '" type="text" class="form-control" value="' . $fName . '">
                    </div>
                    <div class="col d-flex align-items-center mt-3">
                        <strong>Last Name</strong>
                    </div>
                    <div class="col text-secondary">
                        <input id="uLName-' . $id . '" name="uLName-' . $id . '" type="text" class="form-control" value="' . $lName . '">
                    </div>
                    <div class="col d-flex align-items-center mt-3">
                        <strong>Email</strong>
                    </div>
                    <div class="col text-secondary">
                        <input id="uEmail-' . $id . '" name="uEmail-' . $id . '" type="text" class="form-control" value="' . $email . '">
                    </div>
                    <div class="col d-flex align-items-center mt-3">
                        <strong>Phone No.</strong>
                    </div>
                    <div class="col text-secondary">
                        <input id="uPhoneNo-' . $id . '" name="uPhoneNo-' . $id . '" type="text" class="form-control" value="' . $phoneNo . '">
                    </div>
                    <div class="col d-flex align-items-center mt-3">
                        <strong>Date of Birth</strong>
                    </div>
                    <div class="col text-secondary">
                        <input id="uDOB-' . $id . '" name="uDOB-' . $id . '" type="text" class="form-control" value="' . $dob . '" onfocus="(this.type=\'date\')">
                    </div>
                    <div class="col d-flex align-items-center mt-3">
                        <strong>New Password</strong>
                    </div>
                    <div class="col text-secondary">
                        <input id="uPass-' . $id . '" name="uPass-' . $id . '" type="password" class="form-control" value="' . $password . '" onclick="this.value =\'\'">
                    </div>
                </div>
            </form>
        </fieldset>
        <div id="box-edit-' . $id . '" class="form-group btn-group-sm d-grid gap-2">
            <button id="edit-' . $id . '" type="button" class="btn btn-sm btn-success ml-3 mr-3">
                <i class="fas fa-edit"></i> EDIT
            </button>
        </div>
        <br>';
        }
    }

    private static function displayEventCard($id, $title, $location, $timestamp, $status)
    {
        return '
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">' . $title . '</h5>
                <h6 class="card-subtitle mb-2">Date: <a class="text-muted"> ' . date("d M y \a\\t g:i A", strtotime($timestamp)) . '</a> </h6>
                <h6 class="card-subtitle mb-2">Location: <a href="' . $location . '">' . $location . ' </a> </h6>
                <a href="./submitPaper?eventid=' . $id . '" class="btn btn-primary"">' . $status . '</a> 
            </div>
        </div>
        <br>
        ';
    }

    private static function manageUserCard($id, $fname, $lname, $dob, $email, $phoneNo, $role, $isActive)
    {
        $userActiveAttribute = self::isUserActive($isActive);
        if (!Mobile::isActive()) {
            return '
            <!--DISPLAY DATA START-->
            <div class="card bg-light border-dark ml-2 mr-2 mt-1">
                <div class="badge text-dark border-bottom border-dark bg-gradient-secondary">
                    <div class="row ml-1 mr-1">
    
                        <div class="col border-end m-1">
                            <p id="uID-' . $id . '" name="uID-' . $id . '"><span class="badge bg-secondary ' . $userActiveAttribute['style'] . '">' . $id . ' </span></p>
                        </div>
                        <div id="box-edit-' . $id . '" class="col border-end">
                            <button id="edit-' . $id . '" type="button" class="btn btn-sm btn-success" ' . self::checkUserRole($id, $role) . '>
                                <i class="fas fa-edit"></i> EDIT
                            </button>
                        </div>
                        <div id="box-disable-' . $id . '" class="col border-end">
                            <button id="disable-' . $id . '" type="button" class="btn btn-sm ' . $userActiveAttribute['button'] . '" ' . self::checkUserRole($id, $role) . '>
                                <i class="fa ' . $userActiveAttribute['icon'] . '"></i> ' . $userActiveAttribute['text'] . '
                            </button>
                        </div>
                        <div class="col m-1">
                        <p id="uRole-' . $id . '" name="uRole-' . $id . '"><span class="badge bg-secondary ' . $userActiveAttribute['style'] . '">' . $role . ' </span></p>
                        
                        <p hidden id="uActive-' . $id . '" name="uActive-' . $id . '">' . $isActive . '</p>
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
            <br>
            ';
        } else {
            return '
            <!--DISPLAY DATA START-->
            <div class="card bg-light border-dark mt-1">
                <div class="badge text-dark border-bottom border-dark bg-gradient-secondary">
                    <div class="row">
                        <div class="col border-end m-1">
                            <p id="uID-' . $id . '" name="uID-' . $id . '"><span class="badge bg-secondary ' . $userActiveAttribute['style'] . '">' . $id . ' </span></p>
                        </div>
                        <div id="box-edit-' . $id . '" class="col border-end">
                            <button id="edit-' . $id . '" type="button" class="btn btn-sm btn-success" ' . self::checkUserRole($id, $role) . '>
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                        <div id="box-disable-' . $id . '" class="col border-end">
                            <button id="disable-' . $id . '" type="button" class="btn btn-sm btn-danger" ' . self::checkUserRole($id, $role) . '>
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div class="col m-1">
                            <p id="uRole-' . $id . '" name="uRole-' . $id . '"><span class="badge bg-secondary ' . $userActiveAttribute['style'] . '">' . $role . ' </span></p>

                            <p hidden id="uActive-' . $id . '" name="uActive-' . $id . '">' . $isActive . '</p>
                        </div>
                    </div>
                </div>
                <fieldset id="field-edit-' . $id . '" disabled>
                    <form class="form-inline">
                        <div class="card-body align-items-left align-text-left p-1">
                            <div class="row ml-1 mr-1">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <input id="uFName-' . $id . '" name="uFName-' . $id . '" type="text" class="form-control" value="' . $fname . '">
                                    <input id="uLName-' . $id . '" name="uLName-' . $id . '" type="text" class="form-control" value="' . $lname . '">
                                </div>
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </div>
                                    <input id="uEmail-' . $id . '" name="uEmail-' . $id . '" type="text" class="form-control" value="' . $email . '">
                                </div>
                            </div>
                            <div class="row ml-1 mr-1">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                    </div>
                                    <input id="uPhoneNo-' . $id . '" name="uPhoneNo-' . $id . '" type="text" class="form-control" value="' . $phoneNo . '">
                                </div>
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
                    </form>
                </fieldset>
                </div>
                <!--DISPLAY DATA END-->
                <br>
            ';
        }
    }

    private static function manageSubmissionCard($id, $fname, $lname, $status, $timestamp, $location, $reviewers, $filePath)
    {
        $card = '
        <!--DISPLAY DATA START-->
        <div class="card bg-light border-dark ml-2 mr-2 mt-1">
            <div class="badge text-dark border-bottom border-dark ' .  self::defineConfirmationStatus($status) . '">
                <div class="row ml-1 mr-1 ">
                    <div class="col border-end m-1">
                        <p id="sID-' . $id . '" name="sID-' . $id . '">' . $id . '</p>
                    </div>
                    <div id="box-edit-' . $id . '" class="col border-end">
                        <button id="edit-' . $id . '" type="button" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i> EDIT
                        </button>
                    </div>
                    <div id="box-disable-' . $id . '" class="col border-end">
                        <button id="disable-' . $id . '" type="button" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i> DELETE
                        </button>
                    </div>
                    <div class="col m-1">
                        <p id="sStatus-' . $id . '" name="sStatus-' . $id . '">' . $status . '</p>

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
                                    <input id="sFName-' . $id . '" name="sFName-' . $id . '" type="text" class="form-control" value="' . $fname . '" disabled>
                                    <input id="sLName-' . $id . '" name="sLName-' . $id . '" type="text" class="form-control" value="' . $lname . '" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input id="sTimestamp-' . $id . '" name="sTimestamp-' . $id . '" type="text" class="form-control" value="' . date("d M y \a\\t g:i A", strtotime($timestamp)) . '" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row ml-1 mr-1">
                            <div class="col border-end border-dark">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                    </div>
                                    <input id="sConLocation-' . $id . '" name="sConLocation-' . $id . '" type="text" class="form-control" value="' . $location . '" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-id-badge"></i>
                                        </div>
                                    </div>
                                    <select class="form-select form-select-sm" id="sReviewers-' . $id . '" aria-label="Default select">';
        foreach ($reviewers as $reviewer) {
            $card .= '<option value="' . $reviewer->UserFirstName . ' ' . $reviewer->UserLastName . '">' . $reviewer->UserFirstName . ' ' . $reviewer->UserLastName . '</option>';
        }
        $card .= '</select>
                                </div>
                            </div>
                        </div>
                        <div class="row ml-1 mr-1">
                            <div class="col">
                                <div class="input-group input-group-sm p-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-file"></i>
                                        </div>
                                    </div>
                                    <input id="sPath-' . $id . '" name="sPath-' . $id . '" type="text" class="form-control" value="' . $filePath . '" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
        <!--DISPLAY DATA END-->';
        return $card;
    }

    private static function checkUserRole($uid, $role)
    {
        return ($uid == $_SESSION['UID'] || strpos($role, 'ADMIN') !== false) ? 'disabled' : '';
    }

    private static function isUserActive($isActive)
    {
        $btnAttribute = array();
        if ($isActive) {
            $btnAttribute['icon'] = 'fa-minus';
            $btnAttribute['style'] = 'bg-success';            
            $btnAttribute['button'] = 'btn-danger';
            $btnAttribute['text'] = 'DISABLE';
        } else {
            $btnAttribute['icon'] = 'fa-check';
            $btnAttribute['style'] = 'bg-danger';            
            $btnAttribute['button'] = 'btn-success';
            $btnAttribute['text'] = 'ENABLE';
        }
        return $btnAttribute;
    }

    private static function defineConfirmationStatus($status)
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
