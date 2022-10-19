<?php

declare(strict_types=1);

require_once "./classes/errorHandler.class.php";

use PHPUnit\Framework\TestCase;

final class TestIDGenerator extends TestCase
{
    public function testEmail() : void
    {
        $this->assertTrue(
            ErrorHandler::validateEmail("Jack@gmail.com")
        );
    }
}

?>