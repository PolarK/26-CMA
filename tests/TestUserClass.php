<?php

declare(strict_types=1);

require_once "./classes/user.class.php";

use PHPUnit\Framework\TestCase;

final class TestUserClass extends TestCase
{
    public function testUsernameIsValid() : void
    {
        $this->assertContains(
            User::class,
            User::get_fname("John")
        );
    }
}

?>