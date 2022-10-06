<?php

    class TimeProcessor {

        public static function getDateTime($timestamp) {

            $datetime = [
                "date" => date('Y-m-d', $timestamp), 
                "time" => date('H:i', $timestamp)
            ]; 

            return $datetime; 
        }

        // used to check when conference expires
        public static function cmpETimeandCTime($eTimestamp) {
            return strtotime($eTimestamp) < strtotime(date('Y-m-d H:i:s')); 
        }
        
    }
?>
