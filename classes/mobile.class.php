<?php
// https://stackoverflow.com/questions/4117555/simplest-way-to-detect-a-mobile-device-in-php
class Mobile
{
    public static function isActive()
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
}
