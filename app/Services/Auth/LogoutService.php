<?php

namespace App\Services\Auth;

use App\Models\User;

class LogoutService
{
    public function handle(User $user): void
    {
        $user?->tokens()->delete();
    }
}
