<?php

namespace Services\Book;

use App\Models\Book;
use App\Repositories\BookRepository;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Book\UpdateBookService;
use Tests\TestCase;

class UpdateBookServiceTest extends TestCase
{
    private BookRepositoryInterface $bookRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->bookRepository = new BookRepository();
    }

    public function testUpdateBookSuccessfully()
    {
        $book = Book::factory()->create();

        $updatedBook = (new UpdateBookService($this->bookRepository))->handle($book->id, [
            'name' => 'Test book updated.'
        ]);

        $this->assertNotEquals($book, $updatedBook);
        $this->assertEquals('Test book updated.', $updatedBook->name);
    }
}
