<?php

namespace Units\Domains\Users;

use App\User;
use TestCase;

class UserTest extends TestCase
{
    public function testUserCanUpgradeLevel()
    {
        $user = factory(User::class)->make(['level' => 1, 'experience' => 0]);

        $user->experience = $user->toNextLevel() + 1;
        $user->levelUp();

        $this->assertTrue($user->level > 1);
        $this->assertEquals(2, $user->level);
        $this->assertFalse($user->isMaxLevel());
    }

    public function testUserCanNotUpgradeLevel()
    {
        $user = factory(User::class)->make(['level' => 300, 'experience' => 0]);

        $user->experience = $user->toNextLevel() + 1;
        $user->levelUp();

        $this->assertFalse($user->level > 300);
        $this->assertEquals(300, $user->level);
    }
}
