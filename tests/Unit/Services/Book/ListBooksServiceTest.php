<?php

namespace Services\Book;

use App\Models\Book;
use App\Repositories\BookRepository;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Book\ListBooksService;
use Tests\TestCase;

class ListBooksServiceTest extends TestCase
{
    private BookRepositoryInterface $bookRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->bookRepository = new BookRepository();
    }

    public function testListBooksSuccessfully()
    {
        $books = Book::factory(20)->create();

        $response = (new ListBooksService($this->bookRepository))->handle();

        $this->assertCount($books->count(), $response);
    }
}
