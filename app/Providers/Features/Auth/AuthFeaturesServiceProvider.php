<?php

namespace App\Providers\Features\Auth;

use App\Domain\Features\Auth\Login;
use App\Domain\Features\Auth\Logout;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use Carbon\Laravel\ServiceProvider;

class AuthFeaturesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Login::class, LoginService::class);
        $this->app->bind(Logout::class, LogoutService::class);
    }
}
