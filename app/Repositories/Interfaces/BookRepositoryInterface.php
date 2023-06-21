<?php

namespace App\Repositories\Interfaces;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    public function save(array $data): Book;

    public function findById(int $id): Book|null;

    public function findAll(): Collection|array;

    public function updateById(int $id, array $data): Book;

    public function deleteById(int $id): void;
}
