<?php

namespace App\Domain\Features\Book;

use Illuminate\Database\Eloquent\Collection;

interface ListBooks
{
    public function handle(): Collection|array;
}
