<?php

namespace App\Services\Auth;

use App\Domain\Features\Auth\Logout;
use App\Models\User;

class LogoutService implements Logout
{
    public function handle(User $user): void
    {
        $user?->tokens()->delete();
    }
}
