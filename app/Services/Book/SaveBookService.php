<?php

namespace App\Services\Book;

use App\Domain\Features\Book\SaveBook;
use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;

class SaveBookService implements SaveBook
{
    private BookRepositoryInterface $bookRepository;

    /**
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function handle(array $data): Book
    {
        return $this->bookRepository->save($data);
    }
}
