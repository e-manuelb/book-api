<?php

namespace Http\Controllers\Book;

use App\Models\Book;
use App\Models\User;
use Tests\TestCase;

class ListBooksControllerTest extends TestCase
{
    public function testListBooksControllerSuccessfully()
    {
        $user = User::factory()->create();

        $books = Book::factory(20)->create();

        $response = $this->actingAs($user)->get('/api/book');

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'data' => [
                "*" => [
                    'id',
                    'name',
                    'isbn',
                    'value',
                    'created_at',
                    'updated_at',
                    '_links'
                ]
            ]
        ]);
        $this->assertCount($books->count(), $response->json()['data']);
    }

    public function testListBooksControllerUnauthorized()
    {
        Book::factory()->create();

        $response = $this->get('/api/book');

        $response->assertUnauthorized();
    }

    public function testListBooksControllerPaginationSuccessfully()
    {
        $user = User::factory()->create();

        Book::factory(20)->create();

        $response = $this->actingAs($user)->get('/api/book?perPage=10');

        $response->assertSuccessful();
        $this->assertCount(10, $response->json()['data']);
    }
}
