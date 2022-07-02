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
        # initialised connection to API
        $conn = curl_init();
        curl_setopt($conn, CURLOPT_URL, $arg_0);

        if(!isset($arg_1)) {
            return;
        }

        switch ($arg_1) {
            case 'HEADER':
                curl_setopt($conn, CURLOPT_HTTPHEADER, array('user-agent: person', $arg_2));
            
            default:
                return;
        }

        curl_setopt($conn, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($conn);
        curl_close($conn);
        return json_decode($res);
    }
}

?>