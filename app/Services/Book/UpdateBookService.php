<?php

namespace App\Services\Book;

use App\Domain\Features\Book\UpdateBook;
use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;

class UpdateBookService implements UpdateBook
{
    private BookRepositoryInterface $bookRepository;

    /**
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function handle(int $id, array $data): Book
    {
        return $this->bookRepository->updateById($id, $data);
    }
}
