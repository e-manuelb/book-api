<?php

namespace App\Domain\Features\Book;

interface DeleteBook
{
    public function handle(int $id): void;
}
