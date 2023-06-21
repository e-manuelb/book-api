<?php

namespace Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class SaveUserControllerTest extends TestCase
{
    public function testSaveUserControllerSuccessfully()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => '12345678'
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertSuccessful();
        $response->assertJson([
            'name' => $payload['name'],
            'email' => $payload['email']
        ]);
    }

    public function testSaveUserControllerNameFieldValidation()
    {
        // Required validation

        $payload = [
            'email' => 'john.doe@gmail.com',
            'password' => '12345678'
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'name' => [
                    'The name field is required.'
                ]
            ]
        ]);

        // Type string validation

        $payload = [
            'name' => 12345,
            'email' => 'john.doe@gmail.com',
            'password' => '12345678'
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'name' => [
                    'The name field must be a string.'
                ]
            ]
        ]);
    }

    public function testSaveUserControllerEmailFieldValidation()
    {
        // Required validation

        $payload = [
            'name' => 'John Doe',
            'password' => '12345678'
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'email' => [
                    'The email field is required.'
                ]
            ]
        ]);

        // Type email validation

        $payload = [
            'name' => 'John Doe',
            'email' => 'john.doe',
            'password' => '12345678'
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'email' => [
                    'The email field must be a valid email address.'
                ]
            ]
        ]);

        // Unique validation

        User::factory()->create([
            'email' => 'john.doe@gmail.com'
        ]);

        $payload = [
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => '12345678'
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'email' => [
                    'The email has already been taken.'
                ]
            ]
        ]);
    }

    public function testSaveUserControllerPasswordFieldValidation()
    {
        // Required validation

        $payload = [
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'password' => [
                    'The password field is required.'
                ]
            ]
        ]);

        // Min length validation

        $payload = [
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => '1234567'
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'password' => [
                    'The password field must be at least 8 characters.'
                ]
            ]
        ]);

        // Max length validation

        $payload = [
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => Str::random(257)
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'password' => [
                    'The password field must not be greater than 256 characters.'
                ]
            ]
        ]);
    }
}
