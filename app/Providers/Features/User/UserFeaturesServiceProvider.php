<?php

namespace App\Providers\Features\User;

use App\Domain\Features\User\SaveUser;
use App\Services\User\SaveUserService;
use Illuminate\Support\ServiceProvider;

class UserFeaturesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SaveUser::class, SaveUserService::class);
    }
}
