<?php
include_once '../../classes/dbAPI.class.php';
header('Content-Type: application/json');

$db = new Database();
$input = filter_input_array(INPUT_POST);

if ($input["action"] === 'edit') {
    $db->updateSubmission(
        $input['SubmissionId'],
        $input['UserId'],
        $input['SubmissionTimestamp'],
        $input['SubmissionPath'],
    );
}

if ($input["action"] === 'delete') {
    $db->deleteSubmission($input['SubmissionId']);
}
echo json_encode($input);
