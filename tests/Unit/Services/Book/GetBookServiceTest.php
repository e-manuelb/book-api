<?php

namespace Services\Book;

use App\Models\Book;
use App\Repositories\BookRepository;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Book\GetBookService;
use Tests\TestCase;

class GetBookServiceTest extends TestCase
{
    private BookRepositoryInterface $bookRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->bookRepository = new BookRepository();
    }

    public function testGetBookSuccessfully()
    {
        $book = Book::factory()->create();

        $response = (new GetBookService($this->bookRepository))->handle($book->id);

        $this->assertNotNull($response);
    }

    public function testGetBookFailed()
    {
        $book = Book::factory()->create();

        $response = (new GetBookService($this->bookRepository))->handle(2);

        $this->assertNull($response);
    }
}
