<?php

namespace App\Domain\Features\Book;

use App\Models\Book;

interface SaveBook
{
    public function handle(array $data): Book;
}
