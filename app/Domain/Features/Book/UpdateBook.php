<?php

namespace App\Domain\Features\Book;

use App\Models\Book;

interface UpdateBook
{
    public function handle(int $id, array $data): Book;
}
