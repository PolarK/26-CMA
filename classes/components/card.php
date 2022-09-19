<?php
class Card
{
    public static function display($type = '', $data = array())
    {
        implode(',', $data);

        switch($type){
            case 'submission':
                return self::submissionCard($data[0], $data[1], $data[2], $data[3], $data[4]);
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
                <!--\/ 1-2 sentences of the paper \/-->
                <p class="card-text">' . $blurb . '</p>
                <a href="' . $filePath . '" class="card-link">View My Paper</a> 
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
