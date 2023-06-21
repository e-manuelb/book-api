<?php

namespace Services\Auth;

use App\Models\User;
use App\Services\Auth\LogoutService;
use Tests\TestCase;

class LogoutServiceTest extends TestCase
{
    public function testLogoutServiceSuccessfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        (new LogoutService())->handle($user);

        $this->expectNotToPerformAssertions();
    }
}
