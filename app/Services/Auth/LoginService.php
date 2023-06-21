<?php

namespace App\Services\Auth;

class LoginService
{
    public function handle(array $credentials): string
    {
        if (!auth()->attempt($credentials)) {
            return "Invalid credentials.";
        }

        return auth()->user()->createToken("accessToken")->plainTextToken;
    }
}
