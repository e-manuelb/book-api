<?php

namespace Services\Book;

use App\Models\Book;
use App\Repositories\BookRepository;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Book\DeleteBookService;
use Exception;
use Tests\TestCase;

class DeleteBookServiceTest extends TestCase
{
    private BookRepositoryInterface $bookRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->bookRepository = new BookRepository();
    }

    public function testDeleteBookServiceSuccessfully()
    {
        $book = Book::factory()->create();

        (new DeleteBookService($this->bookRepository))->handle($book->id);

        $this->expectNotToPerformAssertions();
    }

    public function testDeleteBookServiceFailed()
    {
        $this->expectException(Exception::class);

        (new DeleteBookService($this->bookRepository))->handle(1);
    }
}
