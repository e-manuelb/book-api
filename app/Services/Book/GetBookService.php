<?php

namespace App\Services\Book;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;

class GetBookService
{
    private BookRepositoryInterface $bookRepository;

    /**
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function handle(int $id): Book|null
    {
        return $this->bookRepository->findById($id);
    }
}
