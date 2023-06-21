<?php

namespace Http\Controllers\Book;

use App\Models\Book;
use App\Models\User;
use Tests\TestCase;

class UpdateBookControllerTest extends TestCase
{
    public function testUpdateBookControllerTest()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $payload = [
            'name' => 'Test update controller.',
            'isbn' => '123',
            'value' => 12.30
        ];

        $response = $this->actingAs($user)->put("/api/book/$book->id", $payload);

        $response->assertSuccessful();

        $data = $response->json();

        $this->assertEquals($payload['name'], $data['name']);
        $this->assertEquals($payload['isbn'], $data['isbn']);
        $this->assertEquals($payload['value'], $data['value']);
    }

    public function testUpdateBookNameValidationTest()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $payload = [
            'name' => 12345,
            'isbn' => '123',
            'value' => 12.30
        ];

        $response = $this->actingAs($user)->put("/api/book/$book->id", $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'name' => ['The name field must be a string.']
            ]
        ]);
    }

    public function testUpdateBookISBNValidationTest()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $payload = [
            'name' => "Test book",
            'isbn' => [],
            'value' => 12.30
        ];

        $response = $this->actingAs($user)->put("/api/book/$book->id", $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'isbn' => ['The isbn field must be an integer.']
            ]
        ]);
    }

    public function testUpdateBookValueValidationTest()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $payload = [
            'name' => "Test book",
            'isbn' => 123456,
            'value' => []
        ];

        $response = $this->actingAs($user)->put("/api/book/$book->id", $payload);

        $response->assertUnprocessable();
        $response->assertJson([
            'errors' => [
                'value' => ['The value field must be a number.']
            ]
        ]);
    }
}
