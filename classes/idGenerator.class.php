<?php

class IDGenerator
{
    static function user($role, $fName, $lName)
    {
        $id = substr($role, 0, 1) . substr($lName, 0, 1) . substr($fName, 0, 1) . self::unqid();
        return $id;
    }

    static function submission()
    {
        return self::unqid(8);
    }

    static function review()
    {
        return self::unqid(8);
    }
    
    private static function unqid($lenght = 5)
    {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        return substr(bin2hex($bytes), 0, $lenght);
    }
}
