<?php

namespace App\Services\Book;

use App\Domain\Features\Book\DeleteBook;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Exception;

class DeleteBookService implements DeleteBook
{
    private BookRepositoryInterface $bookRepository;

    /**
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @throws Exception
     */
    public function handle(int $id): void
    {
        $book = $this->bookRepository->findById($id);

        if (!!$book) {
            $this->bookRepository->deleteById($id);
        } else {
            throw new Exception("Book with ID $id was not found");
        }
    }
}
