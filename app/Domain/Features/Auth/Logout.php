<?php

namespace App\Domain\Features\Auth;

use App\Models\User;

interface Logout
{
    public function handle(User $user): void;
}
