<?php

declare(strict_types=1);

require_once "./classes/user.class.php";

use PHPUnit\Framework\TestCase;

final class TestUserClass extends TestCase
{   
    public function TestValidateTimestamps() : void 
    {
        
    }

    public function TestConferenceRegisterIsValid() : void
    {
        $this->assertContains(
            User::class,
            User::get_fname("Joseph")
        );
    }

    public function TestConferenceUpdateIsValid() : void
    {

    }
}

?>