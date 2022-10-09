<?php
/**
 * An API class used to communicate with the API's. 
 -------------------------------------------------
 * $arg_0   : URL     [string]
 * $arg_1   : Type    [array]
 * $arg_2   : Data    [array]
 */

class API
{   
    # make request to API
    static function request()
    {
        # get arguments and split them into an array of "args"
        extract(func_get_args(), EXTR_PREFIX_ALL, "arg");

        // attempt to solve space issue in url arguments
        $url = str_replace(" ","%20",$arg_0);
        
        # initialised connection to API
        $conn = curl_init();
        curl_setopt($conn, CURLOPT_URL, $url);

        if(!isset($arg_1)) {
            return;
        }

        switch ($arg_1) {
            case 'GET_REQUEST':
                curl_setopt($conn, CURLOPT_HTTPHEADER, array($arg_2));
                break;

            case 'POST_REQUEST':
                curl_setopt($conn, CURLOPT_POST, true);
                curl_setopt($conn, CURLOPT_POSTFIELDS, http_build_query($arg_2));
                break;
            
            default:
                return;
        }

        curl_setopt($conn, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, false);
        
        $res = curl_exec($conn);
        curl_close($conn);

        /*
            !   This is just a temporary thing.
            !   Will need to changed when OAuth2 is implemented.
            
        echo 'TEST <br><hr><pre>' .
            '   URL: ' . $arg_0 . '<br>' .
            '   TYPE: ' . $arg_1 . '<br>' .
            '   DATA: ' . $arg_2 . '<br>' .
            '   CONN: ' . $conn . '<br>'.
            '   RESULT: ' . $res . '<br></pre>';
            */ 

        return json_decode($res);
    }
}

?>