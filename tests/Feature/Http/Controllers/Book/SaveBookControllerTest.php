<?php

namespace Http\Controllers\Book;

use App\Models\Book;
use App\Models\User;
use Tests\TestCase;

class SaveBookControllerTest extends TestCase
{
    public function testSaveBookControllerSuccessfully()
    {
        $user = User::factory()->create();

        $payload = [
            'name' => 'Test book',
            'isbn' => 12345678,
            'value' => 1000
        ];

        $response = $this->actingAs($user)->post('/api/book', $payload);

        $response->assertSuccessful();
        $response->assertCreated();
        $response->assertJsonStructure([
            'id',
            'name',
            'isbn',
            'value',
            'created_at',
            'updated_at',
            '_links'
        ]);
    }

    public function testSaveBookControllerUnauthorized()
    {
        $payload = [
            'name' => 'Test book',
            'isbn' => 12345678,
            'value' => 1000
        ];

        $response = $this->post('/api/book', $payload);

        $response->assertUnauthorized();
    }

    public function testSaveBookControllerNameFieldValidation()
    {
        $user = User::factory()->create();

        // Required validation

        $payload = [
            'isbn' => 12345678,
            'value' => 1000
        ];

        $response = $this->actingAs($user)->post('/api/book', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'name' => [
                    'The name field is required.'
                ]
            ]
        ]);

        // String type validation

        $payload = [
            'name' => 100,
            'isbn' => 12345678,
            'value' => 1000
        ];

        $response = $this->actingAs($user)->post('/api/book', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'name' => [
                    'The name field must be a string.'
                ]
            ],
        ]);
    }

    public function testSaveBookControllerISBNFieldValidation()
    {
        $user = User::factory()->create();

        // Required validation

        $payload = [
            'name' => 'Test book',
            'value' => 1000
        ];

        $response = $this->actingAs($user)->post('/api/book', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'isbn' => [
                    'The isbn field is required.'
                ]
            ]
        ]);

        // Unique validation

        $book = Book::factory()->create();

        $payload = [
            'name' => "Test book",
            'isbn' => $book->isbn,
            'value' => 1000
        ];

        $response = $this->actingAs($user)->post('/api/book', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'isbn' => [
                    'The isbn has already been taken.'
                ]
            ],
        ]);
    }

    public function testSaveBookControllerValueFieldValidation()
    {
        $user = User::factory()->create();

        // Required validation

        $payload = [
            'name' => 'Test book',
            'isbn' => '12345678'
        ];

        $response = $this->actingAs($user)->post('/api/book', $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'value' => [
                    'The value field is required.'
                ]
            ]
        ]);
    }
}
