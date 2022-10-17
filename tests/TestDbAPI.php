<?php

declare(strict_types=1);

require_once './classes/dbAPI.class.php';

use PHPUnit\Framework\TestCase;

final class TestDbAPI extends TestCase
{
    public function __const(){
        $db = new Database();
    }

    public function testGetAllUsers() : void
    {
        
    }
}
