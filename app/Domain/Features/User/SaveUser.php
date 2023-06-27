<?php

namespace App\Domain\Features\User;

use App\Models\User;

interface SaveUser
{
    public function handle(array $data): User;
}
