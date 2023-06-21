<?php

namespace Http\Controllers\Book;

use App\Models\Book;
use App\Models\User;
use Tests\TestCase;

class DeleteBookControllerTest extends TestCase
{
    public function testDeleteBookControllerSuccessfully()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $response = $this->actingAs($user)->delete("/api/book/$book->id");

        $response->assertSuccessful();
        $response->assertJson([
            "message" => "Book with ID #$book->id deleted successfully."
        ]);
    }

    public function testDeleteBookControllerFailed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete("/api/book/1");

        $response->assertBadRequest();
        $response->assertJson([
            "message" => "Book with ID #1 cannot be deleted. Error: Book with ID 1 was not found."
        ]);
    }

    public function testDeleteBookControllerUnauthorized()
    {
        $book = Book::factory()->create();

        $response = $this->delete("/api/book/$book->id");

        $response->assertUnauthorized();
    }
}
