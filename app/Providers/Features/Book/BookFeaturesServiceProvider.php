<?php

namespace App\Providers\Features\Book;

use App\Domain\Features\Book\DeleteBook;
use App\Domain\Features\Book\GetBook;
use App\Domain\Features\Book\ListBooks;
use App\Domain\Features\Book\SaveBook;
use App\Domain\Features\Book\UpdateBook;
use App\Services\Book\DeleteBookService;
use App\Services\Book\GetBookService;
use App\Services\Book\ListBooksService;
use App\Services\Book\SaveBookService;
use App\Services\Book\UpdateBookService;
use Illuminate\Support\ServiceProvider;

class BookFeaturesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(DeleteBook::class, DeleteBookService::class);
        $this->app->bind(GetBook::class, GetBookService::class);
        $this->app->bind(ListBooks::class, ListBooksService::class);
        $this->app->bind(SaveBook::class, SaveBookService::class);
        $this->app->bind(UpdateBook::class, UpdateBookService::class);
    }
}
