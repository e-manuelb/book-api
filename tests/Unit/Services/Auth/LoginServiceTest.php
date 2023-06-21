<?php

namespace Services\Auth;

use App\Models\User;
use App\Services\Auth\LoginService;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    public function testLoginServiceSuccessfully()
    {
        $password = "12345678";

        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);

        $response = (new LoginService())->handle([
            'email' => $user->email,
            'password' => $password
        ]);

        $this->assertNotEquals("Invalid credentials.", $response);
    }

    public function testLoginServiceFail()
    {
        $password = "12345678";

        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);

        $response = (new LoginService())->handle([
            'email' => $user->email,
            'password' => "123456789"
        ]);

        $this->assertEquals("Invalid credentials.", $response);
    }
}
