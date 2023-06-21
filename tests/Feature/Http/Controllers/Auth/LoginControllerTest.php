<?php

namespace Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    public function testLoginControllerSuccessfully()
    {
        $password = "12345678";

        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'token'
        ]);
    }

    public function testLoginControllerEmailFieldValidation()
    {
        // Required validation

        $password = "12345678";

        $response = $this->post('/api/login', [
            'password' => $password
        ]);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'email' => [
                    'The email field is required.'
                ]
            ]
        ]);

        // Type email validation

        $response = $this->post('/api/login', [
            'email' => "john.doe",
            'password' => $password
        ]);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'email' => [
                    'The email field must be a valid email address.'
                ]
            ]
        ]);
    }

    public function testLoginControllerPasswordFieldValidation()
    {
        // Required validation

        $password = "12345678";

        $response = $this->post('/api/login', [
            'email' => 'john.doe@gmail.com',
        ]);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'password' => [
                    'The password field is required.'
                ]
            ]
        ]);

        // Type string validation

        $response = $this->post('/api/login', [
            'email' => "john.doe@gmail.com",
            'password' => ['test']
        ]);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'password' => [
                    'The password field must be a string.'
                ]
            ]
        ]);

        // Min length validation

        $response = $this->post('/api/login', [
            'email' => 'john.doe@gmail.com',
            'password' => Str::random(7)
        ]);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'password' => [
                    'The password field must be at least 8 characters.'
                ]
            ]
        ]);

        // Max length validation

        $response = $this->post('/api/login', [
            'email' => 'john.doe@gmail.com',
            'password' => Str::random(257)
        ]);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'password' => [
                    'The password field must not be greater than 256 characters.'
                ]
            ]
        ]);
    }

    public function testLoginControllerFail()
    {
        $password = "12345678";

        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => "123456789"
        ]);

        $response->assertUnprocessable();
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
