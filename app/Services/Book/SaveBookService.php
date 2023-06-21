<?php

namespace App\Services\Book;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;

class SaveBookService
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
