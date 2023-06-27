<?php

namespace App\Domain\Features\Book;

use App\Models\Book;

interface GetBook
{
    public function handle(int $id): Book|null;
}
