<?php

declare(strict_types=1);

require_once "./classes/user.class.php";

use PHPUnit\Framework\TestCase;

final class TestUserClass extends TestCase
{
    
    public function testAllIsValid() : void
    {
        User $allvalid = new User("lala12", "lala", "popo", "1974-03-18", "lala@po.com", "0401020202", "ADMIN", 1)
        $this->assertContains(
            User::class,
            User::get_fname("AAJ29b8d")
        );
    }
    
    public function testFirstnameIsValid() : void
    {
        $this->assertContains(
            User::class,
            User::get_fname("Joseph")
        );
    }
    
    public function testLastnameIsValid() : void
    {
        $this->assertContains(
            User::class,
            User::get_fname("Ayala")
        );
    }

    public function testDOBIsValid() : void
    {
        $this->assertContains(
            User::class,
            User::get_fname("1974-03-18")
        );
    }

    public function testEmailIsValid() : void
    {
        $this->assertContains(
            User::class,
            User::get_fname("1974-03-18")
        );
    }

    public function testPhoneIsValid() : void
    {
        $this->assertContains(
            User::class,
            User::get_fname("1974-03-18")
        );
    }

    public function testRoleIsValid() : void
    {
        $this->assertContains(
            User::class,
            User::get_fname("1974-03-18")
        );
    }

    public function TestRegisterIsValid() : void
    {
        $this->assertContains(
            User::class,
            User::get_fname("John")
        );
    }
}

?>