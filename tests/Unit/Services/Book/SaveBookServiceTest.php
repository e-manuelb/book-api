<?php

namespace Services\Book;

use App\Models\Book;
use App\Repositories\BookRepository;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Book\SaveBookService;
use Tests\TestCase;

class SaveBookServiceTest extends TestCase
{
    private BookRepositoryInterface $bookRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->bookRepository = new BookRepository();
    }

    public function testSaveBookSuccessfully()
    {
        $book = (new SaveBookService($this->bookRepository))->handle([
            'name' => 'Test book',
            'isbn' => '12345678',
            'value' => 100.00
        ]);

        $this->assertNotNull($book);
        $this->assertInstanceOf(Book::class, $book);
    }
}
