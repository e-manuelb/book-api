<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BookRepository implements BookRepositoryInterface
{
    public function save(array $data): Book
    {
        /** @var Book $book */
        $book = Book::query()->create($data);

        return $book;
    }

    public function findById(int $id): Book|null
    {
        /** @var Book $book */
        $book = Book::query()->find($id);

        return $book;
    }

    public function findAll(): Collection|array
    {
        return Book::query()->get();
    }

    public function updateById(int $id, array $data): Book
    {
        /** @var Book $book */
        $book = Book::query()->find($id);

        $book->update($data);

        return $book;
    }

    public function deleteById(int $id): void
    {
        Book::query()->find($id)->delete();
    }
}
