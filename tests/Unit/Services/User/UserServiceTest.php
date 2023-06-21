<?php

namespace Services\User;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\User\SaveUserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserRepositoryInterface $userRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepository = new UserRepository();
    }

    public function testSaveUserServiceSuccessfully()
    {
        $user = (new SaveUserService($this->userRepository))->handle([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => '12345678'
        ]);

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);
    }
}
