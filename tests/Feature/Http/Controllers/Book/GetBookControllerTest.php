<?php

namespace Http\Controllers\Book;

use App\Models\Book;
use App\Models\User;
use Tests\TestCase;

class GetBookControllerTest extends TestCase
{
    public function testGetControllerSuccessfully()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $response = $this->actingAs($user)->get("/api/book/$book->id");

        $response->assertSuccessful();
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

    public function testGetControllerUnauthorized()
    {
        $book = Book::factory()->create();

        $response = $this->get("/api/book/$book->id");

        $response->assertUnauthorized();
    }

    public function testGetControllerNotFound()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $id = 2;

        $response = $this->actingAs($user)->get("/api/book/$id");

        $response->assertNotFound();
        $response->assertJson([
            'message' => "Book with ID #$id was not found.",
        ]);
    }
}
