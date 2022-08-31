<?php

    // common php functions 

    // clean input data
    function sanitise($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // check if there are any error messages
    function validate($err_msgs) {
        foreach ($err_msgs as $msg) {
            if ($msg != "") return false; 
        }
        return true; 
    }
?>