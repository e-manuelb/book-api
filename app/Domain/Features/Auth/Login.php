<?php

namespace App\Domain\Features\Auth;

interface Login
{
    public function handle(array $credentials): string;
}
