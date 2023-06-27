<?php

namespace App\Services\Book;

use App\Domain\Features\Book\ListBooks;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ListBooksService implements ListBooks
{
    private BookRepositoryInterface $bookRepository;

    /**
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function handle(): Collection|array
    {
        return $this->bookRepository->findAll();
    }
}
