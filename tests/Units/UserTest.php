<?php

namespace Tests\Units;

use App\User;
use TestCase;

class UserTest extends TestCase
{
    public function testUserCanUpgradeLevel()
    {
        $userMock = factory(User::class)->make([
            'level' => env('USER_MAX_LEVEL', 300),
        ]);

        $userMock->levelUp();

        $this->assertTrue($userMock->isMaxLevel());
        $this->assertEquals(env('USER_MAX_LEVEL', 300), $userMock->level);
    }
}
