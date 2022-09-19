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
        }
    }

    private static function submissionCard($title, $blurb, $filePath, $status, $timestamp)
    {
        return '
        <div class="card">
            <span class="badge ' . self::defineStatus($status) . ' text-dark">Submission ' . $status . '</span>
            <div class="card-body">
                <h5 class="card-title">' . $title . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">Submitted at: ' . $timestamp . ' </h6>
                <p class="card-text">' . $blurb . '</p>
                <a href="' . $filePath . '" class="card-link">View My Paper</a> 
            </div>
        </div>
        <br>
        ';
    }

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

    private static function defineStatus($status)
    {
        switch ($status) {
            case 'Accepted':
                return 'bg-success';

            case 'Pending':
                return 'bg-warning';

            case 'Reject':
                return 'bg-danger';
        }
    }
}
