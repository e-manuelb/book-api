<?php

namespace App\Services\Auth;

use App\Domain\Features\Auth\Login;

class LoginService implements Login
{
    public function handle(array $credentials): string
    {
        if (!auth()->attempt($credentials)) {
            return "Invalid credentials.";
        }

        return auth()->user()->createToken("accessToken")->plainTextToken;
    }
}
